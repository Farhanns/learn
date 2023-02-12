<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    protected $guarded = [];

    // Relasi
    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }

    public function paket()
    {
        return $this->belongsToMany(Paket::class, 'id_paket');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Sambung
    public function tanggal()
    {
        $tgl = date('d/m/Y',strtotime($this->tgl));
        $batas_waktu = date('d/m/Y',strtotime($this->batas_waktu));
        return $tgl.' - '.$batas_waktu;
    }
}
