<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PGGroupUser extends Model
{
    use HasFactory;
    protected $table = 'pg_group_users';
    
    protected $fillable = [
        'pg_group_id',
        'user_id',
        'role'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
