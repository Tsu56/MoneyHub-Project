<?php

namespace App\Exports;

use App\Http\Controllers\transactionController;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SummarizeExport implements FromCollection, WithHeadings
{
    protected $data;
    function __construct($data){
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        return collect($this->data);
        // return Transaction::all();
    }

    public function headings():array{
        return ['Transaction_type','Category','Amount','Description','Date-Time'];
    }
}
