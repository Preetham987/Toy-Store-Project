<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'size';
    protected $fillable=['title','slug','status'];

    // public static function getProductBySize($id){
    //     return Product::where('size_id',$id)->paginate(10);
    // }
    public function products(){
        return $this->hasMany(Product::class, 'size_id', 'id')->where('status', 'active');
    }
    public static function getProductBySize($slug){
        // dd($slug);
        return Size::with('products')->where('slug',$slug)->first();
        // return Product::where('cat_id',$id)->where('child_cat_id',null)->paginate(10);
    }
    public static function countActiveSize()
    {
        return self::where('status', 'active')->count();
    }
}
