<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'picture',
        'name',
        'surname',
        'position_id',
        'short_profile',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
