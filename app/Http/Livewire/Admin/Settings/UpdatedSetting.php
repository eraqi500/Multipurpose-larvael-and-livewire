<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;

class UpdatedSetting extends Component
{
    public $state = [];

    public function mount(){
        $setting = Setting::first();

        if($setting){
            $this->state = $setting->toArray();
        }
    }

    public function updateSetting(){

        $setting = Setting::first();
        if($setting){
            //updated
            $setting->update($this->state);
        } else {
            //creating
            Setting::create($this->state);
        }

        Cache::forget('setting');


        $this->dispatchBrowserEvent('updated',
            ['message' => 'Settings updated successfully']);
    }

    public function render()
    {
        return view('livewire.admin.settings.updated-setting');
    }
}
