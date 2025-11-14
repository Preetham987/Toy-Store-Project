<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $table = 'character'; // Force Eloquent to use singular
    protected $fillable=['title','slug','status'];

    // public static function getProductByCharacter($id){
    //     return Product::where('character_id',$id)->paginate(10);
    // }
    public function products(){
        return $this->hasMany(Product::class, 'character_id', 'id')->where('status', 'active');
    }
    public static function getProductByCharacter($slug){
        // dd($slug);
        return Character::with('products')->where('slug',$slug)->first();
        // return Product::where('cat_id',$id)->where('child_cat_id',null)->paginate(10);
    }
    public static function countActiveCharacter()
    {
        return self::where('status', 'active')->count();
    }
}
