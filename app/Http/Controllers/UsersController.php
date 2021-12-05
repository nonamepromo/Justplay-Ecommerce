<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Exports\usersExport;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function userLoginRegister(){
        $meta_title = "Utente Login/Registrazione | Justplay";
        return view('users.login_register')->with(compact('meta_title'));
    }

    public function account(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        $countries = Country::get();

        if($request->isMethod('post')){
            $data = $request->all();
            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->pincode = $data['pincode'];
            $user->mobile = $data['mobile'];
            $user->save();
            return redirect()->back()->with('flash_message_success','I tuoi dati sono stati aggiornati con successo!');
        }

        return view('users.account')->with(compact('countries','userDetails'));
    }

    public function login(Request $request){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        if($request->isMethod('post')){
            $data = $request->all();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                $userStatus = User::where('email',$data['email'])->first();
                if($userStatus->status == 0){
                    return redirect()->back()->with('flash_message_error', 'Il tuo  account non è attivo! Conferma la tua email per attivarlo.');
                }
                Session::put('frontSession',$data['email']);

                if(!empty(Session::get('session_id'))){
                    $session_id = Session::get('session_id');
                    DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);
                }
                return redirect('/');
            }else{
                return redirect()->back()->with('flash_message_error', 'Email o Password errate!');
            }
        }
    }

    public function register(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            //Check if User Already exist
            $usersCount = User::where('email', $data['email'])->count();
            if ($usersCount > 0) {
                return redirect()->back()->with('flash_message_error', 'Email già registrata!');
            } else {
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                date_default_timezone_set('Europe/Rome');
                $user->created_at = date("Y-m-d H:i:s");
                $user->updated_at = date("Y-m-d H:i:s");
                $user->save();

                // Send Register Email
                /* $email = $data['email'];
                $messageData = ['email' => $data['email'],'name'=>$data['name']];
                Mail::send('emails.register',$messageData, function ($message) use($email){
                    $message->to($email)->subject('Registration with E-com Website');
                }); */

                // Send Confirmation Email
                $email = $data['email'];
                $messageData = ['email' => $data['email'],'name'=>$data['name'],'code'=>base64_encode($data['email'])];
                Mail::send('emails.confirmation',$messageData, function ($message) use($email){
                    $message->to($email)->subject('Confirm your account');
                });

                return redirect()->back()->with('flash_message_success', 'Per favore conferma la tua email per attivare il tuo account!');

                if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    Session::put('frontSession',$data['email']);

                    if(!empty(Session::get('session_id'))){
                        $session_id = Session::get('session_id');
                        DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);
                    }
                    return redirect('/')->with('flash_message_success','Account creato correttamente!');
                }
            }
        }
    }

    public function forgotPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $userCount = User::where('email',$data['email'])->count();
            if($userCount == 0){
                return redirect()->back()->with('flash_message_error','Email inserita non esistente!');
            }

            //Get User Details
            $userDetails = User::where('email',$data['email'])->first();

            //Generate random Password
            $random_password = str_random(8);

            //Encode/Secure Password
            $new_password = bcrypt($random_password);

            //Update Password
            User::where('email',$data['email'])->update(['password'=>$new_password]);

            //Send Forgot Password Email Code
            $email = $data['email'];
            $name = $userDetails->name;
            $messageData = [
                'email'=>$email,
                'name'=>$name,
                'password'=>$random_password
            ];
            Mail::send('emails.forgotpassword',$messageData,function ($message)use($email){
                $message->to($email)->subject('Nuova Password - Justplay');
            });

            return redirect('login-register')->with('flash_message_success', 'La tua password è stata aggiornata, ti è stata mandata per email!');
        }
        return view('users.forgot_password');
    }

    public function confirmAccount($email){
        $email = base64_decode($email);
        $userCount = User::where('email', $email)->count();
        if ($userCount > 0) {
            $userDetails = User::where('email', $email)->first();
            if ($userDetails->status == 1) {
                return redirect('login-register')->with('flash_message_success', 'Il tuo account è già attivo! Effettua il login.');
            } else {
                   User::where('email', $email)->update(['status' => 1]);

                //Welcome Email
                $messageData = ['email' => $email,'name'=>$userDetails->name];
                Mail::send('emails.welcome',$messageData, function ($message) use($email){
                    $message->to($email)->subject('Benvenuto in Justplay!');
                });


            return redirect('login-register')->with('flash_message_success', 'Il tuo account è stato attivato! Effettua il login adesso.');
            }
        }else{
            abort(404);
        }
    }

    public function chkUserPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $user_id = Auth::User()->id;
        $check_password = User::where('id',$user_id)->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $old_pwd = User::where('id',Auth::User()->id)->first();
            $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd,$old_pwd->password)){
                //Update password
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
                return redirect()->back()->with('flash_message_success','La password è stata modificata correttamente');
            }else{
                return redirect()->back()->with('flash_message_error','La password corrente è errata!');
            }
        }
    }

    public function logout(){
        Auth::logout();
        Session::forget('frontSession');
        return redirect('/');
    }

    public function checkEmail(Request $request)
    {
        $data = $request->all();
        $usersCount = User::where('email', $data['email'])->count();
        if ($usersCount > 0) {
            echo "false";
        } else {
            echo "true"; die;
        }
    }

    public function viewUsers(){
        if(Session::get('adminDetails')['users_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        $users = User::get();
        return view ('admin.users.view_users')->with(compact('users'));
    }

    public function exportUsers(){
        return Excel::download(new usersExport,'users.xlsx');
    }

    public function viewUsersCharts(){
        $current_month_users = User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->count();
        $last_month_users = User::whereYear('created_at',Carbon::now()->subYear(1))->whereMonth('created_at',Carbon::now()->subMonth(1))->count();
        $last_to_last_month_users = User::whereYear('created_at',Carbon::now()->subYear(1))->whereMonth('created_at',Carbon::now()->subMonth(2))->count();
        return view('admin.users.view_users_charts')->with(compact('current_month_users','last_month_users',
            'last_to_last_month_users'));
    }

    public function viewUsersCountriesCharts(){
        $getUserCountries = User::select('country',DB::raw('count(country) as count'))->groupBy('country')->get();

        return view('admin.users.view_users_countries_charts')->with(compact('getUserCountries'));
    }
}
