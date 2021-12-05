<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;

class Product extends Model
{
    public static function cartCount(){
        if(Auth::check()){
            // User is logged in; We will use aut;
            $user_email = Auth::user()->email;
            $cartCount = DB::table('cart')->where('user_email',$user_email)->sum('quantity');
        }else{
            // User is not logged in; we will use session;
            $session_id = Session::get('session_id');
            $cartCount = DB::table('cart')->where('session_id',$session_id)->sum('quantity');
        }
        return $cartCount;
    }
    public static function productCount ( $cat_id){
        $catCount = Product::where(['category_id'=>$cat_id])->count();
        return($catCount);
    }
    public static function getCurrencyRates($price){
        $getCurrency = Currency::where('status',1)->get();
        foreach ($getCurrency as $currency){
            if ($currency->currency_code == "USD"){
                $USD_Rate = round($price/$currency->exchange_rate,2);
            }else if ($currency->currency_code == "GBP"){
                $GBP_Rate = round($price/$currency->exchange_rate, 2);
            }
        }
        $currenciesArr = array('USD_Rate'=>$USD_Rate,'GBP_Rate'=>$GBP_Rate);
        return $currenciesArr;
    }

    public static function getProductStock ($product_code){
        $getProductStock = Product::select('stock')->where(['product_code'=>$product_code])->first();
        return $getProductStock->stock;
    }

    public static function deleteCartProduct($product_id,$user_email){
        DB::table('cart')->where(['product_id'=>$product_id,'user_email'=>$user_email])->delete();
    }

    public static function getShippingCharges($country){
        $shippingDetails = ShippingCharge::where('country',$country)->first();
        $shipping_charges = $shippingDetails->shipping_charges;
        return $shipping_charges;
    }

    public static function getGrandTotal(){
        $getGrandTotal = "";
        $username = Auth::user()->email;
        $userCart = DB::table('cart')->where('user_email',$username)->get();
        $userCart = json_decode(json_encode($userCart),true);
        foreach ($userCart as $product){
            $productPrice = Product::where(['product_code'=>$product['product_code']])->first();
            $getQuantity = DB::table('cart')->select('quantity')->where(['product_code'=>$product['product_code']])->first();
            // Quantity find out end,
            $priceArray[] = $productPrice->price*$getQuantity->quantity;
        }
        $grandTotal = array_sum($priceArray) - Session::get('CouponAmount') + Session::get('ShippingCharges');
        return $grandTotal;
    }

}
