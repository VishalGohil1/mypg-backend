<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeTemplate extends Model
{
    protected $fillable = [
        'pg_group_id',
        'subject',
        'description'
    ];
}