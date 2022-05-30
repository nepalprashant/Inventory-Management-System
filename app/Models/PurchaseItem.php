<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Purchase;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity', 'rate', 'amount', 'discount', 'discount_amount', 'product_id', 'purchase_id', 'purchase_item_type', 'status'
    ];

    /**
     * Get the user that owns the PurchaseItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function productDetails()
    {
        return $this->hasOne('App\Models\PurchaseDetail', 'purchase_item');
    }
}