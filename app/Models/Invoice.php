<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'invoice_date',
    ];

    // Relasi dengan model Sale
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}

