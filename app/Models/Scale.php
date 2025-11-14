<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
    protected $table = 'scale';
    protected $fillable=['title','slug','status'];

    // public static function getProductByScale($id){
    //     return Product::where('scale_id',$id)->paginate(10);
    // }
    public function products(){
            return $this->hasMany(Product::class, 'scale_id', 'id')->where('status', 'active');
    }
    public static function getProductByScale($slug){
        // dd($slug);
        return Scale::with('products')->where('slug',$slug)->first();
        
        // return Product::where('cat_id',$id)->where('child_cat_id',null)->paginate(10);
    }
    public static function countActiveScale()
    {
        return self::where('status', 'active')->count();
    }
}
