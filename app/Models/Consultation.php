<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    
    protected $table = 'consultations';
    
    protected $fillable = [
        'patient_name',
        'email',
        'phone',
        'alamat',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nama_orang_tua',
        'meeting_date',
        'complaint',
        'status',
        'cabang_id'
    ];
    
    /**
     * Format date attribute for display.
     *
     * @return string
     */
    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->meeting_date)->format('d F Y');
    }
    
    /**
     * Get the branch that the consultation belongs to.
     */
    public function branch()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }
    
    /**
     * Get the branch that the consultation belongs to (alternative name).
     */
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }
    
    /**
     * Format a date for display
     *
     * @param string $date
     * @return string
     */
    public function formatDate($date)
    {
        if (!$date) return 'N/A';
        return date('d F Y', strtotime($date));
    }
    
    /**
     * Generate WhatsApp message text based on consultation data.
     *
     * @return string
     */
    public function generateWhatsAppMessage()
    {
        $branchName = $this->branch ? $this->branch->nama_cabang : 'tidak disebutkan';
        $tanggalLahir = $this->tanggal_lahir ? date('d-m-Y', strtotime($this->tanggal_lahir)) : 'tidak disebutkan';
        
        $message = "Halo, saya *{$this->nama_orang_tua}* ingin membuat janji konsultasi untuk anak saya.\n\n";
        
        $message .= "📋 *DATA ORANG TUA*\n";
        $message .= "- Nama: {$this->nama_orang_tua}\n";
        $message .= "- Email: {$this->email}\n";
        $message .= "- No. HP: {$this->phone}\n\n";
        
        $message .= "👶 *DATA ANAK*\n";
        $message .= "- Nama: {$this->patient_name}\n";
        $message .= "- Jenis Kelamin: {$this->jenis_kelamin}\n";
        $message .= "- TTL: {$this->tempat_lahir}, {$tanggalLahir}\n";
        $message .= "- Alamat: {$this->alamat}\n\n";
        
        $message .= "🗓️ *DETAIL JANJI*\n";
        $message .= "- Cabang: {$branchName}\n";
        $message .= "- Tanggal Konsultasi: {$this->formatted_date}\n";
        $message .= "- Keluhan/Terapi: {$this->complaint}\n\n";
        
        $message .= "Mohon konfirmasi ketersediaan jadwal untuk tanggal tersebut. Terima kasih.";
        
        return urlencode($message);
    }
}