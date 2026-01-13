<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'intent',
        'description',
        'language',
        'code'
    ];

    // Relationship: A CodeBlock belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function revisions()
    {
        return $this->hasMany(Revision::class)
        ->orderBy('created_at', 'desc');
    }
}