<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'batch', 'quantity', 'sp', 'mrp', 'purchase_id', 'product_id', 'status', 'purchase_item'
    ];

    /**
     * Get the user that owns the PurchaseDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchaseItem()
    {
        return $this->belongsTo(PurchaseItem::class, 'purchase_item');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
