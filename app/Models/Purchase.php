<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'invoice_no',
        'supplier_id',
        'status',
        'purchase_type',
        'shipping_charge',
        'adjustable_discount',
        'total_discount',
        'total_amount',
        'rounding_amount',
        'net_amount', 
        'user_id',
        'remark'
    ];

    /**
     * Get the user that owns the Purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items(){
        return $this->hasMany('App\Models\PurchaseItem');
    }

    public function purchaseDetail(){
        return $this->hasMany('App\Models\PurchaseDetail');
    }
}
