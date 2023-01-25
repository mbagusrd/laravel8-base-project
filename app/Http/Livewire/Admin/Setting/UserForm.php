<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserForm extends Component
{
    protected $listeners = ['change_crud_mode'];

    public $show = false;
    public $crud_mode = 'read';
    public $input_id;
    public $input_name;
    public $input_email;
    public $input_password;
    public $input_password_confirm;

    public function render()
    {
        return view('livewire.admin.setting.user-form');
    }

    public function act_kembali()
    {
        $this->show = false;

        $this->emitTo('admin.setting.user-datatable', 'act_refresh');
    }

    public function change_crud_mode($mode, $id = '')
    {
        $this->crud_mode = $mode;

        $this->clear_input();

        $this->resetErrorBag();

        if ($mode == 'create' or $mode == 'update') {
            $this->show = true;

            if ($mode == 'update') {
                $data = User::find($id);

                if ($data) {
                    $this->input_id = $id;
                    $this->input_name = $data->name;
                    $this->input_email = $data->email;
                    $this->input_password = '';
                    $this->input_password_confirm = '';
                }
            }
        } else {
            $this->show = false;
        }
    }

    public function clear_input()
    {
        $this->input_id = '';
        $this->input_name = '';
        $this->input_email = '';
        $this->input_password = '';
        $this->input_password_confirm = '';
    }

    public function tambah_data()
    {
        $this->validate([
            'input_name' => 'required',
            'input_email' => 'required|email|unique:users,email',
            'input_password' => 'required',
            'input_password_confirm' => 'required|same:input_password',
        ]);

        $data = User::create([
            'name' => $this->input_name,
            'email' => $this->input_email,
            'password' => Hash::make($this->input_password),
        ]);

        session()->flash('alert-success', 'Data berhasil ditambah');

        $this->clear_input();
    }

    public function edit_data()
    {
        $this->validate([
            'input_name' => 'required',
            'input_email' => "required|email|unique:users,email," . $this->input_id,
            'input_password' => 'same:input_password_confirm',
            'input_password_confirm' => 'same:input_password',
        ]);

        $data = User::find($this->input_id);

        $data->name = $this->input_name;
        $data->email = $this->input_email;

        if ($this->input_password != '') {
            $data->password = Hash::make($this->input_password);
        }

        $data->save();

        session()->flash('alert-success', 'Data berhasil diubah');

        $this->change_crud_mode('create');
    }
}
