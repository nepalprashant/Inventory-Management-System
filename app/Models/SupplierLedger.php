<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierLedger extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'purchase_type',
        'invoice_no',
        'debit',
        'credit',
        'balance',
        'supplier_id',
        'user_id',
        'status',
    ];
}
