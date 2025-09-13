<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PasienModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';
    protected $fillable = [
        'nama_pasien',
        'alamat_pasien',
        'no_telp',
        'id_rumah_sakit',
    ];

    public function rumah_sakit()
    {
        return $this->belongsTo(RumahSakitModel::class, 'id_rumah_sakit', 'id_rumah_sakit');
    }
}
