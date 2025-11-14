<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;

class Product extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'boxcontent',
        'preorder',
        'standardgrade',
        'cat_id',
        'child_cat_id',
        'brand_id',
        'series_id',
        'product_type_id',
        'featuredin_id',
        'character_id',
        'company_id',
        'scale_id',
        'size_id',
        'price',
        'discount',
        'status',
        'photo',
        'size',
        'stock',
        'is_featured',
        'condition',
    ];

    /** Relationships */
    public function cat_info()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    public function sub_cat_info()
    {
        return $this->belongsTo(Category::class, 'child_cat_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function series()
    {
        return $this->belongsTo(Series::class, 'series_id', 'id');
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id', 'id');
    }

    public function featuredIn()
    {
        return $this->belongsTo(FeaturedIn::class, 'featuredin_id', 'id');
    }

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function scale()
    {
        return $this->belongsTo(Scale::class, 'scale_id', 'id');
    }

    public function sizeRelation()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }

    public function rel_prods()
    {
        return $this->hasMany(Product::class, 'cat_id', 'cat_id')
            ->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(8);
    }

    public function getReview()
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id')
            ->with('user_info')
            ->where('status', 'active')
            ->orderBy('id', 'DESC');
    }

    public static function getAllProduct()
    {
        return self::with([
            'cat_info',
            'sub_cat_info',
            'brand',
            'series',
            'productType',
            'featuredIn',
            'character',
            'company',
            'scale',
            'sizeRelation'
        ])->orderBy('id', 'desc')->paginate(10);
    }

    public static function getProductBySlug($slug)
    {
        return self::with([
            'cat_info',
            'rel_prods',
            'getReview',
            'series',
            'productType',
            'featuredIn',
            'character',
            'company',
            'scale',
            'sizeRelation'
        ])->where('slug', $slug)->first();
    }

    public static function countActiveProduct()
    {
        return self::where('status', 'active')->count() ?? 0;
    }

    public function carts()
    {
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    }
}
