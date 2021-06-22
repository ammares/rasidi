<?php

namespace App\Exports;

use App\Traits\Common;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExcelExport implements FromView, ShouldAutoSize, WithEvents
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

    public function registerEvents(): array
    {       
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRangeHeader = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRangeHeader)->getFont()->setSize(14)->setBold(true);            
                }  
        ];
        
    }

    
}
