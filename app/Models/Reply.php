<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'topic_id',
        'parent_id',
        'content',
        'is_best',
        'read_count',
        'reply_count',
        'like_count',
    ];

    protected $casts = [
        'is_best' => 'boolean'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
