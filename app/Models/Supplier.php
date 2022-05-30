<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'contact', 'contact_person', 'pan_no', 'email', 'remark', 'status'
    ];

    /**
     * Get the user that owns the Supplier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchase()
    {
        return $this->hasMany('App\Models\Purchase');
    }
}
