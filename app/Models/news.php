<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class news extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'content',
        'image',
        'author',
        'published_at',
        'status'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/homepage/news/' . $this->image);
        }
        return asset('images/default-news.jpg');
    }

    // Format published date to readable format
    public function getFormattedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('d M Y') : '';
    }

    // Get reading time based on content length
    public function getReadingTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = ceil($words / 200); // Average reading speed: 200 words per minute
        return $minutes . ' menit membaca';
    }
    
    // Static method to get all published news
    public static function getAllPublished()
    {
        return self::where('status', 'published')
                   ->orderBy('published_at', 'desc')
                   ->get();
    }
}