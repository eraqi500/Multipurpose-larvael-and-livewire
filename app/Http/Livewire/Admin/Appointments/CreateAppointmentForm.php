<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use http\Client;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateAppointmentForm extends Component
{
    public $state = [
        'status' => 'SCHEDULED',
    ];

    public function createAppointment(){
        //validate
        Validator::make($this>state,[
            'client_id' => 'required',
            'members' =>'required',
            'color' => 'requierd',
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

        Appointment::create($this->state);

        $this->dispatchBrowserEvent('alert' ,
            ['message' => 'Appointment has been created Successfully']);
    }

    public function render()
    {

        $client = Client::all();
        return view('livewire.admin.appointments.create-appointment-form',[
            'client' => $client
        ]);
    }
}
