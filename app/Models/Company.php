<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $fillable=['title','slug','status'];

    // public static function getProductByCompany($id){
    //     return Product::where('company_id',$id)->paginate(10);
    // }
    public function products(){
        return $this->hasMany(Product::class,'company_id','id')->where('status','active');
    }
    public static function getProductByCompany($slug){
        // dd($slug);
        return Company::with('products')->where('slug',$slug)->first();
        // return Product::where('cat_id',$id)->where('child_cat_id',null)->paginate(10);
    }
    public static function countActiveCompany()
    {
        return self::where('status', 'active')->count();
    }
}
