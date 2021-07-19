<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AncaiCatalog extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'course_id',
        'title',
        'sort',
    ];

    public function parent()
    {
        return $this->belongsTo(AncaiCatalog::class, 'parent_id');
    }

    public function ancaiCourse()
    {
        return $this->belongsTo(AncaiCourse::class, 'course_id');

    }
}
