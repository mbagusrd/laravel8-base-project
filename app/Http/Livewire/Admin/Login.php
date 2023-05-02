<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $redirect_to;
    public $email;
    public $password;

    public function render()
    {
        return view('livewire.admin.login');
    }

    public function mount()
    {
        if ($this->redirect_to == '') {
            $redirect_to = url()->previous();

            if (session()->has('login_redirect_to')) {
                $redirect_to = session()->get('login_redirect_to');
            }

            $this->redirect_to = $redirect_to;
        }
    }

    public function do_login()
    {
        $this->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $this->email)->first();

        if ($user) {
            if (Hash::check($this->password, $user->password)) {
                Auth::login($user);

                $this->reset_field();

                session()->flash('alert-success', 'Login Berhasil .. Harap Tunggu');
                session()->remove('login_redirect_to');

                $this->dispatchBrowserEvent('goto', ['url' => $this->redirect_to]);
            } else {
                session()->flash('alert-error', 'Password salah');
            }
        } else {
            session()->flash('alert-error', 'Email tidak ditemukan');
        }
    }

    private function reset_field()
    {
        $this->email = null;
        $this->password = null;
    }
}
