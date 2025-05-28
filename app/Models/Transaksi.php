<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded =[];
    protected $fillable = [
        'user_id',
        'total',
        'kasir_name',
        'status',
        'paid_at',
        'completed_at',
        'invoice_number'
    ];
    
    protected $dates = [
        'paid_at',
        'completed_at',
        'deleted_at'
    ];
    
    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Scope untuk query yang sering digunakan
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
