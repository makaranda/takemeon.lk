<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items'; // Define the table name
    protected $primaryKey = 'id'; // Primary key column
    public $timestamps = true; // Enable timestamps (created_at, updated_at)

    protected $fillable = [
        'order_id', 'item_code', 'amount', 'qty', 'total', 'status'
    ];

    // Define the relationship with the Order model
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'item_code', 'product_code');
    }
}
