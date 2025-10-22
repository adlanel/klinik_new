<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';
    
    protected $fillable = [
        'title',
        'harga_reguler_weekday',
        'harga_paket_weekday',
        'harga_reguler_weekend',
        'harga_paket_weekend',
        'slug',
        'short_description',
        'description',
        'image',
        'status'
    ];
    
    /**
     * Get the image URL.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/homepage/layanan/' . $this->image) : asset('images/default-service.jpg');
    }
    
    /**
     * Get all active services.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllActive()
    {
        return self::where('status', 'active')->orderBy('id', 'asc')->get();
    }
    
    /**
     * Get active service by slug.
     *
     * @param string $slug
     * @return \App\Models\layanan|null
     */
    public static function getBySlug($slug)
    {
        return self::where('slug', $slug)->where('status', 'active')->first();
    }
}