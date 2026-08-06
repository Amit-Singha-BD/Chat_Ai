<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model {
    use HasFactory;

    const ROLE_USER = 'user';
    const ROLE_ASSISTANT = 'assistant';

    protected $fillable = [
        'conversation_id',
        'role',
        'content'
    ];

    // Relationships
    public function conversation(){
        return $this->belongsTo(Conversation::class);
    }
}
