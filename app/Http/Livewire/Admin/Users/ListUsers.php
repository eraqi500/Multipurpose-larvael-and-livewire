<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ListUsers extends AdminComponent
{

    use WithFileUploads;


    public $state = [];
    public $showEditModal = false;
    public $user;
    public $userIdBeingRemoved = null;
    public $searchTerm = null;
    public $photo;


    public function addNew(){
        $this->reset();
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

         if($this->photo) {
             $validateData['avatar'] = $this->photo->store('/','avatars');
         }

         User::create($validateData);

//         session()->flash('message','user added Successfully!');

         $this->dispatchBrowserEvent('hide-form',['message'=> 'user added successfully']);

         return $this->redirect()->back();

    }

    public function edit(User $user){
        $this->reset();
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

        if($this->photo) {
            Storage::disk('avatars')->delete($this->user->photo);
            $validateData['avatar'] = $this->photo->store('/','avatars');
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

    public function changeRole(User $user , $role){
        Validator::make(['role' => $role],[
           'role' => [
               'required',
               Rule::in(User::ROLE_ADMIN, User::ROLE_USER)
           ]
        ])->validate();

        $user->update(['role' => $role]);

        $this->dispatchBrowserEvent('updated',['USer has change his Role in system']);
    }


    public function render()
    {


        $users = User::query()
        ->where('name','like','%'.$this->searchTerm.'%')
        ->orWhere('email','like','%'.$this->searchTerm.'%')
        ->latest()->paginate(5);
        return view('livewire.admin.users.list-users',[
            'users' => $users
        ]);
    }
}
