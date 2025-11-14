<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $fillable=['title','slug','status'];

    // public static function getProductByBrand($id){
    //     return Product::where('brand_id',$id)->paginate(10);
    // }
    public function products(){
        return $this->hasMany(Product::class, 'series_id', 'id')->where('status', 'active');
    }
    public static function getProductBySeries($slug){
        // dd($slug);
        return Series::with('products')->where('slug',$slug)->first();
        // return Product::where('cat_id',$id)->where('child_cat_id',null)->paginate(10);
    }
    public static function countActiveSeries()
    {
        return self::where('status', 'active')->count();
    }
}
