<?php

    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Artisan;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\Auth\ForgotPasswordController;
    use App\Http\Controllers\FrontendController;
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\MessageController;
    use App\Http\Controllers\CartController;
    use App\Http\Controllers\WishlistController;
    use App\Http\Controllers\OrderController;
    use App\Http\Controllers\ProductReviewController;
    use App\Http\Controllers\PostCommentController;
    use App\Http\Controllers\CouponController;
    use App\Http\Controllers\PayPalController;
    use App\Http\Controllers\NotificationController;
    use App\Http\Controllers\HomeController;
    use \UniSharp\LaravelFilemanager\Lfm;
    use App\Http\Controllers\Auth\ResetPasswordController;

    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\Auth\RegisterController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\AddressController;
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

    // CACHE CLEAR ROUTE
    Route::get('cache-clear', function () {
        Artisan::call('optimize:clear');
        // request()->session()->flash('success', 'Successfully cache cleared.');
        session()->flash('success', 'Successfully cache cleared.');
        return redirect()->back();
    })->name('cache.clear');


    // STORAGE LINKED ROUTE
    Route::get('storage-link',[AdminController::class,'storageLink'])->name('storage.link');

    Auth::routes([
        'register' => false,
    ]);
    

    Route::get('user/login', [FrontendController::class, 'login'])->name('login.form');
    Route::post('user/login', [FrontendController::class, 'loginSubmit'])->name('login.submit');
    Route::get('user/logout', [FrontendController::class, 'logout'])->name('user.logout');

    Route::get('register', [FrontendController::class, 'register'])->name('register.form');
    Route::post('user/register', [FrontendController::class, 'registerSubmit'])->name('register.submit');
   
    // Reset password
    Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    // Password Reset Routes
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    // Socialite
    Route::get('login/{provider}/', [LoginController::class, 'redirect'])->name('login.redirect');
    Route::get('login/{provider}/callback/', [LoginController::class, 'Callback'])->name('login.callback');

    Route::get('/', [FrontendController::class, 'home'])->name('home');

    // Sidebar Routes
    Route::get('/products/category/{slug}', [ProductController::class, 'byCategory'])->name('products.byCategory');
    Route::get('/products/producttype/{slug}', [ProductController::class, 'byProductType'])->name('products.byProductType');
    Route::get('/products/brand/{slug}', [ProductController::class, 'byBrand'])->name('products.byBrand');
    Route::get('/products/series/{slug}', [ProductController::class, 'bySeries'])->name('products.bySeries');
    Route::get('/products/featuredin/{slug}', [ProductController::class, 'byFeaturedIn'])->name('products.byFeaturedIn');
    Route::get('/products/character/{slug}', [ProductController::class, 'byCharacter'])->name('products.byCharacter');
    Route::get('/products/company/{slug}', [ProductController::class, 'byCompany'])->name('products.byCompany');
    Route::get('/products/scale/{slug}', [ProductController::class, 'byScale'])->name('products.byScale');
    Route::get('/products/size/{slug}', [ProductController::class, 'bySize'])->name('products.bySize');

    // Frontend Routes
    Route::get('/home', [FrontendController::class, 'index']);
    Route::get('/about', [FrontendController::class, 'aboutUs'])->name('about-us');
    Route::get('/featuredpreorders', [FrontendController::class, 'contact'])->name('contact');
    Route::get('/newarrivals', [FrontendController::class, 'blog'])->name('blog');
    Route::get('/sale', [FrontendController::class, 'sale'])->name('sale');
    Route::get('/help', [FrontendController::class, 'help'])->name('help');
    Route::get('/account', [FrontendController::class, 'account'])
    ->middleware('auth')
    ->name('account');

    Route::get('/account/orders', [OrderController::class, 'index'])->name('account.orders');

    Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
    Route::get('/privacy-policy', [FrontendController::class, 'privacy_policy'])->name('privacy-policy');
    Route::get('/terms-and-conditions', [FrontendController::class, 'terms_and_condition'])->name('terms-and-condition');
    Route::get('/preorders', [FrontendController::class, 'preorders'])->name('preorders');
    Route::get('/shipping', [FrontendController::class, 'shipping'])->name('shipping');
    Route::get('/cancellations', [FrontendController::class, 'cancellations'])->name('cancellations');
    Route::get('/returns', [FrontendController::class, 'returns'])->name('returns');
    Route::get('/payments', [FrontendController::class, 'payments'])->name('payments');

    Route::get('/orders', [FrontendController::class, 'orders'])->name('orders');
    Route::patch('/orders/{id}/cancel', [FrontendController::class, 'cancel'])->name('order.cancel');

    Route::get('/pre-order', [FrontendController::class, 'pre_order'])->name('pre-order');
    Route::get('/shipment', [FrontendController::class, 'shipment'])->name('shipment');

    Route::get('/address-book', [FrontendController::class, 'address_book'])->name('address-book');
    Route::get('/account/address/{id}/edit', [AddressController::class, 'edit'])->name('address.edit');
    Route::put('account/address/update/{id}', [AddressController::class, 'update'])->name('address.update');
    Route::delete('/address/{id}', [AddressController::class, 'destroy'])->name('address.delete');

    Route::get('/wallet', [FrontendController::class, 'wallet'])->name('wallet');
    
    Route::get('/change-password', [FrontendController::class, 'change_password'])->name('change-password');
    Route::post('/account/change-password', [FrontendController::class, 'update_password'])->name('change-password.update');

    Route::get('/new-address', [FrontendController::class, 'new_address'])->name('new-address');
    Route::post('/account/address/create', [AddressController::class, 'store'])->name('address.store');

    Route::get('/new-credit-card', [FrontendController::class, 'new_credit_card'])->name('new-credit-card');
    Route::get('/product-search', [FrontendController::class, 'product_search'])->name('product-search');
    Route::get('/product/{slug}', [FrontendController::class, 'product_details'])->name('product.details');


    Route::get('/sign-in', [FrontendController::class, 'sign_in'])->name('sign-in');
    Route::post('/sign-in', [FrontendController::class, 'loginSubmit'])->name('sign-in.submit');
    Route::post('/logout', [FrontendController::class, 'logout'])->name('logout');

    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/forgot-password', [FrontendController::class, 'forgot_password'])->name('forgot-password');
    Route::get('/register', [RegisterController::class, 'register'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'registerSubmit'])->name('register');


    Route::post('/contact/message', [MessageController::class, 'store'])->name('contact.store');
    Route::get('product-detail/{slug}', [FrontendController::class, 'productDetail'])->name('product-detail');
    Route::post('/product/search', [FrontendController::class, 'productSearch'])->name('product.search');
    Route::get('/product-cat/{slug}', [FrontendController::class, 'productCat'])->name('product-cat');
    Route::get('/product-sub-cat/{slug}/{sub_slug}', [FrontendController::class, 'productSubCat'])->name('product-sub-cat');
    Route::get('/product-brand/{slug}', [FrontendController::class, 'productBrand'])->name('product-brand');
// Cart section
    Route::get('/add-to-cart/{slug}', [CartController::class, 'addToCart'])->name('add-to-cart')->middleware('user');
    Route::post('/add-to-cart', [CartController::class, 'singleAddToCart'])->name('single-add-to-cart')->middleware('user');
    Route::get('cart-delete/{id}', [CartController::class, 'cartDelete'])->name('cart-delete');
    Route::post('cart-update', [CartController::class, 'cartUpdate'])->name('cart.update');

    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart')->middleware('user');

    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('user');
// Wishlist
    Route::get('/wishlist', function () {
        return view('frontend.pages.wishlist');
    })->name('wishlist');
    Route::get('/wishlist/{slug}', [WishlistController::class, 'wishlist'])->name('add-to-wishlist')->middleware('user');
    Route::get('wishlist-delete/{id}', [WishlistController::class, 'wishlistDelete'])->name('wishlist-delete');
    Route::post('/cart/order', [OrderController::class, 'placeOrder'])->name('cart.order');
    Route::get('order/pdf/{id}', [OrderController::class, 'pdf'])->name('order.pdf');
    Route::get('/income', [OrderController::class, 'incomeChart'])->name('product.order.income');
// Route::get('/user/chart',[AdminController::class, 'userPieChart'])->name('user.piechart');
    Route::get('/product-grids', [FrontendController::class, 'productGrids'])->name('product-grids');
    Route::get('/product-lists', [FrontendController::class, 'productLists'])->name('product-lists');
    Route::match(['get', 'post'], '/filter', [FrontendController::class, 'productFilter'])->name('shop.filter');
// Order Track
    Route::get('/product/track', [OrderController::class, 'orderTrack'])->name('order.track');
    Route::post('product/track/order', [OrderController::class, 'productTrackOrder'])->name('product.track.order');
// Blog
    Route::get('/blog-detail/{slug}', [FrontendController::class, 'blogDetail'])->name('blog.detail');
    Route::get('/blog/search', [FrontendController::class, 'blogSearch'])->name('blog.search');
    Route::post('/blog/filter', [FrontendController::class, 'blogFilter'])->name('blog.filter');
    Route::get('blog-cat/{slug}', [FrontendController::class, 'blogByCategory'])->name('blog.category');
    Route::get('blog-tag/{slug}', [FrontendController::class, 'blogByTag'])->name('blog.tag');

// NewsLetter
    Route::post('/subscribe', [FrontendController::class, 'subscribe'])->name('subscribe');

// Product Review
    Route::resource('/review', 'ProductReviewController');
    Route::post('product/{slug}/review', [ProductReviewController::class, 'store'])->name('review.store');

// Post Comment
    Route::post('post/{slug}/comment', [PostCommentController::class, 'store'])->name('post-comment.store');
    Route::resource('/comment', 'PostCommentController');
// Coupon
    Route::post('/coupon-store', [CouponController::class, 'couponStore'])->name('coupon-store');
// Payment
    Route::get('payment', [PayPalController::class, 'payment'])->name('payment');
    Route::get('cancel', [PayPalController::class, 'cancel'])->name('payment.cancel');
    Route::get('payment/success', [PayPalController::class, 'success'])->name('payment.success');


Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'admin']], function () {   
    Route::get('/', [AdminController::class, 'index'])->name('admin');
        Route::get('/file-manager', function () {
            return view('backend.layouts.file-manager');
        })->name('file-manager');
        // user route
        Route::resource('users', 'UsersController');
        // Banner
        Route::resource('banner', 'BannerController');
        // Brand
        Route::resource('brand', 'BrandController');
        // Series
        Route::resource('series', 'SeriesController');
        // Product Type
        Route::resource('producttype', 'ProductTypeController');
        // FeaturedIn
        Route::resource('featuredin', 'FeaturedInController');
        // Character
        Route::resource('character', 'CharacterController');
        // Company
        Route::resource('company', 'CompanyController');
        // Scale
        Route::resource('scale', 'ScaleController');
        // Size
        Route::resource('size', 'SizeController');
        // Product
        Route::resource('product', ProductController::class);

        // Profile
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin-profile');
        Route::post('/profile/{id}', [AdminController::class, 'profileUpdate'])->name('profile-update');
        // Category
        Route::resource('/category', 'CategoryController');
        // Product
        Route::resource('/product', 'ProductController');
        // Ajax for sub category
        Route::post('/category/{id}/child', 'CategoryController@getChildByParent');
        // POST category
        Route::resource('/post-category', 'PostCategoryController');
        // Post tag
        Route::resource('/post-tag', 'PostTagController');
        // Post
        Route::resource('/post', 'PostController');
        // Message
        Route::resource('/message', 'MessageController');
        Route::get('/message/five', [MessageController::class, 'messageFive'])->name('messages.five');

        // Order
        Route::resource('/order', 'OrderController');
        // Shipping
        Route::resource('/shipping', 'ShippingController');
        // Coupon
        Route::resource('/coupon', 'CouponController');
        // Settings
        Route::get('settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('setting/update', [AdminController::class, 'settingsUpdate'])->name('settings.update');

        // Notification
        Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('admin.notification');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('all.notification');
        Route::delete('/notification/{id}', [NotificationController::class, 'delete'])->name('notification.delete');
        // Password Change
        Route::get('change-password', [AdminController::class, 'changePassword'])->name('change.password.form');
        Route::post('change-password', [AdminController::class, 'changPasswordStore'])->name('change.password');
    });

// User section start
    Route::group(['prefix' => '/account', 'middleware' => ['user']], function () {
        Route::get('/', [HomeController::class, 'index'])->name('user');
        
        // Route::get('/account', function () {
        //     return view('frontend.pages.account'); // adjust path if needed
        // })->name('account')->middleware('auth'); 
        // Profile
        Route::get('/profile', [HomeController::class, 'profile'])->name('user-profile');
        Route::post('/profile/{id}', [HomeController::class, 'profileUpdate'])->name('user-profile-update');
        //  Order
        Route::get('/order', "HomeController@orderIndex")->name('user.order.index');
        Route::get('/order/show/{id}', "HomeController@orderShow")->name('user.order.show');
        Route::delete('/order/delete/{id}', [HomeController::class, 'userOrderDelete'])->name('user.order.delete');
        // Product Review
        Route::get('/user-review', [HomeController::class, 'productReviewIndex'])->name('user.productreview.index');
        Route::delete('/user-review/delete/{id}', [HomeController::class, 'productReviewDelete'])->name('user.productreview.delete');
        Route::get('/user-review/edit/{id}', [HomeController::class, 'productReviewEdit'])->name('user.productreview.edit');
        Route::patch('/user-review/update/{id}', [HomeController::class, 'productReviewUpdate'])->name('user.productreview.update');

        // Post comment
        Route::get('user-post/comment', [HomeController::class, 'userComment'])->name('user.post-comment.index');
        Route::delete('user-post/comment/delete/{id}', [HomeController::class, 'userCommentDelete'])->name('user.post-comment.delete');
        Route::get('user-post/comment/edit/{id}', [HomeController::class, 'userCommentEdit'])->name('user.post-comment.edit');
        Route::patch('user-post/comment/udpate/{id}', [HomeController::class, 'userCommentUpdate'])->name('user.post-comment.update');

        // Password Change
        Route::get('change-password', [HomeController::class, 'changePassword'])->name('user.change.password.form');
        Route::post('change-password', [HomeController::class, 'changPasswordStore'])->name('change.password');

    });

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        Lfm::routes();
    });
