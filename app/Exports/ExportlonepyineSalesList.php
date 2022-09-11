<?php

namespace App\Exports;

use App\Models\Lonepyinesalelist;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportlonepyineSalesList implements FromCollection, WithHeadings
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
        return Lonepyinesalelist::select('lonepyinesalelists.id','lonepyinesalelists.sale_amount',
        'lonepyinesalelists.customer_name','users.name','lonepyines.number')
        ->where('lonepyinesalelists.status',1)
        ->join('agents','agents.id','lonepyinesalelists.agent_id')
        ->join('users','users.id','agents.user_id')
        ->join('lonepyines','lonepyines.id','lonepyinesalelists.lonepyine_id')
        ->get();
    }
}
