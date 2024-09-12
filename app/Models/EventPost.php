<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPost extends Model
{
    use HasFactory;

    protected $table = 'event_posts';

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'location_name',
        'location_url',
        'tags',
        'event_image_url',
        'user_id', // Foreign key
        'price',
        'restriction_age_min',
        'restriction_age_max',
        'accecciblity_disablity',
    ];  

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    
}
