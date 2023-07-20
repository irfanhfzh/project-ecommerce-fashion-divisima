<?php

namespace App\Models;

use App\Models\Size;
use App\Models\User;
use App\Models\Status;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'user_id',
        'product_id',
        'qty',
        'size',
        'variant',
        'tanggal_order',
        'address',
        'notes',
        'payment_method',
        'rating',
        'reviews',
    ];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function orderItem() {
    	return $this->hasMany(OrderItem::class);
    }

    public function product(){
        return $this->belongsTo(Product::class,);
    }
}
