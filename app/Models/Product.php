<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Product extends Model
{
  protected $fillable = [
    'name',
    'slug',
    'description',
    'price',
    'category_id',
    'stock_quantity',
    'image'
  ];

   public function category()
   {
     return $this->belongsTo(Category::class);
   }

   public function orders()
   {
     return $this->belongsToMany(Order::class, 'order_items')
         ->withPivot('quantity', 'price')
         ->withTimestamps();
   }
}
