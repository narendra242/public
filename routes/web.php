<?php
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogcatController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\CkeditorController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\ContantController;
use App\Http\Controllers\Admin\GeneralController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\ResizeImageController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReturnController;
use App\Http\Controllers\Admin\StatesController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\PaypalController;
use App\Http\Controllers\User\RazorpayController;
use App\Http\Controllers\User\WishlistController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\HomeCurrencyController;
use App\Http\Controllers\LoginWithGoogleController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeProductController;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
 

 
Route::get('/dashboard', function () {
return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/clear-cache', function() {
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    Artisan::call('route:clear');
});
  
Route::get('/',[IndexController::class,'index'])->name('index');

Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
});


Route::get('authorized/google', [LoginWithGoogleController::class, 'redirectToGoogle']);
Route::get('authorized/google/callback', [LoginWithGoogleController::class, 'handleGoogleCallback']);

Route::get('/disclaimer',[AboutController::class,'disclaimer'])->name('disclaimer');

Route::get('/privacy-policy',[AboutController::class,'privacypolicy'])->name('privacy-policy');

Route::get('payment', [PaypalController::class, 'paypalpayment'])->name('create.payment');
Route::post('paypal/store', [PaypalController::class, 'paypalStore'])->name('paypal.store');
Route::get('cancel-payment',[PaypalController::class,'paymentCancel'])->name('cancel.payment');
Route::get('payment-success',[PaypalController::class,'paymentSuccess'])->name('success.payment');


Route::get('/how-to-order',[IndexController::class,'howtoorder'])->name('how-to-order');
Route::get('/page/{id}',[AboutController::class,'aboutus']);
Route::get('/products',[HomeProductController::class,'products'])->name('products');
Route::get('/products/{id}',[HomeProductController::class,'subcategories']);
Route::get('/product/{pid}',[HomeProductController::class,'productdetails']);
Route::get('/new-arrival',[HomeProductController::class,'NewArrival'])->name('new-arrival');
Route::get('/blog',[BlogsController::class,'blogs'])->name('blog');
Route::get('/blog/{id}',[BlogsController::class,'blogdetail']);
Route::get('/blogs/{id}',[BlogsController::class,'blogbycates']);
Route::get('/contact-us',[AboutController::class,'ContactUs'])->name('contact-us');

Route::get('/product/view/modal/{id}',[IndexController::class, 'ProductViewAjax']);
Route::post('/cart/data/store/{id}',[CartController::class, 'AddToCart']);
Route::get('/mycart',[CartPageController::class, 'MyCart'])->name('mycart');
Route::get('/user/get-cart-product',[CartPageController::class, 'GetCartProduct']);
Route::get('/user/cart-remove/{rowId}',[CartPageController::class, 'RemoveCartProduct']);
Route::get('/user/cart-allremove',[CartPageController::class, 'RemoveAllCartProduct']);
Route::get('/cart-increment/{rowId}',[CartPageController::class, 'CartIncrement']);
Route::get('/cart-decrement/{rowId}',[CartPageController::class, 'CartDecrement']);

Route::get('/product/mini/cart/',[CartController::class, 'AddMiniCart']);
Route::get('/minicart/product-remove/{rowId}',[CartController::class, 'RemoveMiniCart']);
Route::post('/add-to-wishlist/{id}',[CartController::class, 'AddToWishlist']);

Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'DistrictGetAjax']);
Route::get('/state-get/ajax/{district_id}', [CheckoutController::class, 'StateGetAjax']);
Route::post('/checkout/store', [CheckoutController::class, 'CheckOutStore'])->name('checkout.store');
Route::get('/currency/{id}',[HomeCurrencyController::class,'CurrencyChange'])->name('currency');

Route::post('/search', [IndexController::class, 'ProductSearch'])->name('product.search');
Route::post('/filter/product', [HomeProductController::class, 'FilterProducts'])->name('filter.product');

Route::get('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');

Route::post('paysuccess', [RazorpayController::class, 'razorPaySuccess'])->name('paysuccess');
Route::get('/cancel/orders', [AllUserController::class, 'CancelOrders'])->name('cancel.orders');
Route::get('/success/{rzpId?}/{amount?}',[RazorpayController::class, 'SuccessOrders'])->name('razorpay.success');
Route::get('razorpay/cancel', [RazorpayController::class, 'RazorCancel'])->name('razorpay.cancel');

Route::group(['prefix' => 'user','middleware' => ['user' => 'auth'],'namespace' => 'User'],
function(){
Route::get('/wishlist',[WishlistController::class, 'ViewWishlist'])->name('wishlist');
Route::get('/get-wishlist-product',[WishlistController::class, 'GetWishlistProduct'])->name('get-wishlist-product');
Route::get('/wishlist-remove/{id}',[WishlistController::class, 'RemoveWishlistProduct']);
Route::post('razorpay-payment',[RazorpayController::class,'store'])->name('razorpay.payment.store');
Route::get('/my/orders',[AllUserController::class, 'MyOrders'])->name('my.orders');
Route::get('/order_details/{order_id}', [AllUserController::class, 'OrderDetails']);
Route::get('/invoice_download/{order_id}', [AllUserController::class, 'InvoiceDownload']);
Route::post('/return/order/{order_id}', [AllUserController::class, 'ReturnOrder'])->name('return.order');
Route::get('/return/order/list', [AllUserController::class, 'ReturnOrderList'])->name('return.order.list');


/// Order Traking Route
Route::post('/order/tracking', [AllUserController::class, 'OrderTraking'])->name('order.tracking');
});


Route::get('/wholesale', [IndexController::class, 'wholesale'])->name('wholesale');
Route::get('/sale', [IndexController::class, 'sale'])->name('sale');
Route::get('/reviews', [IndexController::class, 'reviews'])->name('reviews');
Route::post('/sendpopup',[IndexController::class,'sendpopup'])->name('popup.send'); 
Route::post('/contact',[AboutController::class,'sendcontact'])->name('contact.send'); 
Route::post('/wholesale',[AboutController::class,'sendwholesale'])->name('wholesale.send'); 

Route::get('/store-locator', [IndexController::class, 'storelocator'])->name('store-locator');
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
Route::get('/change/password', [IndexController::class, 'UserChangePassword'])->name('change.password');
Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpadate'])->name('user.password.update');
Route::post('/review/store', [ReviewController::class, 'ReviewStore'])->name('review.store');


Route::get('/admin/dashboard', function () {
return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

require __DIR__.'/adminauth.php';


Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
Route::middleware('admin')->group(function(){    
 
Route::get('/', [HomeController::class,'index'])->name('admin.home');
Route::get('/banner',[BannerController::class,'banner'])->name('banner');
Route::get('/banner/create',[BannerController::class,'create'])->name('banner.create');
Route::post('/banner/store',[BannerController::class,'store'])->name('banner.store');
Route::get('/banner/changeStatus',[BannerController::class,'changeStatus']);
Route::get('/banner/edit/{id}',[BannerController::class,'edit'])->name('banner.edit');
Route::patch('/banner/update',[BannerController::class,'update'])->name('banner.update');
Route::get('/banner/delete/{id}',[BannerController::class,'delete'])->name('banner.delete');

Route::get('/contant',[ContantController::class,'contant'])->name('contant');
Route::get('/contant/create',[ContantController::class,'create'])->name('contant.create');
Route::post('/contant/store',[ContantController::class,'store'])->name('contant.store');
Route::get('/contant/changeStatus',[ContantController::class,'changeStatus']);
Route::get('/contant/edit/{id}',[ContantController::class,'edit'])->name('contant.edit');
Route::patch('/contant/update',[ContantController::class,'update'])->name('contant.update');
Route::get('/contant/delete/{id}',[ContantController::class,'delete'])->name('contant.delete');

Route::get('/cms',[CmsController::class,'cms'])->name('cms');
Route::get('/cms/create',[CmsController::class,'create'])->name('cms.create');
Route::post('/cms/store',[CmsController::class,'store'])->name('cms.store');
Route::get('/cms/changeStatus',[CmsController::class,'changeStatus']);
Route::get('/cms/edit/{id}',[CmsController::class,'edit'])->name('cms.edit');
Route::patch('/cms/update',[CmsController::class,'update'])->name('cms.update');
Route::get('/cms/delete/{id}',[CmsController::class,'delete'])->name('cms.delete');
Route::get('/cms/commonenquiry',[CmsController::class,'commonenquiry'])->name('common.enquiry');
Route::get('/cms/commondelete/{id}',[CmsController::class,'commondelete'])->name('common.delete');

Route::get('/testimonial',[TestimonialController::class,'testimonial'])->name('testimonial'); 
Route::get('/testimonial/create',[TestimonialController::class,'create'])->name('testimonial.create'); 
Route::post('/testimonial/store',[TestimonialController::class,'store'])->name('testimonial.store');
Route::get('/testimonial/changeStatus',[TestimonialController::class,'changeStatus']);
Route::get('/testimonial/edit/{id}',[TestimonialController::class,'edit'])->name('testimonial.edit');
Route::patch('/testimonial/update',[TestimonialController::class,'update'])->name('testimonial.update');
Route::get('/testimonial/delete/{id}',[TestimonialController::class,'delete'])->name('testimonial.delete');

Route::get('/general',[GeneralController::class,'general'])->name('general');
Route::get('/general/create',[GeneralController::class,'create'])->name('general.create');
Route::post('/general/store',[GeneralController::class,'store'])->name('general.store');
Route::get('/general/changeStatus',[GeneralController::class,'changeStatus']);
Route::get('/general/edit/{id}',[GeneralController::class,'edit'])->name('general.edit');
Route::patch('/general/update',[GeneralController::class,'update'])->name('general.update');
Route::get('/general/delete/{id}',[GeneralController::class,'delete'])->name('general.delete');


Route::get('/division',[DivisionController::class,'division'])->name('division');
Route::get('/division/create',[DivisionController::class,'create'])->name('division.create');
Route::post('/division/store',[DivisionController::class,'store'])->name('division.store');
Route::get('/division/changeStatus',[DivisionController::class,'changeStatus']);
Route::get('/division/edit/{id}',[DivisionController::class,'edit'])->name('division.edit');
Route::patch('/division/update',[DivisionController::class,'update'])->name('division.update');
Route::get('/division/delete/{id}',[DivisionController::class,'delete'])->name('division.delete');


Route::get('/district',[DistrictController::class,'district'])->name('district');
Route::get('/district/create',[DistrictController::class,'create'])->name('district.create');
Route::post('/district/store',[DistrictController::class,'store'])->name('district.store');
Route::get('/district/changeStatus',[DistrictController::class,'changeStatus']);
Route::get('/district/edit/{id}',[DistrictController::class,'edit'])->name('district.edit');
Route::patch('/district/update',[DistrictController::class,'update'])->name('district.update');
Route::get('/district/delete/{id}',[DistrictController::class,'delete'])->name('district.delete');

Route::get('/states',[StatesController::class,'states'])->name('states');
Route::get('/states/create',[StatesController::class,'create'])->name('states.create');
Route::post('/states/store',[StatesController::class,'store'])->name('states.store');
Route::get('/states/changeStatus',[StatesController::class,'changeStatus']);
Route::get('/states/edit/{id}',[StatesController::class,'edit'])->name('states.edit');
Route::patch('/states/update',[StatesController::class,'update'])->name('states.update');
Route::get('/states/delete/{id}',[StatesController::class,'delete'])->name('states.delete');
Route::get('/shipping/states/ajax/{division_id}', [StatesController::class, 'GetDistrict']);

Route::get('/category',[ProductCategoryController::class,'category'])->name('category');
Route::get('/category/create',[ProductCategoryController::class,'create'])->name('category.create');
Route::post('/category/store',[ProductCategoryController::class,'store'])->name('category.store');
Route::get('/category/changeStatus',[ProductCategoryController::class,'changeStatus']);
Route::get('/category/edit/{id}',[ProductCategoryController::class,'edit'])->name('category.edit');
Route::patch('/category/update',[ProductCategoryController::class,'update'])->name('category.update');
Route::get('/category/delete/{id}',[ProductCategoryController::class,'delete'])->name('category.delete');

Route::get('/product',[ProductController::class,'product'])->name('product');
Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
Route::post('/product/store',[ProductController::class,'store'])->name('product.store');
Route::get('/product/changeStatus',[ProductController::class,'changeStatus']);
Route::get('/product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
Route::patch('/product/update',[ProductController::class,'update'])->name('product.update');
Route::get('/product/delete/{id}',[ProductController::class,'delete'])->name('product.delete');
Route::get('/product/getimages/{id}',[ProductController::class,'getimages'])->name('product.getimages');
Route::post('/product/addimages', [ProductController::class,'addimages'])->name('product.addimages');
Route::get('/product/imgdelete/{id}',[ProductController::class,'imgdelete'])->name('product.imgdelete');
Route::get('/product/search',[ProductController::class,'search'])->name('product.search');
Route::post('/ckeditor/upload',[CkeditorController::class,'upload'])->name('ckeditor.upload');
Route::get('searchcolors', [ProductController::class, 'searchcolors'])->name('searchcolors');
Route::get('searchrelprods', [ProductController::class, 'searchrelprods'])->name('searchrelprods');

Route::get('/blogcat',[BlogcatController::class,'blogcat'])->name('blogcat');
Route::get('/blogcat/create',[BlogcatController::class,'create'])->name('blogcat.create');
Route::post('/blogcat/store',[BlogcatController::class,'store'])->name('blogcat.store');
Route::get('/blogcat/changeStatus',[BlogcatController::class,'changeStatus']);
Route::get('/blogcat/edit/{id}',[BlogcatController::class,'edit'])->name('blogcat.edit');
Route::patch('/blogcat/update',[BlogcatController::class,'update'])->name('blogcat.update');
Route::get('/blogcat/delete/{id}',[BlogcatController::class,'delete'])->name('blogcat.delete');
Route::post('/ckeditor/upload',"CkeditorController@upload")->name('ckeditor.upload');

Route::get('/blog',[BlogController::class,'blog'])->name('blog');
Route::get('/blog/create',[BlogController::class,'create'])->name('blog.create');
Route::post('/blog/store',[BlogController::class,'store'])->name('blog.store');
Route::get('/blog/changeStatus',[BlogController::class,'changeStatus']);
Route::get('/blog/edit/{id}',[BlogController::class,'edit'])->name('blog.edit');
Route::patch('/blog/update',[BlogController::class,'update'])->name('blog.update');
Route::get('/blog/delete/{id}',[BlogController::class,'delete'])->name('blog.delete');

Route::get('/size',[SizeController::class,'size'])->name('size');
Route::get('/size/create',[SizeController::class,'create'])->name('size.create');
Route::post('/size/store',[SizeController::class,'store'])->name('size.store');
Route::get('/size/changeStatus',[SizeController::class,'changeStatus']);
Route::get('/size/edit/{id}',[SizeController::class,'edit'])->name('size.edit');
Route::patch('/size/update',[SizeController::class,'update'])->name('size.update');
Route::get('/size/delete/{id}',[SizeController::class,'delete'])->name('size.delete');

Route::get('/color',[ColorController::class,'color'])->name('color');
Route::get('/color/create',[ColorController::class,'create'])->name('color.create');
Route::post('/color/store',[ColorController::class,'store'])->name('color.store');
Route::get('/color/changeStatus',[ColorController::class,'changeStatus']);
Route::get('/color/edit/{id}',[ColorController::class,'edit'])->name('color.edit');
Route::patch('/color/update',[ColorController::class,'update'])->name('color.update');
Route::get('/color/delete/{id}',[ColorController::class,'delete'])->name('color.delete');

Route::get('/brand',[BrandController::class,'brand'])->name('brand');
Route::get('/brand/create',[BrandController::class,'create'])->name('brand.create');
Route::post('/brand/store',[BrandController::class,'store'])->name('brand.store');
Route::get('/brand/changeStatus',[BrandController::class,'changeStatus']);
Route::get('/brand/edit/{id}',[BrandController::class,'edit'])->name('brand.edit');
Route::patch('/brand/update',[BrandController::class,'update'])->name('brand.update');
Route::get('/brand/delete/{id}',[BrandController::class,'delete'])->name('brand.delete');


Route::get('/tag',[TagController::class,'tag'])->name('tag');
Route::get('/tag/create',[TagController::class,'create'])->name('tag.create');
Route::post('/tag/store',[TagController::class,'store'])->name('tag.store');
Route::get('/tag/changeStatus',[TagController::class,'changeStatus']);
Route::get('/tag/edit/{id}',[TagController::class,'edit'])->name('tag.edit');
Route::patch('/tag/update',[TagController::class,'update'])->name('tag.update');
Route::get('/tag/delete/{id}',[TagController::class,'delete'])->name('tag.delete');

Route::get('/video',[VideoController::class,'video'])->name('video');
Route::get('/video/create',[VideoController::class,'create'])->name('video.create');
Route::post('/video/store',[VideoController::class,'store'])->name('video.store');
Route::get('/video/changeStatus',[VideoController::class,'changeStatus']);
Route::get('/video/edit/{id}',[VideoController::class,'edit'])->name('video.edit');
Route::patch('/video/update',[VideoController::class,'update'])->name('video.update');
Route::get('/video/delete/{id}',[VideoController::class,'delete'])->name('video.delete');

Route::get('/coupon',[CouponController::class,'coupon'])->name('coupon');
Route::get('/coupon/create',[CouponController::class,'create'])->name('coupon.create');
Route::post('/coupon/store',[CouponController::class,'store'])->name('coupon.store');
Route::get('/coupon/changeStatus',[CouponController::class,'changeStatus']);
Route::get('/coupon/edit/{id}',[CouponController::class,'edit'])->name('coupon.edit');
Route::patch('/coupon/update',[CouponController::class,'update'])->name('coupon.update');
Route::get('/coupon/delete/{id}',[CouponController::class,'delete'])->name('coupon.delete');


Route::get('/currency',[CurrencyController::class,'currency'])->name('currency');
Route::get('/currency/create',[CurrencyController::class,'create'])->name('currency.create');
Route::post('/currency/store',[CurrencyController::class,'store'])->name('currency.store');
Route::get('/currency/changeStatus',[CurrencyController::class,'changeStatus']);
Route::get('/currency/edit/{id}',[CurrencyController::class,'edit'])->name('currency.edit');
Route::patch('/currency/update',[CurrencyController::class,'update'])->name('currency.update');
Route::get('/currency/delete/{id}',[CurrencyController::class,'delete'])->name('currency.delete');

Route::get('/delete/orders/{order_id}', [OrderController::class, 'DeleteOrders'])->name('delete.orders');

Route::get('/pending/orders',[OrderController::class,'PendingOrders'])->name('pending-orders');
Route::get('/pending/details/{id}',[OrderController::class,'PendingOrdersDetails'])->name('pending.details');
Route::get('/confirmed/orders', [OrderController::class, 'ConfirmedOrders'])->name('confirmed-orders');
Route::get('/processing/orders', [OrderController::class, 'ProcessingOrders'])->name('processing-orders');
Route::get('/picked/orders', [OrderController::class, 'PickedOrders'])->name('picked-orders');
Route::get('/shipped/orders', [OrderController::class, 'ShippedOrders'])->name('shipped-orders');
Route::get('/delivered/orders', [OrderController::class, 'DeliveredOrders'])->name('delivered-orders');
Route::get('/cancel/orders', [OrderController::class, 'CancelOrders'])->name('cancel-orders');
Route::get('/pending/confirm/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending-confirm');
Route::get('/confirm/processing/{order_id}', [OrderController::class, 'ConfirmToProcessing'])->name('confirm.processing');
Route::get('/processing/picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processing.picked');
Route::get('/picked/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked.shipped');
Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered'])->name('shipped.delivered');
Route::get('/invoice/download/{order_id}', [OrderController::class, 'AdminInvoiceDownload'])->name('invoice.download');


Route::get('/reports/view',[ReportController::class,'ReportView'])->name('all-reports');
Route::post('/search/by/date', [ReportController::class, 'ReportByDate'])->name('search-by-date');
Route::post('/search/by/month', [ReportController::class, 'ReportByMonth'])->name('search-by-month');
Route::post('/search/by/year', [ReportController::class, 'ReportByYear'])->name('search-by-year');


Route::prefix('alluser')->group(function(){
Route::get('/view', [AdminUserController::class, 'AllUsers'])->name('all-users');
});

Route::prefix('return')->group(function(){
Route::get('/request', [ReturnController::class, 'ReturnRequest'])->name('return.request');
Route::get('/return/approve/{order_id}', [ReturnController::class, 'ReturnRequestApprove'])->name('return.approve');
Route::get('/all/request', [ReturnController::class, 'ReturnAllRequest'])->name('all.request');

});

Route::prefix('review')->group(function(){
Route::get('/pending', [ReviewController::class, 'PendingReview'])->name('pending.review');
Route::get('/approve/{id}', [ReviewController::class, 'ReviewApprove'])->name('review.approve');
Route::get('/all/review', [ReturnController::class, 'ReviewAllRequest'])->name('all.review');
Route::get('/publish', [ReviewController::class, 'PublishReview'])->name('publish.review');
Route::get('/delete/{id}', [ReviewController::class, 'DeleteReview'])->name('delete.review');
});

Route::prefix('stock')->group(function(){
Route::get('/product', [ProductController::class, 'ProductStock'])->name('product.stock');
});

Route::get('/resize/createsize',[ResizeImageController::class,'createsize'])->name('resize.createsize');
Route::post('/resize/storesize',[ResizeImageController::class,'storesize'])->name('resize.storesize');
Route::patch('/resize/updatesize',[ResizeImageController::class,'updatesize']);
Route::get('/resize/editsize/{id}',[ResizeImageController::class,'editsize'])->name('resize.editsize');
Route::get('/resize/deletesize/{id}',[ResizeImageController::class,'deletesize'])->name('resize.deletesize');
Route::get('searchtags', [TagController::class, 'searchtags'])->name('searchtags');

Route::get('/changepassword/create',[ChangePasswordController::class,'create'])->name('changepassword.create');
Route::post('/changepassword/store',[ChangePasswordController::class,'store'])->name('changepassword.store');
});
});