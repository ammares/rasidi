<?php

namespace App\Exports;

use App\Traits\Common;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class CsvExport implements FromView, ShouldAutoSize
{
    use Common;

    private $data;
    private $view;

    public function __construct($data, $view)
    {
        $this->data = $data;
        $this->view = $view;   
    }

    public function view(): View
    {
        $this->setSelectedColumns();

        foreach ($this->columns as $key => $column) {
            if (in_array($this->columns[$key]['data'], ['icon', 'avatar', 'image'])) {
                Arr::pull($this->columns, $key);
            }
        }

        return view($this->view, [
            'data' => $this->data,
            'columns' => $this->columns,
        ]);
    }

    // public function getCsvSettings(): array
    // {
    //    return [
    //        'delimiter' => ",",
    //        'enclosure'        => '"',
    //        'escape_character' => '\\',
    //        'contiguous'       => false,
    //        'input_encoding'   => 'UTF-8', 
    //    ];
    // }
           
}