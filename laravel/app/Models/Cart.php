<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Cart extends Model
{
    // protected $fillable = ['product_id'];

    // public function Product()
    // {
    //     return $this->hasOne(Product::class, 'id', 'product_id');
    // }
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity', 'size'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}