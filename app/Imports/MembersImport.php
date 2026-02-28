<?php

namespace App\Imports;

use App\Models\Member;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MembersImport implements ToCollection
{
    protected $pgGroupId;

    public function __construct($pgGroupId)
    {
        $this->pgGroupId = $pgGroupId;
    }

    public function collection(Collection $rows)
    {
        // Skip header row
        unset($rows[0]);

        foreach ($rows as $row) {

            Member::create([

                'pg_group_id' => $this->pgGroupId,

                'first_name' => $row[0],

                'last_name' => $row[1],

                'email' => $row[2] ?? null,

                'phone' => $row[3],

                'emergency_contact' => $row[4],

                'city' => $row[5],

                'room_number' => $row[6],

                'bed_sharing' => $row[7],

                'rent_amount' => $row[8],

                'occupation' => $row[9] ?? null,

                'remark' => $row[10] ?? null,

                'is_active' => 1,

            ]);

        }
    }
}