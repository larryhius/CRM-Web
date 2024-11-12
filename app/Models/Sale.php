<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // Tentukan kolom yang dapat diisi secara massal (mass assignment)
    protected $fillable = [
        'customer_id',
        'amount',
        'sale_date',
        'description',
    ];

    // Relasi dengan model Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relasi dengan model Invoice
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
