<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class FeaturedIn extends Model
{
    protected $table = 'featuredin'; // specify custom table name
    protected $fillable=['title','slug','status'];

    // public static function getProductByFeaturedIn($id){
    //     return Product::where('featuredin_id',$id)->paginate(10);
    // }
    public function products(){
        return $this->hasMany(Product::class, 'featuredin_id', 'id')->where('status', 'active');
    }
    public static function getProductByFeaturedIn($slug){
        // dd($slug);
        return FeaturedIn::with('products')->where('slug',$slug)->first();
        // return Product::where('cat_id',$id)->where('child_cat_id',null)->paginate(10);
    }
    public static function countActiveFeaturedIn()
    {
        return self::where('status', 'active')->count();
    }
}
