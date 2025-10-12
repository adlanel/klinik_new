<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas';
    
    protected $fillable = [
        'title',
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
        return $this->image ? asset('storage/homepage/fasilitas/' . $this->image) : asset('images/default-facility.jpg');
    }

    /**
     * Get all active facilities
     */
    public static function getAllActive()
    {
        return self::where('status', 'active')
            ->orderBy('id', 'asc')
            ->get();
    }

    /**
     * Get a specific facility by slug
     */
    public static function getBySlug($slug)
    {
        return self::where('slug', $slug)
            ->where('status', 'active')
            ->first();
    }
}