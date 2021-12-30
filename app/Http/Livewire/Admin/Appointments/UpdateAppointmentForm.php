<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UpdateAppointmentForm extends Component
{
    public $state = [];

    public $appointment ;

    public function mount(Appointment $appointment){
        $this->state = $appointment->toArray();
        $this->appointment = $appointment;


    }

    public function render()
    {
        $clients = Client::all();
        return view('livewire.admin.appointments.update-appointment-form',[
            'clients' => $clients,
        ]);
    }

    public function updateAppointment(){
        //validate
        Validator::make($this>state,[
            'client_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'note' => 'nullable',
            'status' => 'required|in:SCHEDULED,CLOSED',
        ] ,
            [
                'client_id.required' => 'the Client field is required.',
                'date.required' => 'you have to input time date',
                'time.required' => 'probably the time is required',
                'note.required' => 'please leave a small comment here ',
                'status.required' => 'every thing is clear',
            ])->validate();

        $this->appointment->update($this->state);

        $this->dispatchBrowserEvent('alert' ,
            ['message' => 'Appointment has been Updated Successfully']);
    }

}
