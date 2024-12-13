<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    protected $fillable = [
        'title',
        'description',
        'job_type',
        'work_mode',
        'location',
        'published_at',
    ];

    public function positions()
    {
        return $this->hasMany(Position::class);
    }
}
