<?php

namespace App\Http\Livewire\Menu;

use App\Models\Menu;
use Illuminate\Support\Str;

trait MenuState
{
    public $previous;

    public $updateMode = false;

    public array $menu = [
    "id" => "",
    "parent_id" => "",
    "type" => "",
    "name" => "",
    "url" => "",
]
;

    public $showAlert = false;

    public $alertMessage = '';

    public $showToast = false;

    public $toastMessage = 'Table refreshed';

    public $showModalForm = false;

    public $showModalConfirm = false;

    public array $breadcrumbs = [
        ["link" => "#", "title" => "Admin" , "active" => false],
        ["link" => "#", "title" => "Menu" , "active" => true],
    ];

    public $options = [];

        public function create()
        {
            $this->reset(['menu', 'updateMode']);
            $this->showModalForm = true;
        }

    public function store()
    {
       $rules = [
    "menu.parent_id" => [
        "required"
    ],
    "menu.type" => [
        "required"
    ],
    "menu.name" => [
        "required"
    ],
    "menu.url" => [
        "required"
    ],
];
$this->validate($rules);


        $this->updateMode = false;

        $save = $this->handleFormRequest(new Menu);

        if ($save) {
            $this->reset("menu");
            $this->showAlert = true;
            $this->alertMessage = "Menu berhasil ditambahkan";
            $this->emit('refreshDt');
        }else{
            abort('403', 'Menu gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $menu = Menu::where('id', $id)->first();
        $this->menu = $menu->toArray();
        $this->showModalForm = true;
    }

    public function update()
    {
       $rules = [
    "menu.parent_id" => [
        "required"
    ],
    "menu.type" => [
        "required"
    ],
    "menu.name" => [
        "required"
    ],
    "menu.url" => [
        "required"
    ],
];
$this->validate($rules);


        $save = false;

        if ($this->menu["id"]) {
            $db = Menu::find($this->menu["id"]);
            $save = $this->handleFormRequest($db);
        } else {
            abort('403', 'Menu Not Found');
        }

        if ($save) {
             $this->reset("menu");
              $this->showAlert = true;
              $this->alertMessage = "Menu berhasil diupdate";
             $this->emit('refreshDt');
        }
    }

    public function destroy($id)
    {
        $delete = Menu::destroy($id);
        if ($delete) {
            $this->showAlert = true;
            $this->alertMessage = "Menu berhasil dihapus";
        } else {
            $this->showAlert = true;
            $this->alertMessage = "Menu gagal dihapus";
        }

        $this->emit("refreshDt", false);
        $this->reset(['menu', 'updateMode', 'showModalConfirm']);
    }

    private function handleFormRequest($db): bool
    {
        try {
            $db->parent_id = $this->menu['parent_id'];
                $db->type = $this->menu['type'];
                $db->name = $this->menu['name'];
                $db->url = $this->menu['url'];
    
            return $db->save();
        }catch (\Exception $e){
            return $e->getTraceAsString();
        }
    }

    public function back()
    {
        redirect($this->previous);
    }


}
