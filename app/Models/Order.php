<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; // Define the table name
    protected $primaryKey = 'id'; // Primary key column
    public $timestamps = true; // Enable timestamps (created_at, updated_at)
    //`user_id`, `order_id`, `amount`, `qty`, `total`, `payment_method`, `notes`, `confirmation`, `status`,
    protected $fillable = [
        'order_id','user_id', 'amount', 'qty', 'total','payment_method','notes' ,'confirmation', 'address','city','district','status','updated_at', 'created_at'
    ];

    // Define the relationship with the OrderItem model
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
