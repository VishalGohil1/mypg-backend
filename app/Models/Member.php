<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'pg_group_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'emergency_contact',
        'city',
        'room_number',
        'bed_sharing',
        'rent_amount',
        'occupation',
        'remark',
        'is_active'
    ];

    public function pgGroup()
    {
        return $this->belongsTo(PgGroup::class);
    }

    public function payments()
    {
        return $this->hasMany(RentPayment::class);
    }
}