<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Permission;
use Illuminate\Support\Str;
use Livewire\Component;

class PermissionForm extends Component
{
    protected $listeners = ['change_crud_mode'];

    public $show = false;
    public $crud_mode = 'read';
    public $input_id;
    public $input_name;
    public $input_display_name;
    public $input_description;

    public function render()
    {
        return view('livewire.admin.setting.permission-form');
    }

    public function act_kembali($alert = "", $alertMsg = "")
    {
        $this->show = false;

        $this->emitTo('admin.setting.permission-datatable', 'act_refresh', $alert, $alertMsg);
    }

    public function change_crud_mode($mode, $id = '')
    {
        $this->crud_mode = $mode;

        $this->clear_input();

        $this->resetErrorBag();

        if ($mode == 'create' or $mode == 'update') {
            $this->show = true;

            if ($mode == 'update') {
                $data = Permission::find($id);

                if ($data) {
                    $this->input_id = $id;
                    $this->input_name = $data->name;
                    $this->input_display_name = $data->display_name;
                    $this->input_description = $data->description;
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
        $this->input_display_name = '';
        $this->input_description = '';
    }

    public function update_slug()
    {
        $this->resetErrorBag();

        $this->input_name = strtolower(Str::slug($this->input_display_name));
    }

    public function validateInput()
    {
        $this->validate([
            'input_display_name' => 'required',
            'input_name' => '',
            'input_description' => '',
        ]);
    }

    public function create_data()
    {
        $this->validateInput();
        $check = Permission::where('name', $this->input_name)->get();

        if (sizeof($check) > 0) {
            $this->addError('input_name', 'nama Permission sudah ada');
        } else {
            $data = Permission::create([
                'display_name' => $this->input_display_name,
                'name' => $this->input_name,
                'description' => $this->input_description,
            ]);

            session()->flash('alert-success', 'Data berhasil ditambah');

            $this->clear_input();
        }
    }

    public function update_data()
    {
        $this->validateInput();

        $check = Permission::where('name', $this->input_name)->where('id', '!=', $this->input_id)->get();

        if (sizeof($check) > 0) {
            $this->addError('input_name', 'nama Permission sudah ada');
        } else {
            $data = Permission::find($this->input_id);

            $data->display_name = $this->input_display_name;
            $data->name = $this->input_name;
            $data->description = $this->input_description;

            $data->save();

            $this->act_kembali("success", "Data berhasil diubah");

            $this->change_crud_mode('read');
        }
    }
}
