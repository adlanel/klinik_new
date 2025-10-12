<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPasien extends Model
{
    use HasFactory;

    protected $table = 'data_pasien';
    protected $primaryKey = 'id_pasien';
    public $timestamps = false;

    protected $fillable = [
        'nama_anak',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nama_orang_tua',
        'telepon',
        'alamat',
        'id_cabang',
        'keluhan_awal',
        'jenis_terapi',
        'hasil_follow_up',
        'terakhir_konsultasi',
        'status_pasien',
    ];

    /**
     * Get the branch that the patient belongs to.
     */
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang');
    }
}