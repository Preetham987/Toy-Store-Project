<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'producttype'; // 👈 specify custom table name
    protected $fillable = ['title', 'slug', 'status'];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_type_id', 'id')->where('status', 'active');
    }

    public static function getProductByProductType($slug)
    {
        return self::with('products')->where('slug', $slug)->first();
    }
    public static function countActiveProductType()
    {
        return self::where('status', 'active')->count();
    }
}
