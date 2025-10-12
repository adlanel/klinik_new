<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    protected $table = 'logos';
    
    protected $fillable = [
        'path',
    ];

    /**
     * Get the current logo - since we only keep one logo at a time
     */
    public static function getCurrentLogo()
    {
        return self::first();
    }

    /**
     * Get the full URL path to the logo
     */
    public function getUrlAttribute()
    {
        return asset('storage/logo/' . $this->path);
    }
}