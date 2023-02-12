<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $table = "outlet";
    protected $guarded = [];

    // Relasi
    public function user()
    {
    	return $this->belongsToMany(User::class, 'id', 'id_outlet');
    }

    public function transaksi()
    {
    	return $this->hasMany(Transaksi::class);
    }
}
