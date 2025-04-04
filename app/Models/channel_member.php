<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class channel_member extends Model
{
    protected $fillable = ['id','channel_id','user_id'];
}
