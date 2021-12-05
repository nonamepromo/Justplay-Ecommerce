<?php

namespace App\Http\Controllers;

use App\CmsPage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use function foo\func;

class CmsController extends Controller
{
    public function addCmsPage(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['meta_title'])){
                $data['meta_title'] = "";
            }
            if(empty($data['meta_description'])){
                $data['meta_description'] = "";
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords'] = "";
            }
            $cmspage = new CmsPage;
            $cmspage->title = $data['title'];
            $cmspage->url = $data['url'];
            $cmspage->description = $data['description'];
            $cmspage->meta_title = $data['meta_title'];
            $cmspage->meta_description = $data['meta_description'];
            $cmspage->meta_keywords = $data['meta_keywords'];
            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }
            $cmspage->status = $status;
            $cmspage->save();
            return redirect('/admin/view-cms-pages')->
            with('flash_message_success','CMS Page has been added successfully!');
        }
        return view('admin.pages.add_cms_page');
    }

    public function editCmsPage(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }
            if(empty($data['meta_title'])){
                $data['meta_title'] = "";
            }
            if(empty($data['meta_description'])){
                $data['meta_description'] = "";
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords'] = "";
            }
            CmsPage::where('id',$id)->
            update(['title'=>$data['title'],'url'=>$data['url'],'description'=>$data['description'],
                'meta_title'=>$data['meta_title'],'meta_description'=>$data['meta_description'],'meta_keywords'=>$data['meta_keywords'],
                'status'=>$status]);
            return redirect('/admin/view-cms-pages')->
            with('flash_message_success','CMS Page has been updated successfully!');
        }
        $cmsPage = CmsPage::where('id',$id)->first();
        return view('admin.pages.edit_cms_page')->with(compact('cmsPage'));
    }

    public function viewCmsPages(){
        $cmsPages = CmsPage::get();
        return view('admin.pages.view_cms_pages')->with(compact('cmsPages'));
    }

    public function deleteCmsPage($id){
        CmsPage::where('id',$id)->delete();
        return redirect('/admin/view-cms-pages')->
        with('flash_message_success','CMS Page has been deleted successfully!');
    }

    public function cmsPage($url){

        //Redirect to 404 if CMS Page is disabled or does not exists
        $cmsPageCount = CmsPage::where(['url'=>$url,'status'=>1])->count();
        if($cmsPageCount>0){
            $cmsPageDetails = CmsPage::where('url',$url)->first();
            $meta_title = $cmsPageDetails->meta_title;
            $meta_description = $cmsPageDetails->meta_description;
            $meta_keywords = $cmsPageDetails->meta_keywords;
        }else{
            abort(404);
        }
        return view('pages.cms_page')->with(compact('cmsPageDetails','meta_title','meta_description','meta_keywords'));
    }

    public function contact(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

           /* $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email',
                'subject' => 'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

           NEL CASO VEDERE VIDEO 115
            */

            //Send Contact Email
            $email = "scaruso96@gmail.com";
            $messageData = [
                'name'=>$data['name'],
                'email'=>$data['email'],
                'subject'=>$data['subject'],
                'comment'=>$data['message']
            ];
            Mail::send('emails.enquiry',$messageData,function($message)use($email){
                $message->to($email)->subject('Richiesta per Justplay');
            });
            return redirect()->back()->with('flash_message_success','La tua richiesta è stata inoltrata con successo. <br>
                                Risponderemo al più presto. ');
        }
        //Meta Tags
        $meta_title = "Contattaci - Justplay";
        $meta_description = "Contattaci per ogni problema col nostro sito o con i nostri prodotti!";
        $meta_keywords = "contact us, queries";

        return view('pages.contact')->with(compact('meta_title','meta_description','meta_keywords'));
    }
}
