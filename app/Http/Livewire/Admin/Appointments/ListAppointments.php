<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Exports\AppointmentsExport;
use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ListAppointments extends AdminComponent
{
    protected $listeners = ['deleteConfirmed' => 'deleteAppointment'];

    public $appointmentIdBeingRemoved = null ;

    public $selectedRows = [];

    public $selectPageRows = false;

    public $status =  null;

    public $queryString = ['status'];

    public function confirmAppointmentRemoval($appointmentId){
        $this -> appointmentIdBeingRemoved = $appointmentId;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteAppointment(){
        $appointment = Appointment::findOrFail($this->appointmentIdBeingRemoved);
        $appointment->delete();
        $this->dispatchBrowserEvent('deleted' , ['message' => 'Appointment deleted successfully']);
    }


    public function filterAppointmentByStatus($status = null){
        $this->resetPage();
        $this->status = $status;
    }

    public function updatedSelectPageRows($value){
        if($value){
            $this->selectedRows = $this->appointmetns->pluck('id')->
            map(function ($id){
               return (string) $id ;
            });
        } else {
            $this->reset(['selectedRows','selectPageRows']);
        }
    }

    public function  markAllAsClosed(){
        Appointment::whereIn('id', $this->selectedRows)->update('status', 'CLOSED');

        $this->dispatchBrowserEvent('updated',
            ['message' => 'All selected Appointment got Closed']);
        $this->reset(['selectedRows' , 'selectPageRows']);
    }

    public function markAllAsScheduled(){
        Appointment::whereIn('id', $this->selectedRows)->update(['status'=> 'SCHEDULED']);

        $this->dispatchBrowserEvent('updated',
            ['message' => 'All selected Appointment got Scheduled']);
        $this->reset(['selectedRows' , 'selectPageRows']);
    }

    public function deleteSelectedRows(){
        Appointment::whereIn('id', $this->selectedRows)->delete();

        $this->dispatchBrowserEvent('deleted', ['message' => 'All Selected Appointment was deleted']);

       $this->reset(['selectPageRows']);
    }

    public function getAppointmentsProperty(){
        return  Appointment::with('client')
            ->when($this>$this->status, function($query , $status){
                return $query->where('status' , $status);
            })
            ->latest()
            ->paginate();
    }


    public function export(){
        return (new AppointmentsExport($this->selectedRows))
            ->download('appointments.xlsx');
        //        return Excel::download(new AppointmentsExport, 'appointments.xlsx');

    }



    public function render()
    {
        $appointments = $this->appointments;

        $appointmentscount = Appointment::where('status' , 'scheduled');
        $scheduledAppointment = Appointment::where('status' , 'scheduled')->count();
        $closeAppointment = Appointment::where('status' , 'closed')->count();


        return view('livewire.admin.appointments.list-appointments' ,[
            'appointments' => $appointments,
            'appointmentscount'=> $appointmentscount,
            'scheduledAppointment' => $scheduledAppointment,
            'closeAppointment' => $closeAppointment
        ]);
    }
}
