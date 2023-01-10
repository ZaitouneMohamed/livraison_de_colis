<?php

namespace App\Http\Livewire;

use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;


class User extends Component
{
    public $editing;
    public $name;
    public $email;
    public $password;
    public $users;
    public $user_id;

    public function render()
    {
        return view('livewire.user');
    }

    public function mount() {
        $this->show_users();
    }

    public function show_users() {
        $userslist = ModelsUser::all()->where('role',0);
        $this->users=$userslist;
    }

    public function getuser($id) {
        $user = ModelsUser::find($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->user_id = $user->id;
        $this->editing = true;
    }

    public function add_user() {
        $this->validate();
        ModelsUser::create([
            "name" => $this->name,
            "email" => $this->email,
            "password" => Hash::make($this->password),
            "active" => 1
        ]);
        $this->clearinputs();
        $this->show_users();
        session()->flash('message', 'User successfully added');
    }

    public function update_user() {
        $this->validate();
        $userr = ModelsUser::find($this->user_id);
        $userr->name = $this->name;
        $userr->email = $this->email;
        $userr->password = Hash::make($this->password);
        $userr->update();
        $this->clearinputs();
        $this->show_users();
        $this->editing = false;
        session()->flash('message', 'User updated successfully');
    }

    public function delete_user($id) {
        $user = ModelsUser::find($id);
        $user->delete();
        $this->clearinputs();
        $this->show_users();
        $this->editing = false;
        session()->flash('message', 'User deleted successfully');
    }

    public function cancel() {
        $this->clearinputs();
        $this->editing = false;
        $this->user_id = "" ;
    }

    public function clearinputs() {
        $this->name = "";
        $this->email = "";
        $this->password = "";
    }

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    protected $messages = [
        'name.required' => 'name ra required a sat',
        'name.min' => 'name min ra 6',
        'email.required' => 'email ra required a sat',
        'email.min' => 'email min ra 6',
        'password.required' => 'passwod ra required a sat',
        'password.min' => 'password min ra 6',
    ];



}
