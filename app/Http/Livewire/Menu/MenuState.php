<?php

namespace App\Http\Livewire\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Artisan;

trait MenuState
{
    public $previous;

    public $updateMode = false;

    public array $menu = [
        "id" => "",
        "label" => "",
        "type" => "",
        "url" => "",
        "children" => "",
    ];

    public array $list = [];

    public array $pages = [];

    public $showAlert = false;

    public $alertMessage = '';

    public $showToast = false;

    public $toastMessage = 'Table refreshed';

    public $showModalForm = false;

    public $showModalConfirm = false;

    public array $breadcrumbs = [
        ["link" => "#", "title" => "Admin", "active" => false],
        ["link" => "#", "title" => "Menu", "active" => true],
    ];

    public $options = [];

    public function getData()
    {
        $menu = Menu::all()->toArray();

        $tree = $this->menuBuilder($menu);

        $this->list = $tree;
    }

    public function menuBuilder($elements, $parentId = 0): array
    {
        $branch = [];
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->menuBuilder($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }else{
                    $element['children'] = [];
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    public function saveList($list)
    {
        Menu::truncate();
        $this->saveListFromArray($list, 0);
        $this->alertMessage = trans('messages.menu_updated');
        $this->showAlert = true;
    }

    public function saveListFromArray($elements, $parentId = 0)
    {
        foreach ($elements as $element) {
            $db = new Menu();
            $db->parent_id = $parentId;
            $db->type = $element['type'];
            $db->label = $element['label'];
            $db->url = $element['url'];
            $db->save();
            if (isset($element['children']) && count($element['children']) > 0) {
                $this->saveListFromArray($element['children'], $db->id);
            }
        }
    }

    public function resetList()
    {
        Menu::truncate();
        Artisan::call('db:seed --class=MenuSeeder');
        $this->alertMessage = 'data reset';
        $this->showAlert = true;
        $this->getData();
        $this->emit('refresh', $this->list);
    }

    public function create()
    {
        $this->reset(['menu']);
        $this->updateMode = false;
        $this->showModalForm = true;
    }

    public function store()
    {
        $db = new Menu();
        $this->handleFormRequest($db);
        $this->alertMessage = trans('messages.menu_added');
        $this->showAlert = true;
        $this->showModalForm = false;
        $this->getData();
        $this->emit('refresh', $this->list);
    }

    public function edit($el)
    {
        $this->menu = $el;
        $this->updateMode = true;
        $this->showModalForm = true;
    }

    public function update()
    {
        $db = Menu::find($this->menu['id']);
        $this->handleFormRequest($db);
        $this->alertMessage = trans('messages.menu_updated');
        $this->showAlert = true;
        $this->showModalForm = false;
        $this->getData();
        $this->emit('refresh', $this->list);
    }

    public function handleFormRequest(Menu $db)
    {
        $element = $this->menu;
        if (!$this->updateMode) {
            $db->parent_id = 0;
        }
        $db->type = $element['type'];
        $db->label = $element['label'];
        $db->url = $element['url'];
        $db->save();
    }

    public function destroy($id)
    {
        $db = Menu::find($id);
        $db->delete();
        $this->alertMessage = trans('messages.menu_destroy');
        $this->showAlert = true;
        $this->getData();
        $this->emit('refresh', $this->list);
    }

    public function back()
    {
        redirect($this->previous);
    }


}
