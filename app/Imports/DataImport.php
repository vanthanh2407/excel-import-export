<?php

namespace App\Imports;

use App\Models\Group; 
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;

class DataImport implements ToCollection, WithValidation
{
    public function collection(Collection $rows)
    {
        foreach ($rows->skip(1) as $row) {
            $group = Group::where('group_name', $row[1])->first();

            if (!$group) {
                $group = Group::create([
                    'group_name' => $row[1],
                    'title' => $row[2],
                    'content' => $row[3],
                ]);
            }

            Product::create([
                'group_id' => $group->id,
                'name' => $row[5],
                'details' => $row[6],
            ]);
        }
    }

}
