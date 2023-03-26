<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable=['name','quantity','price','description','image', 'category_id','seller_id'];

    public function Category(){
        return $this->BelongsTo(Category::class);
    }
    
    public function user(){
        return $this->BelongsTo(User::class , 'seller_id', 'id');
    }
}

