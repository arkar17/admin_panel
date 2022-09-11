<?php

namespace App\Exports;

use App\Models\Twodsalelist;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class Export2DSalesList implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return [
            'No',
            'Agent Name',
            'Customer Name',
            'Number','Amount'
        ];
    }
    public function collection()
    {
        return Twodsalelist::select('twodsalelists.id','twodsalelists.twod_id','twodsalelists.sale_amount',
        'twodsalelists.customer_name','users.name','twods.number')
        ->where('twodsalelists.status',1)
        ->orderBy('twodsalelists.id','desc')
        ->join('agents','agents.id','twodsalelists.agent_id')
        ->join('users','users.id','agents.user_id')
        ->join('twods','twods.id','twodsalelists.twod_id')
        ->get();
    }
}
