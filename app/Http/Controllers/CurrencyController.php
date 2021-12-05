<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;

class CurrencyController extends Controller
{
    public function addCurrency(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['status'])){$status=0;}else{$status=1;}
            $currency = new Currency;
            $currency->currency_code = $data['currency_code'];
            $currency->exchange_rate = $data['exchange_rate'];
            $currency->status = $status;
            $currency->save();
            return redirect('/admin/view-currencies')->with('flash_message_succes','Currency has been addedd successfully');

        }
        return view('admin.currencies.add_currency');
    }

    public function editCurrency(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['status'])){
                $status=0;
            }else{
                $status=1;
            }
            Currency::where('id',$id)->
            update(['currency_code'=>$data['currency_code'],'exchange_rate'=>$data['exchange_rate'],'status'=>$status]);
            return redirect('/admin/view-currencies')->with('flash_message_success','Currency has been updated successfully!');
        }
        $currencyDetails = Currency::where('id',$id)->first();
        return view('admin.currencies.edit_currency')->with(compact('currencyDetails'));
    }

    public function viewCurrencies(){
        $currencies = Currency::get();
        return view('admin.currencies.view_currencies')->with(compact('currencies'));
    }

    public function deleteCurrency($id){
        Currency::where('id',$id)->delete();
        return redirect('/admin/view-currencies')->
        with('flash_message_success','Currency Rate has been deleted successfully!');
    }
}
