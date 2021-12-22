<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ListUsers extends Component
{

    public $state = [];
    public $showEditModal = false;
    public $user;
    public $userIdBeingRemoved = null;

    public function addNew(){
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser(){
//        dd($this->state);
         $validateData = validator::make($this->state,[
           'name' => 'required' ,
           'email' =>'required|email|unique:users',
            'password' => 'required|confirmed',
        ])->validate();

         $validateData['password'] = bcrypt($validateData['password']);

         User::create($validateData);

//         session()->flash('message','user added Successfully!');

         $this->dispatchBrowserEvent('hide-form',['message'=> 'user added successfully']);

         return $this->redirect()->back();

    }

    public function edit(User $user){
        $this->showEditModal = true;
        $this->user = $user;
        $this->state =$user ->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser(){
        $validateData = validator::make($this->state,[
            'name' => 'required' ,
            'email' =>'required|email|unique:users,email'.'$this->user->id',
            'password' => 'sometimes|confirmed',
        ])->validate();

        if(!empty($validateData['password'])){
            $validateData['password'] = bcrypt($validateData['password']);
        }

        User::update($validateData);

//         session()->flash('message','user added Successfully!');

        $this->dispatchBrowserEvent('hide-form',['message'=> 'user Updated successfully']);

        return $this->redirect()->back();

    }

    public function confirmUserRemoval($userId){
        $this->userIdBeingRemoved = $userId;

        $this->dispatchBrowserEvent('show-delete-model');

    }

    public function deleteUser(){
        $user = User::findOrFail($this->userIdBeingRemoved);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal' , ['message' => 'user has been deleted successfully']);
    }


    public function render()
    {
        $users = User::latest()->paginate();
        return view('livewire.admin.users.list-users',[
            'users' => $users
        ]);
    }
}
