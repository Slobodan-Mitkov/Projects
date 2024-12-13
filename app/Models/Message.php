<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'full_name',
        'number',
        'country',
        'message',
        'email',
        'read',
    ];

    public function markAsRead()
    {
        $this->update(['read' => true]);
    }

    public function markAsUnread()
    {
        $this->update(['read' => false]);
    }
}
