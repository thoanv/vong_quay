<?php


namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ListCheckInExport implements FromView
{
    private $data;
    public function __construct($data){
        $this->data = $data;
    }
    public function view(): View
    {
        $attendances = $this->data->attendances;
        return view('admin.attendances.export', ['attendances' => $attendances]);
    }
}
