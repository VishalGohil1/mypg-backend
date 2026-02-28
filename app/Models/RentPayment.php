<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'pg_group_id',
        'amount',
        'payment_date',
        'payment_month',
        'collected_by',
        'status',
        'remark'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function pgGroup()
    {
        return $this->belongsTo(PgGroup::class);
    }

    public function collector()
    {
        return $this->belongsTo(User::class, 'collected_by');
    }
}