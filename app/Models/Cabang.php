<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $table = 'cabang';
    
    public $timestamps = false;
    
    protected $fillable = [
        'nama_cabang',
        'alamat',
        'no_telp',
        'link_maps',
        'lokasi'
    ];
    
    /**
     * Get the formatted phone number for WhatsApp.
     * 
     * @return string
     */
    public function getWhatsappNumberAttribute()
    {
        // Remove any non-numeric characters and ensure it starts with 62 (Indonesia code)
        $phone = preg_replace('/[^0-9]/', '', $this->no_telp);
        
        // If it starts with 0, replace it with 62
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        
        // If it doesn't start with 62, add it
        if (substr($phone, 0, 2) !== '62') {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }
    
    /**
     * Get consultations for this branch.
     */
    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'cabang_id');
    }
    
    /**
     * Get patients for this branch.
     */
    public function patients()
    {
        return $this->hasMany(DataPasien::class, 'id_cabang');
    }
    
    /**
     * Get all branches.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllBranches()
    {
        return self::orderBy('nama_cabang')->get();
    }
}