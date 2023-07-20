<?php

namespace App\Models;

use App\Models\DetailProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }

    public function detailProduct(){
        return $this->belongsTo(DetailProduct::class);
    }

    public function orderItem() {
    	return $this->hasMany(OrderItem::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
