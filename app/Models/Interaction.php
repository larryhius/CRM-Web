<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;

    // Tentukan kolom yang dapat diisi secara massal (mass assignment)
    protected $fillable = ['customer_id', 'type', 'description', 'interaction_date'];

    // Relasi dengan model Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }   
}
