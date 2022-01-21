<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::match(['get','post'],'/admin','AdminController@login');

Route::get('/home', 'HomeController@index')->name('home');

//Index Page
Route::get('/','IndexController@index');

//Category/Listing Page
Route::get('/products/{url}','ProductsController@products');

//Product Detail Page
Route::get('product/{id}','ProductsController@product');

//Add to Cart Route
Route::match(['get','post'],'/add-cart','ProductsController@addtocart');

//Cart Page
Route::match(['get','post'],'/cart','ProductsController@cart');

//Delete Product from Cart
Route::get('/cart/delete-product/{id}','ProductsController@deleteCartProduct');

//Update Product Quantity in Cart
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');

//Apply Coupon
Route::post('/cart/apply-coupon','ProductsController@applyCoupon');

//User Login/Register Page
Route::get('/login-register','UsersController@userLoginRegister');

//Forgot Password
Route::match(['get','post'],'forgot-password','UsersController@forgotPassword');

//User Logout
Route::get('/user-logout','UsersController@logout');

//User Login
Route::post('/user-login','UsersController@login');

//User Register Form Submit
Route::post('/user-register','UsersController@register');

//Confirm Account
Route::get('confirm/{code}','UsersController@confirmAccount');

//Search Products
Route::post('/search-products','ProductsController@searchProducts');

//PEGI Products
Route::post('/search-products-pegi','ProductsController@searchProductsPegi');

//Check If User already exists
Route::match(['GET','POST'],'/check-email','UsersController@checkEmail');

//Check CAP
Route::post('/check-pincode','ProductsController@checkPincode');

//Check Subscriber Email
Route::post('/check-subscriber-email','NewsletterController@checkSubscriber');

//Add Subscriber Email
Route::post('/add-subscriber-email','NewsletterController@addSubscriber');

//All Routes after login
Route::group(['middleware'=>['frontlogin']],function (){
    //User Account Page
    Route::match(['get','post'],'account','UsersController@account');
    //Check User Current Password
    Route::post('/check-user-pwd','UsersController@chkUserPassword');
    //Update User Password
    Route::post('/update-user-pwd','UsersController@updatePassword');
    //Checkout Page
    Route::match(['get','post'],'checkout','ProductsController@checkout');
    // Oder Review Page
    Route::match(['get','post'],'/order-review','ProductsController@orderReview');
    //Place Order
    Route::match(['get','post'],'/place-order','ProductsController@placeOrder');
    //Thanks Page
    Route::get('/thanks','ProductsController@thanks');
    //Paypal Page
    Route::get('/paypal','ProductsController@paypal');
    //User Order Page
    Route::get('/orders','ProductsController@userOrders');
    //User Ordered Products Page
    Route::get('/orders/{id}','ProductsController@userOrderDetails');
    //Wish list page
    Route::match(['get','post'],'wish-list','ProductsController@wishList');
    // Delete product from wish list
    Route::get('/wish-list/delete-product/{id}','ProductsController@deleteWishlistProduct');
});

Route::group(['middleware'=>['adminlogin']],function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/settings','AdminController@settings');
    Route::get('/admin/check-pwd','AdminController@chkPassword');
    Route::match(['get','post'], '/admin/update-pwd','AdminController@updatePassword');

    // Categorie Routes (Admin)
    Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
    Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
    Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
    Route::get('/admin/view-categories','CategoryController@viewCategories');

    // Products Routes
    Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
    Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
    Route::get('/admin/view-products','ProductsController@viewProducts');
    Route::get('/admin/export-products','ProductsController@exportProducts');
    Route::get('/admin/delete-product/{id}','ProductsController@deleteProduct');
    Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');

    //Coupon
    Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
    Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
    Route::get('/admin/view-coupons','CouponsController@viewCoupons');
    Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');

    //Admin Orders Routes
    Route::get('/admin/view-orders','ProductsController@viewOrders');

    //Admin Orders Charts Route
    Route::get('/admin/view-orders-charts','ProductsController@viewOrdersCharts');

    //Admin Order Details Route
    Route::get('/admin/view-order/{id}','ProductsController@viewOrderDetails');

    //Order Invoice
    Route::get('/admin/view-order-invoice/{id}','ProductsController@viewOrderInvoice');

    //PDF Invoice
    Route::get('/admin/view-pdf-invoice/{id}','ProductsController@viewPDFInvoice');

    //Update Order Status
    Route::post('/admin/update-order-status','ProductsController@updateOrderStatus');

    //Admin User Route
    Route::get('/admin/view-users','UsersController@viewUsers');

    //Admin User Charts Route
    Route::get('/admin/view-users-charts','UsersController@viewUsersCharts');

    //Admin User Countries Charts Route
    Route::get('/admin/view-users-countries-charts','UsersController@viewUsersCountriesCharts');

    //Export Users Route
    Route::get('/admin/export-users','UsersController@exportUsers');

    //Admins/Sub-Admins View
    Route::get('/admin/view-admins','AdminController@viewAdmins');

    //Add Admins/Sub-Admins View
    Route::match(['get','post'],'/admin/add-admin','AdminController@addAdmin');

    //Edit Admins/Sub-Admins View
    Route::match(['get','post'],'/admin/edit-admin/{id}','AdminController@editAdmin');

    //Add CMS Route
    Route::match(['get','post'],'/admin/add-cms-page','CmsController@addCmsPage');

    //Edit CMS Route
    Route::match(['get','post'],'/admin/edit-cms-page/{id}','CmsController@editCmsPage');

    //View CMS Pages Route
    Route::get('/admin/view-cms-pages','CmsController@viewCmsPages');

    //Delete CMS Route
    Route::get('/admin/delete-cms-page/{id}','CmsController@deleteCmsPage');

    //Currencies Routes
    //Add Currency Route
    Route::match(['get','post'],'admin/add-currency','CurrencyController@addCurrency');

    //Edit Currency Route
    Route::match(['get','post'],'/admin/edit-currency/{id}','CurrencyController@editCurrency');

    //View Currencies Pages Route
    Route::get('/admin/view-currencies','CurrencyController@viewCurrencies');

    //Delete Currency Route
    Route::get('/admin/delete-currency/{id}','CurrencyController@deleteCurrency');

    //View Shipping Charges
    Route::get('/admin/view-shipping','ShippingController@viewShipping');

    //Update Shipping Charges
    Route::match(['get','post'],'/admin/edit-shipping/{id}','ShippingController@editShipping');

    //View Newsletter Subscribers
    Route::get('admin/view-newsletter-subscribers','NewsletterController@viewNewsletterSubscribers');

    //Update Newsletter Status
    Route::get('admin/update-newsletter-status/{id}/{status}','NewsletterController@updateNewsletterStatus');

    //Delete Newsletter
    Route::get('admin/delete-newsletter-email/{id}','NewsletterController@deleteNewsletterEmail');

    //Export Newsletter Emails
    Route::get('/admin/export-newsletter-emails','NewsletterController@exportNewsletterEmails');
});


Route::get('/logout', 'AdminController@logout');

//Display Contact Page
Route::match(['get','post'],'/page/contact','CmsController@contact');

//Display CMS Page
Route::match(['get','post'],'/page/{url}','CmsController@cmsPage');


