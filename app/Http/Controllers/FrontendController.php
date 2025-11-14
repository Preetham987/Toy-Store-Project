<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\Series;
use App\Models\ProductType;
use App\Models\Order;
use App\Models\FeaturedIn;
use App\Models\Character;
use App\Models\Company;
use App\Models\Scale;
use App\Models\Size;
use App\Models\Address;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Newsletter;
use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
   
    public function index(Request $request){
        return redirect()->route($request->user()->role);
    }

    public function home()
    {
        // Featured products split into 3 sections
        $featuredTop = Product::where('status', 'active')
            ->where('is_featured', 1)
            ->orderBy('created_at', 'ASC')
            ->take(2)
            ->get();

        $featuredBottom1 = Product::where('status', 'active')
            ->where('is_featured', 1)
            ->orderBy('created_at', 'ASC')
            ->skip(2) // skip top 2
            ->take(5)
            ->get();

        $featuredBottom2 = Product::where('status', 'active')
            ->where('is_featured', 1)
            ->orderBy('created_at', 'ASC')
            ->skip(7) // skip top 2 + first bottom 5
            ->take(5)
            ->get();

        // Posts
        $posts = Post::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();

        // Banners
        $banners = Banner::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();

        // Latest products
        $products = Product::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(8)
            ->get();

        // Categories
        $category = Category::where('status', 'active')
            ->where('is_parent', 1)
            ->orderBy('title', 'ASC')
            ->get();

        return view('frontend.index')
            ->with('featuredTop', $featuredTop)
            ->with('featuredBottom1', $featuredBottom1)
            ->with('featuredBottom2', $featuredBottom2)
            ->with('posts', $posts)
            ->with('banners', $banners)
            ->with('product_lists', $products)
            ->with('category_lists', $category);
    }

    public function aboutUs(){
        return view('frontend.pages.about-us');
    }

    public function contact()
    {
        // Fetch featured products with pagination (12 per page)
        $featuredProducts = Product::where('is_featured', 1)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(16);

        return view('frontend.pages.contact', compact('featuredProducts'));
    }

    public function sale(){
        return view('frontend.pages.sale');
    }

    public function help(){
        return view('frontend.pages.help');
    }

    public function account()
    {
        $user = Auth::user(); // Get logged-in user
        return view('frontend.pages.account', compact('user'));
    }

    public function faq(){
        return view('frontend.pages.faq');
    }

    public function privacy_policy(){
        return view('frontend.pages.privacy-policy');
    }

    public function terms_and_condition(){
        return view('frontend.pages.terms-and-condition');
    }

    public function preorders(){
        return view('frontend.pages.preorders');
    }

    public function shipping(){
        return view('frontend.pages.shipping');
    }

    public function cancellations(){
        return view('frontend.pages.cancellations');
    }

    public function returns(){
        return view('frontend.pages.returns');
    }

    public function payments(){
        return view('frontend.pages.payments');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->where('status', '!=', 'delivered') // exclude delivered
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.pages.orders', compact('orders'));
    }

    public function cancel($id)
    {
        $order = Order::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $order->status = 'cancel';
        $order->save();

        return redirect()->back()->with('success', 'Order has been cancelled.');
    }

    public function pre_order(){
        return view('frontend.pages.pre-order');
    }

    public function shipment()
    {
        $shipments = Order::where('user_id', Auth::id())
            ->where('status', 'delivered')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.pages.shipment', compact('shipments'));
    }

    public function address_book()
    {
        $userEmail = Auth::user()->email;

        $addresses = Address::where('email', $userEmail)->get();

        return view('frontend.pages.address-book', compact('addresses'));
    }

    public function wallet(){
        return view('frontend.pages.wallet');
    }

    public function change_password(){
        return view('frontend.pages.change-password');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    }

    public function new_address(){
        return view('frontend.pages.new-address');
    }

    public function new_credit_card(){
        return view('frontend.pages.new-credit-card');
    }

    public function sign_in(){
        return view('frontend.pages.sign-in');
    }

    public function forgot_password(){
        return view('frontend.pages.forgot-password');
    }

    public function product_search(Request $request)
    {
        $query = Product::query()->with([
            'cat_info', 'brand', 'series', 'productType', 'featuredIn',
            'character', 'company', 'scale', 'sizeRelation'
        ]);

        // Filters
        if ($request->filled('categories')) {
            $query->whereIn('cat_id', $request->categories);
        }
        if ($request->filled('brands')) {
            $query->whereIn('brand_id', $request->brands);
        }
        if ($request->filled('series')) {
            $query->whereIn('series_id', $request->series);
        }
        if ($request->filled('product_types')) {
            $query->whereIn('product_type_id', $request->product_types);
        }
        if ($request->filled('featuredin')) {
            $query->whereIn('featuredin_id', $request->featuredin);
        }
        if ($request->filled('characters')) {
            $query->whereIn('character_id', $request->characters);
        }
        if ($request->filled('companies')) {
            $query->whereIn('company_id', $request->companies);
        }
        if ($request->filled('scales')) {
            $query->whereIn('scale_id', $request->scales);
        }
        if ($request->filled('sizes')) {
            $query->whereIn('size_id', $request->sizes);
        }

        // Sorting
        if ($request->sort_by === 'price_low_high') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort_by === 'price_high_low') {
            $query->orderBy('price', 'desc');
        }

        $products = $query->paginate(20);
        $products->appends($request->query());

        // Filters Data
        $categories = Category::withCount('products')->get();
        $brands = Brand::withCount('products')->get();
        $series = Series::withCount('products')->get();
        $productTypes = ProductType::withCount('products')->get();
        $featuredin = FeaturedIn::withCount('products')->get();
        $character = Character::withCount('products')->get();
        $companies = Company::withCount('products')->get();
        $scales = Scale::withCount('products')->get();
        $sizes = Size::withCount('products')->get();

        // Sections for sidebar
        $sections = [
            ['title' => 'Department', 'name' => 'categories', 'items' => $categories],
            ['title' => 'Brand', 'name' => 'brands', 'items' => $brands],
            ['title' => 'Series', 'name' => 'series', 'items' => $series],
            ['title' => 'Product Type', 'name' => 'product_types', 'items' => $productTypes],
            ['title' => 'Featured In', 'name' => 'featuredin', 'items' => $featuredin],
            ['title' => 'Character', 'name' => 'characters', 'items' => $character],
            ['title' => 'Company', 'name' => 'companies', 'items' => $companies],
            ['title' => 'Scale', 'name' => 'scales', 'items' => $scales],
            ['title' => 'Size', 'name' => 'sizes', 'items' => $sizes],
        ];

        return view('frontend.pages.product-search', compact(
            'products',
            'categories', 'brands', 'series', 'productTypes',
            'featuredin', 'character', 'companies', 'scales', 'sizes',
            'sections'
        ))->with('selectedFilters', $request->all());
    }

    public function productDetail($slug)
    {
        $product = Product::with([
            'cat_info',
            'brand',
            'series',
            'productType',
            'featuredIn',
            'character',
            'company',
            'scale',
            'sizeRelation'
        ])->where('slug', $slug)->firstOrFail();

        return view('frontend.pages.product_detail', compact('product'));
    }

    public function productGrids(){
        $products=Product::query();
        
        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids);
            // return $products;
        }
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));
            
            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->paginate(9);
        }
        // Sort by name , price, category

      
        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    }
    public function productLists(){
        $products=Product::query();
        
        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids)->paginate;
            // return $products;
        }
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));
            
            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->paginate(6);
        }
        // Sort by name , price, category

      
        return view('frontend.pages.product-lists')->with('products',$products)->with('recent_products',$recent_products);
    }
    public function productFilter(Request $request){
            $data= $request->all();
            // return $data;
            $showURL="";
            if(!empty($data['show'])){
                $showURL .='&show='.$data['show'];
            }

            $sortByURL='';
            if(!empty($data['sortBy'])){
                $sortByURL .='&sortBy='.$data['sortBy'];
            }

            $catURL="";
            if(!empty($data['category'])){
                foreach($data['category'] as $category){
                    if(empty($catURL)){
                        $catURL .='&category='.$category;
                    }
                    else{
                        $catURL .=','.$category;
                    }
                }
            }

            $brandURL="";
            if(!empty($data['brand'])){
                foreach($data['brand'] as $brand){
                    if(empty($brandURL)){
                        $brandURL .='&brand='.$brand;
                    }
                    else{
                        $brandURL .=','.$brand;
                    }
                }
            }
            // return $brandURL;

            $priceRangeURL="";
            if(!empty($data['price_range'])){
                $priceRangeURL .='&price='.$data['price_range'];
            }
            if(request()->is('e-shop.loc/product-grids')){
                return redirect()->route('product-grids',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
            }
            else{
                return redirect()->route('product-lists',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
            }
    }
    public function productSearch(Request $request){
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $products=Product::orwhere('title','like','%'.$request->search.'%')
                    ->orwhere('slug','like','%'.$request->search.'%')
                    ->orwhere('description','like','%'.$request->search.'%')
                    ->orwhere('summary','like','%'.$request->search.'%')
                    ->orwhere('price','like','%'.$request->search.'%')
                    ->orderBy('id','DESC')
                    ->paginate('9');
        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    }

    public function productBrand(Request $request){
        $products=Brand::getProductByBrand($request->slug);
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
        }

    }
    public function productCat(Request $request){
        $products=Category::getProductByCat($request->slug);
        // return $request->slug;
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
        }

    }
    public function productSubCat(Request $request){
        $products=Category::getProductBySubCat($request->sub_slug);
        // return $products;
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        }

    }

    public function blog()
    {
        // Fetch products with "active" status, newest first
        $products = Product::where('status', 'active')
                        ->orderBy('created_at', 'DESC')
                        ->paginate(16);

        return view('frontend.pages.blog', compact('products'));
    }

    public function blogDetail($slug){
        $post=Post::getPostBySlug($slug);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // return $post;
        return view('frontend.pages.blog-detail')->with('post',$post)->with('recent_posts',$rcnt_post);
    }

    public function blogSearch(Request $request){
        // return $request->all();
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $posts=Post::orwhere('title','like','%'.$request->search.'%')
            ->orwhere('quote','like','%'.$request->search.'%')
            ->orwhere('summary','like','%'.$request->search.'%')
            ->orwhere('description','like','%'.$request->search.'%')
            ->orwhere('slug','like','%'.$request->search.'%')
            ->orderBy('id','DESC')
            ->paginate(8);
        return view('frontend.pages.blog')->with('posts',$posts)->with('recent_posts',$rcnt_post);
    }

    public function blogFilter(Request $request){
        $data=$request->all();
        // return $data;
        $catURL="";
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catURL)){
                    $catURL .='&category='.$category;
                }
                else{
                    $catURL .=','.$category;
                }
            }
        }

        $tagURL="";
        if(!empty($data['tag'])){
            foreach($data['tag'] as $tag){
                if(empty($tagURL)){
                    $tagURL .='&tag='.$tag;
                }
                else{
                    $tagURL .=','.$tag;
                }
            }
        }
        // return $tagURL;
            // return $catURL;
        return redirect()->route('blog',$catURL.$tagURL);
    }

    public function blogByCategory(Request $request){
        $post=PostCategory::getBlogByCategory($request->slug);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post->post)->with('recent_posts',$rcnt_post);
    }

    public function blogByTag(Request $request){
        // dd($request->slug);
        $post=Post::getBlogByTag($request->slug);
        // return $post;
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post);
    }

    // Login
    public function login(){
        return view('frontend.pages.login');
    }
    public function loginSubmit(Request $request){
        $credentials = $request->only('email', 'password');

        if(Auth::attempt(array_merge($credentials, ['status' => 'active']))){
            Session::put('user', $credentials['email']);
            return redirect()->route('home')->with('success', 'Successfully logged in');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }

    public function register(){
        return view('frontend.pages.register');
    }
    public function registerSubmit(Request $request){
        // return $request->all();
        $this->validate($request,[
            'name'=>'string|required|min:2',
            'email'=>'string|required|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);
        $data=$request->all();
        // dd($data);
        $check=$this->create($data);
        Session::put('user',$data['email']);
        if($check){
            request()->session()->flash('success','Successfully registered');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Please try again!');
            return back();
        }
    }
    public function create(array $data){
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'status'=>'active'
            ]);
    }
    // Reset password
    public function showResetForm(){
        return view('auth.passwords.old-reset');
    }

    public function subscribe(Request $request){
        if(! Newsletter::isSubscribed($request->email)){
                Newsletter::subscribePending($request->email);
                if(Newsletter::lastActionSucceeded()){
                    request()->session()->flash('success','Subscribed! Please check your email');
                    return redirect()->route('home');
                }
                else{
                    Newsletter::getLastError();
                    return back()->with('error','Something went wrong! please try again');
                }
            }
            else{
                request()->session()->flash('error','Already Subscribed');
                return back();
            }
    }
    
}
