<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'title',
        'location',
        'website',
        'email',
        'tags',
        'description',
        'user_id', 
    ];

    public function scopeFilter($query, array $filters)
{
    if (!empty($filters['tag'])) {
        $query->where('tags', 'like', '%' . $filters['tag'] . '%');
    }

    if (!empty($filters['search'])) {
        $query->where(function ($q) use ($filters) {
            $q->where('title', 'like', '%' . $filters['search'] . '%')
              ->orWhere('description', 'like', '%' . $filters['search'] . '%')
              ->orWhere('tags', 'like', '%' . $filters['search'] . '%');
        });
    }
}


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
