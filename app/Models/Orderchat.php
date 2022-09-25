<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderchat extends Model
{
    use HasFactory;
    protected $fillable = [
        'chatid',
        'user',
        'message',
        'orderid'
    ];
}
