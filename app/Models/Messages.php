<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Messages;

class Messages extends Model
{
    use HasFactory;
    protected $table = 'messages';

    public static function newMessages(){
        $messages = Messages::where('status', 0)->get();
        $messageCount = $messages->count();
        return $messageCount;
    }
}
