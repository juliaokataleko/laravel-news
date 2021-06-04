<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'user_id',
        'resume',
        'image',
        'category_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getReadAttribute()
    {
        Read::create([
            'post_id' => $this->id,
            'user_id' => auth()->id() ?? ''
        ]);
    }

    public function reads()
    {
        return $this->hasMany(Read::class);
    }
}
