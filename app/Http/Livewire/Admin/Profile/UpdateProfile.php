<?php

namespace App\Http\Livewire\Admin\Profile;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\FileUploadConfiguration;
use Livewire\WithFileUploads;

class UpdateProfile extends Component
{

    use WithFileUploads;

    public $image;

    public $state = [];

    public function updatedImage(){

        $previousPath = auth()->user()->avatar;

        $path = $this->image->store('/','avatars');

        auth()->user()->update(['avatar' => $path]);

        Storage::disk('avatars')->delete($previousPath);

        $this->dispatchBrowserEvent('updated',['message' => 'profile pic changed Successfully']);
    }



    public function render()
    {
        return view('livewire.admin.profile.update-profile');
    }
}
