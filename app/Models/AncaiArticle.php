<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AncaiArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'catalog_id',
        'title',
        'content',
        'video_link',
        'sort',
    ];

    public function ancaiCourse()
    {
        return $this->belongsTo(AncaiCourse::class, 'course_id');
    }

    public function ancaiCatalog()
    {
        return $this->belongsTo(AncaiCatalog::class, 'catalog_id');
    }
}
