<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AppointmentsExport implements FromQuery , WithMapping , WithHeadings
{

    use Exportable;

    protected $selectedRows;

    public function __construct($selectedRows)
    {
        $this->selectedRows = $selectedRows;
    }

    public function map($app):array {
        return [
          $app->  id,
          $app->  client->name ,
          $app->  date,
          $app->  time,
          $app->  status,
        ];
    }

    public function headings(): array
    {
        return [
          '#ID',
          'Client_name',
          'Date',
          'Time',
          'Status',
        ];
    }

//    /**
//    * @return \Illuminate\Support\Collection
//    */
//    public function collection()
//    {
//        return Appointment::all();
//    }


    public function query(){
        return Appointment::With('client:id,name')
            ->whereIn('id',$this->selectedRows);
    }
}
