<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    protected $table = 'chatbots'; // atau nama table awak
    protected $fillable = ['question', 'answer'];
    public $timestamps = false;
}
