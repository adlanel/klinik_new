<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banner';
    
    // Tell Laravel to not expect updated_at column
    public $timestamps = false;
    
    protected $fillable = [
        'image_desktop',
        'image_mobile',
        'link_url',
        'order_number'
    ];
    
    /**
     * Get the desktop image URL.
     *
     * @return string
     */
    public function getDesktopImageUrlAttribute()
    {
        return asset('storage/homepage/banner/' . $this->image_desktop);
    }
    
    /**
     * Get the mobile image URL.
     *
     * @return string
     */
    public function getMobileImageUrlAttribute()
    {
        return asset('storage/homepage/banner/' . $this->image_mobile);
    }
    
    /**
     * Get all sliders ordered by order_number.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllOrdered()
    {
        return self::orderBy('order_number', 'asc')->get();
    }
}