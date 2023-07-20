<?php

namespace App\Models;

use App\Models\Cash;
use App\Models\Size;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Status;
use App\Models\Variant;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'price',
        'qty',
        'returns',
        'delivery',
        'size',
        'category_id',
        'code',
        'name',
        'cash_id',
        'variant',
        'description',
        'image1',
        'image2',
        'image3',
        'image4',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function variant(){
        return $this->belongsTo(Variant::class);
    }

    public function stock(){
        return $this->belongsTo(Stock::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }

    public function cash(){
        return $this->belongsTo(Cash::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function order()
    {
    	return $this->belongsTo(Order::class);
    }

    public function cart()
    {
    	return $this->belongsTo(Cart::class);
    }

    public function orderItem()
    {
    	return $this->hasMany(OrderItem::class);
    }
}
