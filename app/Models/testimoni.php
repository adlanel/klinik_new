<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testimoni extends Model
{
    use HasFactory;
    
    protected $table = 'testimoni';
    
    protected $fillable = [
        'name',
        'role',
        'testimonial_text',
        'image',
        'order_number',
        'status'
    ];
    
    /**
     * Get the image URL attribute.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/homepage/testimoni/' . $this->image);
        }
        
        return asset('images/default-profile.jpg');
    }
    
    /**
     * Scope a query to only include active testimonials.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    
    /**
     * Scope a query to order by the order number.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_number', 'asc');
    }
}