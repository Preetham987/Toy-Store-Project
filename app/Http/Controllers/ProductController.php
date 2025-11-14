<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Series;
use App\Models\ProductType;
use App\Models\FeaturedIn;
use App\Models\Character;
use App\Models\Company;
use App\Models\Scale;
use App\Models\Size;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('backend.product.index', compact('products')); // ✅ matches your folder
    }

    public function byCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->paginate(20);

        return view('products.index', compact('products'));
    }

    public function byProductType($slug)
    {
        $type = ProductType::where('slug', $slug)->firstOrFail();
        $products = $type->products()->paginate(20);

        return view('products.index', [
            'products' => $products
        ]);
    }
    public function byBrand($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $products = $brand->products()->paginate(20);

        return view('products.index', compact('products'));
    }

    public function bySeries($slug)
    {
        $series = Series::where('slug', $slug)->firstOrFail();
        $products = $series->products()->paginate(20);

        return view('products.index', compact('products'));
    }

    public function byFeaturedIn($slug)
    {
        $featuredin = FeaturedIn::where('slug', $slug)->firstOrFail();
        $products = $featuredin->products()->paginate(20);

        return view('products.index', compact('products'));
    }

    public function byCharacter($slug)
    {
        $character = Character::where('slug', $slug)->firstOrFail();
        $products = $character->products()->paginate(20);

        return view('products.index', compact('products'));
    }

    public function byCompany($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $products = $company->products()->paginate(20);

        return view('products.index', compact('products'));
    }

    public function byScale($slug)
    {
        $scale = Scale::where('slug', $slug)->firstOrFail();
        $products = $scale->products()->paginate(20);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $size = Size::get();
        $scale = Scale::get();
        $company = Company::get();
        $character = Character::get();
        $featuredin = FeaturedIn::get();
        $producttype = ProductType::get();
        $series = Series::get();
        $brands = Brand::get();
        $categories = Category::select('id', 'title')->get();

        return view('backend.product.create', compact(
            'categories', 
            'brands', 
            'series',
            'producttype',
            'featuredin',
            'character',
            'company',
            'scale',
            'size'
        ));
    }

    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'title' => 'required|string',
        'summary' => 'required|string',
        'description' => 'nullable|string',
        'boxcontent' => 'nullable|string',
        'preorder' => 'nullable|string',
        'standardgrade' => 'nullable|string',
        'photo' => 'required|string',
        'size_id' => 'nullable|exists:size,id',
        'scale_id' => 'nullable|exists:scale,id',
        'company_id' => 'nullable|exists:company,id',
        'character_id' => 'nullable|exists:character,id',
        'featuredin_id' => 'nullable|exists:featuredin,id',
        'product_type_id' => 'nullable|exists:producttype,id',
        'series_id' => 'nullable|exists:series,id',
        'brand_id' => 'nullable|exists:brands,id',
        'stock' => 'required|numeric',
        'cat_id' => 'required|exists:categories,id',
        'child_cat_id' => 'nullable|exists:categories,id',
        'is_featured' => 'sometimes|in:1',
        'status' => 'required|in:active,inactive',
        'condition' => 'required|in:default,new,hot',
        'price' => 'required|numeric',
        'discount' => 'nullable|numeric',
    ]);

        $slug = generateUniqueSlug($request->title, Product::class);
        $validatedData['slug'] = $slug;
        $validatedData['is_featured'] = $request->input('is_featured', 0);

        $product = Product::create($validatedData);

        return redirect()->route('product.index')
            ->with($product ? 'success' : 'error', $product ? 'Product Successfully added' : 'Please try again!!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::get();
        $categories = Category::where('is_parent', 1)
            ->orWhere('id', $product->cat_id) // ✅ ensure selected cat is included
            ->get();
        $series = Series::get();
        $producttype = ProductType::get();
        $featuredin = FeaturedIn::get();
        $character = Character::get();
        $company = Company::get();
        $scale = Scale::get();
        $size = Size::get();

        return view('backend.product.edit', compact(
            'product',
            'brands',
            'categories',
            'series',
            'producttype',
            'featuredin',
            'character',
            'company',
            'scale',
            'size'
        ));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string',
            'summary' => 'required|string',
            'description' => 'nullable|string',
            'boxcontent' => 'nullable|string',
            'preorder' => 'nullable|string',
            'standardgrade' => 'nullable|string',
            'photo' => 'required|string',
            'size_id' => 'nullable|exists:size,id',
            'scale_id' => 'nullable|exists:scale,id',
            'company_id' => 'nullable|exists:company,id',
            'character_id' => 'nullable|exists:character,id',
            'featuredin_id' => 'nullable|exists:featuredin,id',
            'product_type_id' => 'nullable|exists:producttype,id',
            'series_id' => 'nullable|exists:series,id',
            'brand_id' => 'nullable|exists:brands,id',
            'stock' => 'required|numeric',
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
        ]);

        $validatedData['is_featured'] = $request->input('is_featured', 0);

        $status = $product->update($validatedData);

        return redirect()->route('product.index')
            ->with($status ? 'success' : 'error', $status ? 'Product Successfully updated' : 'Please try again!!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $status = $product->delete();

        return redirect()->route('product.index')
            ->with($status ? 'success' : 'error', $status ? 'Product successfully deleted' : 'Error while deleting product');
    }
}
