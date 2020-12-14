<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PingModel extends Model
{
    use HasFactory;

    protected $table = "ping";

    protected $fillable = [
        'message',
    ];

    public $timestamps = true;

}
