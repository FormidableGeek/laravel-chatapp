<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'receiver_id',
        'message',
        'conversation_id'
    ];


    public function user() {
        return $this->belongsTo(User::class,'id');
    }


    public function latestMessage()
    {
        return $this->hasOne(Message::class, 'id')->latest();
    }

    // Define a relationship for all messages in a conversation
    public function messages()
    {
        return $this->hasMany(Message::class, 'id');
    }
    
}
