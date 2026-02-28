<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PgGroup extends Model
{
        protected $fillable = [
            'name',
            'owner_id'
        ];

    use HasFactory;
    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'pg_group_users');
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
