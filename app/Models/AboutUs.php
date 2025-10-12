<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'aboutus';
    
    // Disable timestamps since the table doesn't have updated_at column
    public $timestamps = false;
    
    protected $fillable = [
        'title',
        'description',
        'image',
    ];
    
    /**
     * Get the image URL.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return asset('storage/homepage/aboutus/' . $this->image);
    }
    
    /**
     * Get the first about section or create a default.
     *
     * @return \App\Models\AboutUs
     */
    public static function getFirstOrDefault()
    {
        $aboutSection = self::first();
        
        if (!$aboutSection) {
            // Return a default model if no data exists
            $aboutSection = new self();
            $aboutSection->title = 'Klinik Alfatih Center';
            $aboutSection->description = 'Klinik Alfatih Center adalah pusat layanan kesehatan dan tumbuh kembang anak yang menyediakan berbagai terapi dan penanganan profesional untuk membantu perkembangan optimal anak.';
            $aboutSection->image = 'default-clinic.jpg';
        }
        
        return $aboutSection;
    }
}