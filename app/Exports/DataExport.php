<?php

namespace App\Exports;

use App\Models\Group;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $data = Group::with('products')->get();
        
        $exportData = [];
        foreach ($data as $group) {
            foreach ($group->products as $product) {
                $exportData[] = [
                    'Group ID' => $group->id,
                    'Group Name' => $group->group_name,
                    'Title' => $group->title,
                    'Content' => $group->content,
                    'Product ID' => $product->id,
                    'Name' => $product->name,
                    'Details' => $product->details,
                ];
            }
        }

        return collect($exportData);
    }

    public function headings(): array
    {
        return [
            'Group ID',
            'Group Name',
            'Title',
            'Content',
            'Product ID',
            'Name',
            'Details',
        ];
    }
}
