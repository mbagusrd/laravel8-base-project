<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Permission;
use Livewire\Component;
use Livewire\WithPagination;

class PermissionDatatable extends Component
{
    use WithPagination;

    protected $listeners = ['act_refresh'];

    public $show = true;
    public $cari = '';
    public $pagination = 10;

    public function render()
    {
        $data_tables = $this->load_data();

        return view('livewire.admin.setting.permission-datatable', compact('data_tables'));
    }

    public function mount()
    {
        $this->check_last_page();
    }

    public function act_refresh($alert = "", $alertMsg = "")
    {
        $this->show = true;

        $this->check_last_page();

        if ($alert and $alertMsg) {
            session()->flash("alert-$alert", $alertMsg);
        }
    }

    public function act_tambah()
    {
        $this->show = false;

        $this->emitTo('admin.setting.permission-form', 'change_crud_mode', 'create');
    }

    public function act_edit($id)
    {
        $this->show = false;

        $this->emitTo('admin.setting.permission-form', 'change_crud_mode', 'update', $id);
    }

    private function load_data($modesql = false)
    {
        $cari = ($this->cari != '') ? str_replace(" ", "%", $this->cari) : '';

        $fields = ['name', 'display_name', 'description'];

        $data_tables = Permission::latest();

        if ($cari != '') {
            $data_tables->where(
                function ($query) use ($fields, $cari) {
                    foreach ($fields as $key => $value) {
                        $query->orWhere($value, 'like', "%" . $cari . "%");
                    }
                }
            );
        }

        if ($modesql) {
            dd($cari, $data_tables->toSql(), $data_tables->paginate($this->pagination));
        } else {
            return $data_tables->paginate($this->pagination);
        }
    }

    public function cari()
    {
        $this->gotoPage('1');
    }

    public function check_last_page()
    {
        $last_page = $this->load_data()->lastPage();

        if ($this->page > $last_page) {
            $this->gotoPage($last_page);
        }
    }

    public function delete_data($id)
    {
        $data = Permission::find($id);

        $data->delete();

        // $data->doSoftDelete();

        $this->check_last_page();

        session()->flash('alert-success', 'Data berhasil dihapus');
    }
}
