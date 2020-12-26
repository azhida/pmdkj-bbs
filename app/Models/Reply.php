<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'topic_id',
        'parent_id',
        'content',
        'is_best',
    ];

    protected $casts = [
        'is_best' => 'boolean'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
