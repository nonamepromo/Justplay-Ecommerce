<?php

namespace App\Http\Controllers;


use App\Exports\productsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Auth;
use Dompdf\Dompdf;
use Session;
use Image;
use App\Country;
use App\User;
use App\Order;
use App\OrdersProduct;
use App\Category;
use App\Product;
use App\Coupon;
use App\DeliveryAddress;
use DB;
use Carbon\Carbon;

class ProductsController extends Controller
{
    public function addProduct(Request $request){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['category_id'])) {
                return redirect()->back()->with('flash_message_error', 'Under Category is missing!');
            }
            $product = new Product();
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            if(!empty($data['description'])){
                $product->description = $data['description'];
            }else{
                $product->description = '';
            }
            $product->price = $data['price'];

            // Upload Image
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->resize(1468,1465)->save($large_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($medium_image_path);
                    Image::make($image_tmp)->resize(100,100)->save($small_image_path);

                    //Store image name in products table
                    $product->image = $filename;
                }
            }
            $product->stock = $data['stock'];
            if(empty($data['feature_item'])){
                $feature_item = '0';
            }else{
                $product->feature_item = $data['feature_item'];
            }
            $product->save();
            //return redirect()->back()->with('flash_message_success','Product has been added successfully!');
            return redirect('/admin/view-products')->with('flash_message_success','Il prodotto è stato aggiunto correttamente!');
        }

        //Categories drop down start
        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option selected disabled></option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                $categories_dropdown .= "<option value = '".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }
        //Categories drop down ends
        return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }

    public function editProduct(Request $request, $id = null){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        if($request->isMethod('post')){
            $data = $request->all();

            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($medium_image_path);
                    Image::make($image_tmp)->resize(100,100)->save($small_image_path);
                }
            }else{
                $filename=$data['current_image'];
            }
            if(empty($data['description'])){
                $data['description']='';
            }
            if(empty($data['feature_item'])){
                $feature_item = '0';
            }else{
                $feature_item = '1';
            }

            Product::where(['id'=>$id])->update(['category_id'=>$data['category_id'],
                'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],
                'description'=>$data['description'],
                'price'=>$data['price'],'stock'=>$data['stock'],'feature_item'=>$feature_item,
                'image'=>$filename]);
            return redirect('/admin/view-products')->with('flash_message_success','Product has been updates successfully!');
        }

        //Get Product Details
        $productDetails = Product::where(['id'=>$id])->first();
        //Categories drop down start
        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option selected disabled></option>";
        foreach($categories as $cat){
            if($cat->id==$productDetails->category_id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                if($sub_cat->id==$productDetails->category_id){
                    $selected = "selected";
                }else{
                    $selected = "";
                }
                $categories_dropdown .= "<option value = '".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }
        //Categories drop down ends
        return view('admin.products.edit_product')->with(compact('productDetails','categories_dropdown'));
    }

    public function viewProducts(Request $request,$id=null){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        $products = Product::orderby('id')->get();
        $products = json_decode(json_encode($products));
        foreach ($products as $key => $val){
            $category_name = Category::where(['id'=>$val->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        //echo "<pre>"; print_r($products); die;
        return view('admin.products.view_products')->with(compact('products'));
    }

    public function deleteProduct(Request $request,$id=null){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        Product::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Product has been deleted successfully!');
    }

    public function deleteProductImage(Request $request,$id = null){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }

        //Prende il nome dell'immagine del prodotto
        $productImage = Product::where(['id'=>$id])->first();

        //Si trova il path dell'immagine
        $small_image_path = 'images/backend_images/products/small/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $large_image_path = 'images/backend_images/products/large/';


        //Elimina le immagini dal path
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }

        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }

        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        Product::where(['id'=>$id])->update(['image'=>'']);

        return redirect()->back()->with('flash_message_success','Product Image has been deleted successfully!');
    }

    public function products($url = null){

        //Mostra la pagina 404 se l'url della categoria non esiste
        $categoryCount = Category::where(['url'=>$url])->count();
        if($categoryCount==0){
            abort(404);
        }

        //Get all categories and subcategories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $categoryDetails = Category::where(['url' => $url])->first();
        if($categoryDetails->parent_id==0){
            //If url is main category url
            $subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
            $subCategories = json_decode(json_encode($subCategories));
            foreach ($subCategories as $subcat){
                $cat_ids[] = $subcat->id;
            }
            $productsAll = Product::whereIn('category_id', $cat_ids)->get();
        }else{
            //If url is sub category url
            $productsAll = Product::where(['category_id' => $categoryDetails->id])->get();
        }
        $meta_title = $categoryDetails->meta_title;
        $meta_description = $categoryDetails->meta_description;
        $meta_keywords = $categoryDetails->meta_keywords;
        return view('products.listing')->with(compact('categories','categoryDetails','productsAll','meta_title',
            'meta_description','meta_keywords'));
    }

    public function searchProducts(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $categories = Category::with('categories')->where(['parent_id' => 0])->get();
            $search_product = $data['product'];
            /*$productsAll = Product::where('product_name', 'like', '%' . $search_product . '%')
                ->orwhere('product_code', $search_product)->get(); */

            $productsAll = Product::where(function ($query) use($search_product){
                $query->where('product_name','like','%'.$search_product.'%')->
                orWhere('product_code','like','%'.$search_product.'%')->
                orWhere('description','like','%'.$search_product.'%');
            })->get();



            return view('products.listing')->with(compact('categories', 'productsAll', 'search_product'));
        }
    }

    public function product($id = null){
        //Get Product Details
        $productDetails = product::where('id',$id)->first();
        $productDetails = json_decode(json_encode($productDetails));

        $relatedProducts = Product::where('id','!=',$id)->where(['category_id'=>$productDetails->category_id])->get();

        //Get all categories and subcategories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $total_stock = Product::where('id',$id)->sum('stock');
        $meta_title = $productDetails->product_name;
        $meta_description = $productDetails->description;
        $meta_keywords = $productDetails->product_name;

        return view('products.detail')->with(compact('productDetails','categories','total_stock','relatedProducts',
            'meta_title','meta_description','meta_keywords'));
    }

    public function addtocart(Request $request){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();

        if(!empty($data['wishListButton']) && $data['wishListButton']=="Wish List") {
            //Check User is login or not
            if (!Auth::check()) {
                return redirect()->back()->with('flash_message_error', 'Per favore effettua il login per aggiungere un oggetto alla tua lista desideri!');
            }

            //Get product price
            $proPrice = Product::where(['product_code' => $data['product_code']])->first();
            $product_price = $proPrice->price;

            //Get user email
            $user_email = Auth::user()->email;

            //Set quantity as 1
            $quantity = 1;

            //Get current date
            $created_at = Carbon::now();

            $wishListCount = DB::table('wish_list')->where(['user_email'=>$user_email,'product_id'=>$data['product_id'],
                'product_code' => $data['product_code']])->count();

            if($wishListCount>0){
                return redirect()->back()->with('flash_message_error','Il prodotto è già nella lista desideri!');
            }else {

                //Insert product in wish list
                DB::table('wish_list')->insert(['product_id' => $data['product_id'], 'product_name' => $data['product_name'],
                    'product_code' => $data['product_code'], 'price' => $product_price, 'quantity' => $quantity, 'user_email' => $user_email,
                    'created_at' => $created_at]);
                return redirect()->back()->with('flash_message_success', 'Il prodotto è stato aggiunto alla lista deisideri!');
            }

        }else{

            //If product addedd from wish list
            if(!empty($data['cartButton']) && $data['cartButton']=="Add to Cart") {
                $data['quantity']=1;
            }
            //Check Product Stock is available or not
            $getProductStock = Product::where(['product_code' => $data['product_code']])->first();

            if ($getProductStock->stock < $data['quantity']) {
                return redirect()->back()->with('flash_message_error', 'Quantità non disponibile!');
            }

            if (empty(Auth::user()->email)) {
                $data['user_email'] = '';
            } else {
                $data['user_email'] = Auth::user()->email;
            }

            $session_id = Session::get('session_id');
            if (empty($session_id)) {
                $session_id = str_random(40);
                Session::put('session_id', $session_id);
            }

            if (empty(Auth::check())) {
                $countProducts = DB::table('cart')->where(['product_id' => $data['product_id'],
                    'product_name' => $data['product_name'], 'product_code' => $data['product_code'], 'session_id' => $session_id])->count();

                if ($countProducts > 0) {
                    return redirect()->back()->with('flash_message_error', 'Il prodotto è già presente nel carrello!');
                }
            } else {
                $countProducts = DB::table('cart')->where(['product_id' => $data['product_id'],
                    'product_name' => $data['product_name'], 'product_code' => $data['product_code'],
                    'user_email' => $data['user_email']])->count();

                if ($countProducts > 0) {
                    return redirect()->back()->with('flash_message_error', 'Il prodotto è già presente nel carrello!');
                }
            }

            DB::table('cart')->insert(['product_id' => $data['product_id'], 'product_name' => $data['product_name'],
                'product_code' => $data['product_code'], 'price' => $data['price'], 'quantity' => $data['quantity'],
                'user_email' => $data['user_email'], 'session_id' => $session_id]);


            return redirect('cart')->with('flash_message_success', 'Il prodotto è stato aggiunto al carrello!');
        }

    }

    public function cart(){
        if(Auth::check()){
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        }else{
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        }
        foreach ($userCart as $key => $product) {
            $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        $meta_title = "Carrello | Justplay";
        $meta_description = "Guarda Carrello | Justplay";
        $meta_keywords = "carrello, ecommerce, Justplay";
        return view('products.cart')->with(compact('userCart','meta_title','meta_description','meta_keywords'));
    }

    public function wishList(){
        if(Auth::check()) {
            $user_email = Auth::user()->email;
            $userWishlist = DB::table('wish_list')->where('user_email', $user_email)->get();
            foreach ($userWishlist as $key => $product) {
                $productDetails = Product::where('id', $product->product_id)->first();
                $userWishlist[$key]->image = $productDetails->image;
            }
        }else{
            $userWishlist = array();
        }
        $meta_title = "Lista Desideri | Justplay";
        $meta_description = "Guarda La Tua Lista Desideri | Justplay";
        $meta_keywords = "wish list, ecommerce, Justplay";
        return view('products.wish_list')->with(compact('userWishlist','meta_title','meta_description','meta_keywords'));
    }

    public function deleteCartProduct($id = null){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id',$id)->delete();
        return redirect('cart')->with('flash_message_success','Il prodotto è stato eliminato dal carrello!');
    }

    public function updateCartQuantity($id=null,$quantity=null){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $getCartDetails = DB::table('cart')->where('id',$id)->first();
        $getAttributeStock = Product::where('product_code',$getCartDetails->product_code)->first();
        echo $getAttributeStock->stock; echo "--";
        $updated_quantity = $getCartDetails->quantity+$quantity;
        if($getAttributeStock->stock >= $updated_quantity){
            DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
            return redirect('cart')->with('flash_message_success','La quantità è stata aggiornata con successo!');
        }else {
            return redirect('cart')->with('flash_message_error', 'La quantità richiesta non è disponibile!');
        }
    }

    public function applyCoupon(Request $request){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();
        $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();
        if($couponCount == 0) {
            return redirect()->back()->with('flash_message_error', 'Coupon is not valid');
        }else{
            //Get Coupon Details
            $couponDetails = Coupon::where('coupon_code',$data['coupon_code'])->first();
            //If coupon is inactive
            if($couponDetails->status==0){
                return redirect()->back()->with('flash_message_error', 'Coupon is not valid');
            }
            //If coupon Expired
            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');
            if($expiry_date < $current_date){
                return redirect()->back()->with('flash_message_error', 'Il Coupon è scaduto');
            }

            //Get Cart Total Amount
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();

            if(Auth::check()){
                $user_email = Auth::user()->email;

            }else{
                $session_id = Session::get('session_id');
                $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
            }


            $total_amount = 0;
            foreach ($userCart as $item){
                $total_amount = $total_amount + ($item->price * $item->quantity);
            }

            //Check if amount type is Fixed or Percentage
            if($couponDetails->amount_type=="Fixed"){
                $couponAmount = $couponDetails->amount;
            }else{
                $couponAmount = $total_amount * ($couponDetails->amount/100);
            }

            //Add Coupon Code & Amount in Session
            Session::put('CouponAmount',$couponAmount);
            Session::put('CouponCode',$data['coupon_code']);

            return redirect()->back()->with('flash_message_success', 'Coupon applicato con successo!');

        }
    }

    public function checkout(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::find($user_id);
        $countries = Country::get();

        //Check if Shipping address exist
        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        $shippingDetails = array();
        if($shippingCount>0) {
            $shippingDetails = DeliveryAddress::where('user_id', $user_id)->first();
        }

        //Update cart table with user email
        $session_id = Session::get('session_id');
        DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);

        if($request->isMethod('post')) {
            $data = $request->all();

            //Return To Checkout Page if any of the field is empty
            if(empty($data['billing_name']) || empty($data['billing_address']) || empty($data['billing_city']) || empty($data['billing_state']) ||
                empty($data['billing_country']) || empty($data['billing_pincode']) || empty($data['billing_mobile']) || empty($data['shipping_name']) ||
                empty($data['shipping_address']) || empty($data['shipping_city']) || empty($data['shipping_state']) || empty($data['shipping_country']) ||
                empty($data['shipping_pincode']) || empty($data['shipping_mobile'])){
            return redirect()->back()->with('flash_message_error','Riempi tutti i campi!');
            }

            //Update User Details
            User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],'city'=>$data['billing_city'],
                'state'=>$data['billing_state'],'pincode'=>$data['billing_pincode'],'country'=>$data['billing_country'],'mobile'=>$data['billing_mobile']]);

            if($shippingCount>0){
            //Update Shipping Address
                DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'],
                    'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],'pincode'=>$data['shipping_pincode'],
                    'country'=>$data['shipping_country'],'mobile'=>$data['shipping_mobile']]);
            }else{
                //Add new Shipping Address
                $shipping = new DeliveryAddress;
                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->city = $data['shipping_city'];
                $shipping->state = $data['shipping_state'];
                $shipping->pincode = $data['shipping_pincode'];
                $shipping->country = $data['shipping_country'];
                $shipping->mobile = $data['shipping_mobile'];
                $shipping->save();
            }

            $billincodeCount = DB::table('pincodes')->where('pincode',$data['billing_pincode'])->count();
            if($billincodeCount==0){
                return redirect()->back()->with('flash_message_error','La tua posizione non è disponibile per la fatturazione!');
            }

            $pincodeCount = DB::table('pincodes')->where('pincode',$data['shipping_pincode'])->count();
            if($pincodeCount==0){
                return redirect()->back()->with('flash_message_error','La tua posizione non è disponibile per la spedizione!');
            }

            return redirect()->action('ProductsController@orderReview');
        }
        $meta_title = "Checkout | Justplay";
        return view('products.checkout')->with(compact('countries', 'userDetails','shippingDetails','meta_title'));
    }

    public function orderReview(){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id',$user_id)->first();
        $shippingDetails = DeliveryAddress::where('user_id', $user_id)->first();
        $shippingDetails = json_decode(json_encode($shippingDetails));
        $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        foreach ($userCart as $key => $product) {
            $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }

        //Shipping Charges
        $shippingCharges = Product::getShippingCharges($shippingDetails->country);
        Session::put('ShippingCharges',$shippingCharges);

        $meta_title = "Riepilogo Ordine | Justplay";
        return view('products.order_review')->with(compact('userDetails','shippingDetails','userCart','meta_title','shippingCharges'));
    }

    public function placeOrder(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;

            //Prevenire Out of Stock
            $userCart = DB::table('cart')->where('user_email',$user_email)->get();
            foreach ($userCart as $cart){
                $product_stock = Product::getProductStock($cart->product_code);
                if($product_stock==0){
                    Product::deleteCartProduct($cart->product_id,$user_email);
                    return redirect('/cart')->with('flash_message_error','Uno dei prodotti nel carrello è terminato, lo abbiamo rimosso per te!');
                }
                if($cart->quantity>$product_stock){
                    return redirect('/cart')->with('flash_message_error','Riduci la quantità di uno dei prodotti e prova di nuovo!');
                }
            }

            //SI PRENDE L'INDIRIZZO DELL'UTENTE
            $shippingDetails = DeliveryAddress::where(['user_email'=>$user_email])->first();

            $pincodeCount = DB::table('pincodes')->where('pincode',$shippingDetails->pincode)->count();
            if($pincodeCount==0){
                return redirect()->back()->with('flash_message_error','La tua posizione non è disponibile per la spedizione!');
            }

            if(empty(Session::get('CouponCode'))){
                $coupon_code = '';
            }else{
                $coupon_code = Session::get('CouponCode');
            }

            if(empty(Session::get('CouponAmount'))){
                $coupon_amount = '';
            }else{
                $coupon_amount = Session::get('CouponAmount');
            }


            $grand_total = Product::getGrandTotal();

            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->city = $shippingDetails->city;
            $order->state = $shippingDetails->state;
            $order->pincode = $shippingDetails->pincode;
            $order->country = $shippingDetails->country;
            $order->mobile = $shippingDetails->mobile;
            $order->coupon_code = $coupon_code;
            $order->coupon_amount = $coupon_amount;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->shipping_charges = Session::get('ShippingCharges');
            $order->grand_total = $grand_total;
            $order->save();

            $order_id = DB::getPdo()->lastInsertId();

            $cartProducts = DB::table('cart')->where(['user_email'=>$user_email])->get();
            foreach($cartProducts as $pro){
                $cartPro = new OrdersProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_code = $pro->product_code;
                $cartPro->product_name = $pro->product_name;
                $cartPro->product_price = $pro->price;
                $cartPro->product_qty = $pro->quantity;
                $cartPro->save();

                //Reduce Stock Script
                $getProductStock = Product::where('product_code',$pro->product_code)->first();
                $newStock = $getProductStock->stock - $pro->quantity;
                if($newStock<0){
                    $newStock = 0;
                }
                Product::where('product_code',$pro->product_code)->update(['stock'=>$newStock]);
                //Fine
            }
            Session::put('order_id',$order_id);
            Session::put('grand_total',$grand_total);

            if($data['payment_method']=="COD"){

                $productDetails = Order::with('orders')->where('id',$order_id)->first();
                $productDetails = json_decode(json_encode($productDetails),true);


                $userDetails = User::where('id',$user_id)->first();
                $userDetails = json_decode(json_encode($userDetails),true);

                /*Code for Order Email Start */
                $email = $user_email;
                $messageData = [
                    'email' => $email,
                    'name' => $shippingDetails->name,
                    'order_id' => $order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userDetails
                ];
                Mail::send('emails.order',$messageData,function($message) use($email){
                    $message->to($email)->subject('Ordine Piazzato - Justplay');
                });
                /*Code for Order Email Ends */
                Session::forget('CouponAmount');
                Session::forget('CouponCode');
                //COD Redirect user to thanks page after saving order
                return redirect('/thanks');
            }else{
                Session::forget('CouponAmount');
                Session::forget('CouponCode');
                //Paypal
                return redirect('/paypal');
            }
        }
    }

    public function thanks(Request $request){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        return view('orders.thanks');
    }

    public function paypal(Request $request){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        return view('orders.paypal');
    }

    public function userOrders(){
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        return view('orders.user_orders')->with(compact('orders'));
    }

    public function userOrderDetails($order_id){
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        return view('orders.user_order_details')->with(compact('orderDetails'));
    }

    public function viewOrders(){
        if(Session::get('adminDetails')['orders_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        $orders = Order::with('orders')->orderBy('id','Desc')->get();
        $orders = json_decode(json_encode($orders));

        return view('admin.orders.view_orders')->with(compact('orders'));
    }

    public function viewOrderDetails($order_id){
        if(Session::get('adminDetails')['orders_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('admin.orders.order_details')->with(compact('orderDetails','userDetails'));
    }

    public function viewOrderInvoice($order_id){
        if(Session::get('adminDetails')['orders_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('admin.orders.order_invoice')->with(compact('orderDetails','userDetails'));
    }

    public function viewPDFInvoice($order_id){
        if(Session::get('adminDetails')['orders_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        $output =  '<!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="utf-8">
            <title>Example 1</title>
            <style>
            .clearfix:after {
          content: "";
          display: table;
          clear: both;
        }

        a {
          color: #5D6975;
          text-decoration: underline;
        }

        body {
          position: relative;
          width: 21cm;
          height: 29.7cm;
          margin: 0 auto;
          color: #001028;
          background: #FFFFFF;
          font-family: Arial, sans-serif;
          font-size: 12px;
          font-family: Arial;
        }

        header {
          padding: 10px 0;
          margin-bottom: 30px;
        }

        #logo {
          text-align: center;
          margin-bottom: 10px;
        }

        #logo img {
          width: 90px;
        }

        h1 {
          border-top: 1px solid  #5D6975;
          border-bottom: 1px solid  #5D6975;
          color: #5D6975;
          font-size: 2.4em;
          line-height: 1.4em;
          font-weight: normal;
          text-align: center;
          margin: 0 0 20px 0;
          background: url(/public/images/backend_images/dimension.png);
        }

        #project {
          float: left;
        }

        #project span {
          color: #5D6975;
          text-align: right;
          width: 52px;
          margin-right: 10px;
          display: inline-block;
          font-size: 0.8em;
        }

        #company {
          float: right;
          text-align: right;
        }

        #project div,
        #company div {
          white-space: nowrap;
        }

        table {
          width: 100%;
          border-collapse: collapse;
          border-spacing: 0;
          margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
          background: #F5F5F5;
        }

        table th,
        table td {
          text-align: center;
        }

        table th {
          padding: 5px 20px;
          color: #5D6975;
          border-bottom: 1px solid #C1CED9;
          white-space: nowrap;
          font-weight: normal;
        }

        table .service,
        table .desc {
          text-align: left;
        }

        table td {
          padding: 20px;
          text-align: right;
        }

        table td.service,
        table td.desc {
          vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
          font-size: 1.2em;
        }

        table td.grand {
          border-top: 1px solid #5D6975;;
        }

        #notices .notice {
          color: #5D6975;
          font-size: 1.2em;
        }

        footer {
          color: #5D6975;
          width: 100%;
          height: 30px;
          position: absolute;
          bottom: 0;
          border-top: 1px solid #C1CED9;
          padding: 8px 0;
          text-align: center;
        }
            </style>
          </head>
          <body>
            <header class="clearfix">
              <div id="logo">
                <img src="images/backend_images/logo.png">
              </div>
              <h1>Ordine Numero: '.$orderDetails->id.'</h1>
              <div id="project" class="clearfix">
              <div><span>ID Ordine: </span> '.$orderDetails->id.'</div>
                <div><span>Data Ordine: </span> '.$orderDetails->created_at.'</div>
                <div><span>Ammontare Ordine: </span> '.$orderDetails->grand_total.'</div>
                <div><span>Stato Ordine: </span> '.$orderDetails->order_status.'</div>
                <div><span>Metodo di Pagamento: </span> '.$orderDetails->payment_method.'</div>
              </div>
              <div id="project" style="float:right;">
                <div><strong>Indirizzo di Spedizione</strong></div>
                <div>Nome: </span> '.$orderDetails->name.'</div>
                <div>Indirizzo: </span> '.$orderDetails->address.'</div>
                <div>Città: </span> '.$orderDetails->city.', '.$orderDetails->state.'</div>
                <div>CAP: </span> '.$orderDetails->pincode.'</div>
                <div>Stato: </span> '.$orderDetails->country.'</div>
                <div>Telefono: </span> '.$orderDetails->mobile.'</div>
              </div>
            </header>
            <main>
              <table>
                <thead>
                 <tr>
                    <td><strong>Codice Prodotto</strong></td>
                    <td class="text-center"><strong>Nome</strong></td>
                    <td class="text-center"><strong>Prezzo</strong></td>
                    <td class="text-right"><strong>Quantità</strong></td>
                    <td class="text-right"><strong>Totale</strong></td>
                </tr>
                </thead>
                <tbody>';
                $Subtotal = 0;
                foreach($orderDetails->orders as $pro){
                            $output .= '<tr>
                                <td class="text-left">'.$pro->product_code.'</td>
                                <td class="text-center">'.$pro->product_name.'</td>
                                <td class="text-center">'.$pro->product_price.' €</td>
                                <td class="text-right">'.$pro->product_qty.'</td>
                                <td class="text-right">'.$pro->product_price * $pro->product_qty.' €</td>
                            </tr>';
                $Subtotal = $Subtotal + ($pro->product_price * $pro->product_qty);}
                    $output .= '<tr>
                    <td colspan="4">Totale Parziale</td>
                    <td class="total">'.$Subtotal.' €</td>
                  </tr>
                  <tr>
                    <td colspan="4">Spese di Spedizione</td>
                    <td class="total">'.$orderDetails->shipping_charges.' €</td>
                  </tr>
                  <tr>
                    <td colspan="4" class="grand total">Sconto Coupon</td>
                    <td class="grand total">'.$orderDetails->coupon_amount.' €</td>
                  </tr>
                  <tr>
                    <td colspan="4" class="grand total">Totale Finale</td>
                    <td class="grand total">'.$orderDetails->grand_total.' €</td>
                  </tr>
                </tbody>
              </table>
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
          </body>
        </html>';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($output);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();

    }

    public function updateOrderStatus(Request $request){
        if(Session::get('adminDetails')['orders_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
            return redirect()->back()->with('flash_message_success','Stato ordine aggiornato con successo!');
        }
    }

    public function checkPincode(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            echo $pincodeCount = DB::table('pincodes')->where('pincode',$data['pincode'])->count();
        }
    }

    public function exportProducts(){
        return Excel::download(new productsExport,'products.xlsx');
    }

    public function deleteWishlistProduct($id){
        DB::table('wish_list')->where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Prodotto rimosso dalla lista desideri!');
    }

    public function viewOrdersCharts(){
        $current_month_orders = Order::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->count();
        $last_month_orders = Order::whereYear('created_at',Carbon::now()->subYear(1))->whereMonth('created_at',Carbon::now()->subMonth(1))->count();
        $last_to_last_month_orders = Order::whereYear('created_at',Carbon::now()->subYear(1))->whereMonth('created_at',Carbon::now()->subMonth(2))->count();
        return view('admin.products.view_orders_charts')->with(compact('current_month_orders','last_month_orders',
            'last_to_last_month_orders'));
    }
}
