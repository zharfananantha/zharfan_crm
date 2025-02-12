<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'lead_id',
        'product_id',
        'status'
    ];

    protected $with = [
        'lead',
        'product'
    ];
    
    // Relasi ke Lead
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
