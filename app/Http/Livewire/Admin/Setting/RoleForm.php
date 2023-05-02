<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;
use Livewire\Component;

class RoleForm extends Component
{
    protected $listeners = ['change_crud_mode'];

    public $show = false;
    public $crud_mode = 'read';
    public $input_id;
    public $input_name;
    public $input_display_name;
    public $input_description;
    public $array_permissions = [];

    public function render()
    {
        return view('livewire.admin.setting.role-form');
    }

    public function act_kembali($alert = "", $alertMsg = "")
    {
        $this->show = false;

        $this->crud_mode = 'read';

        $this->emitTo('admin.setting.role-datatable', 'act_refresh', $alert, $alertMsg);
    }

    public function change_crud_mode($mode, $id = '')
    {
        $this->crud_mode = $mode;

        $this->clear_input();

        $this->resetErrorBag();

        if ($mode == 'create' or $mode == 'update') {
            $this->show = true;

            if ($mode == 'update') {
                $data = Role::find($id);

                if ($data) {
                    $this->input_id = $id;
                    $this->input_name = $data->name;
                    $this->input_display_name = $data->display_name;
                    $this->input_description = $data->description;

                    $role = Role::query()
                        ->with('permissions:id')
                        ->findOrFail($id);

                    $this->array_permissions = Permission::all(['id', 'name', 'display_name'])
                        ->map(function ($permission) use ($role) {
                            $permission->assigned = $role->permissions
                                ->pluck('id')
                                ->contains($permission->id);

                            return $permission;
                        });

                    // $this->array_permissions = [];

                    // foreach ($permissions as $key => $value) {
                    //     $this->array_permissions[] = $value;
                    // }
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

    public function select_all_permissions()
    {
        $this->array_permissions = array_map(function ($permission) {
            $permission['assigned'] = true;

            return $permission;
        }, $this->array_permissions);
    }

    public function clear_all_permissions()
    {
        $this->array_permissions = array_map(function ($permission) {
            $permission['assigned'] = false;

            return $permission;
        }, $this->array_permissions);
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

        $check = Role::where('name', $this->input_name)->get();

        if (sizeof($check) > 0) {
            $this->addError('input_name', 'nama Role sudah ada');
        } else {
            $data = Role::create([
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

        $check = Role::where('name', $this->input_name)->where('id', '!=', $this->input_id)->get();

        if (sizeof($check) > 0) {
            $this->addError('input_name', 'nama Role sudah ada');
        } else {
            $data = Role::find($this->input_id);

            $data->display_name = $this->input_display_name;
            $data->name = $this->input_name;
            $data->description = $this->input_description;

            $data->save();

            $assignedPermission = [];

            foreach ($this->array_permissions as $key => $value) {
                if ($value['assigned']) {
                    $assignedPermission[] = $value['id'];
                }
            }

            $data->syncPermissions($assignedPermission);

            $this->change_crud_mode('read');

            $this->act_kembali("success", "Data berhasil diubah");
        }
    }
}
