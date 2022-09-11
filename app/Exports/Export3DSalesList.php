<?php

namespace App\Exports;

use App\Models\Threedsalelist;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class Export3DSalesList implements FromCollection, WithHeadings
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
        //
        return Threedsalelist::select('threedsalelists.id','threedsalelists.threed_id','threedsalelists.sale_amount',
        'threedsalelists.customer_name','users.name','threeds.number')
        ->where('threedsalelists.status',1)
        ->orderBy('threedsalelists.id','desc')
        ->join('threeds','threeds.id','threedsalelists.threed_id')
        ->join('agents','agents.id','threedsalelists.agent_id')
        ->join('users','users.id','agents.user_id')
        ->get();
    }
}
