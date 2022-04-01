<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;

trait CategoryState
{
    public $previous;

    public $updateMode = false;

    public array $category = [
        "category_id" => "",
        "name" => "",
        "active" => true,
        "created_at" => "",
        "updated_at" => "",
    ];

    public $showAlert = false;

    public $alertMessage = '';

    public $showToast = false;

    public $toastMessage = 'Table refreshed';

    public $showModalForm = false;

    public $showModalConfirm = false;

    public array $breadcrumbs = [];

    public $options = [];

    public function create()
    {
        $this->reset(['category', 'updateMode']);
        $this->showModalForm = true;
    }

    public function store()
    {
        $rules = [
            "category.name" => [
                "required"
            ],
            "category.active" => [
                "required"
            ],
        ];
        $this->validate($rules);

        $this->updateMode = false;

        $save = $this->handleFormRequest(new Category);

        if ($save) {
            $this->showAlert = true;
            $this->alertMessage = trans('messages.category_added');
            $this->emit('refreshDt');
            $this->reset("category");
            $this->showModalForm = false;
        } else {
            abort('403',  trans('messages.category_not_added'));
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $category = Category::where('category_id', $id)->first();
        $this->category = $category->toArray();
        $this->showModalForm = true;
    }

    public function update()
    {
        $rules = [
            "category.name" => [
                "required"
            ],
            "category.active" => [
                "required"
            ]
        ];
        $this->validate($rules);


        $save = false;

        if ($this->category["category_id"]) {
            $db = Category::find($this->category["category_id"]);
            $save = $this->handleFormRequest($db);
        } else {
            abort('403',  trans('messages.category_not_updated'));
        }

        if ($save) {
            $this->reset("category");
            $this->showModalForm = false;
            $this->showAlert = true;
            $this->alertMessage =  trans('messages.category_updated');
            $this->emit('refreshDt');
        }
    }

    public function destroy($id)
    {
        $delete = Category::destroy($id);
        if ($delete) {
            $this->showAlert = true;
            $this->alertMessage = trans('messages.category_destroy');
        } else {
            $this->showAlert = true;
            $this->alertMessage =  trans('messages.category_not_destroy');
        }

        $this->emit("refreshDt");
        $this->reset(['category', 'updateMode', 'showModalConfirm']);
    }

    private function handleFormRequest($db): bool
    {
        $db->name = $this->category['name'];
        $db->active = $this->category['active'];
        return $db->save();
    }

    public function back()
    {
        redirect($this->previous);
    }


}
