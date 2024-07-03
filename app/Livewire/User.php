<?php

namespace App\Livewire;

use Livewire\Component;



class User extends Component
{

    public $name = "";
    public $email = "";
    public $password = "";
    public $password_confirmation = "";

    public function render()
    {
        $data = \App\Models\User::all();
        return view('livewire.user')->with('data', $data);
    }

    public function submitForm()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required_with:password|same:password|min:8',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus dalam format yang benar',
            'password.required' => 'Password harus diisi',
            'password.confirmed' => 'Password tidak cocok',
            'password_confirmation.required_with' => 'Konfirmasi password harus diisi',
            'password_confirmation.same' => 'Password tidak cocok',
            'password_confirmation.min' => 'Password minimal 8 karakter',
        ]);

        \App\Models\User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        // session()->flash("success", "Data Berhasil ditambahkan!");
        $this->dispatch('swal', [
            'title' => 'Success!',
            'text' => 'Berhasil menambahkan data ',
            'icon' => 'success',
        ]);

        $this->name = "";
        $this->email = "";
        $this->password = "";
        $this->password_confirmation = "";
    }

    public function delete($id)
    {

        \App\Models\User::find($id)->delete();

        $this->dispatch('swal', [
            'title' => 'Success!',
            'text' => 'Berhasil menghapus data ',
            'icon' => 'success',
        ]);
        // session()->flash("success", "Data Berhasil dihapus!");
    }
}
