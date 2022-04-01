<?php

namespace App\Http\Livewire\CustomPage;

use App\Models\CustomPage;
use Illuminate\Support\Str;

trait CustomPageState
{
    public $previous;

    public $updateMode = false;

    public $custom_page = [
        "custom_page_id" => "",
        "title" => "test",
        "url" => "test",
        "content" => "test",
        "active" => false,
    ];

    public $showAlert = false;

    public $alertMessage = '';

    public $showToast = false;

    public $toastMessage = 'Table refreshed';

    public $showModalForm = false;

    public $showModalConfirm = false;

    public $options = [];

    public array $breadcrumbs = [
        ["link" => "#", "title" => "Admin", "active" => false],
        ["link" => "#", "title" => "Custom Page", "active" => true],
    ];

    public function save()
    {
        $this->updateMode ? $this->update() : $this->store();
    }

    public function store()
    {

        $rules = [
            "custom_page.title" => [
                "required"
            ],
            "custom_page.content" => [
                "required"
            ],
            "custom_page.active" => [
                "required"
            ],
        ];
        $this->validate($rules);

        $this->updateMode = false;

        $save = $this->handleFormRequest(new CustomPage);

        if ($save) {
            $this->back();
        } else {
            abort('403', trans('messages.page_not_added'));
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $custom_page = CustomPage::where('custom_page_id', $id)->first();
        $this->custom_page = $custom_page->toArray();
    }

    public function update()
    {
        $rules = [
            "custom_page.title" => [
                "required"
            ],
            "custom_page.content" => [
                "required"
            ],
            "custom_page.active" => [
                "required"
            ],
        ];
        $this->validate($rules);


        $save = false;

        if ($this->custom_page["custom_page_id"]) {
            $db = CustomPage::find($this->custom_page["custom_page_id"]);
            $save = $this->handleFormRequest($db);
        } else {
            abort('403', 'Custom Page Not Found');
        }

        if ($save) {
            $this->back();
        }
    }

    public function destroy($id)
    {
        $delete = CustomPage::destroy($id);
        if ($delete) {
            $this->showAlert = true;
            $this->alertMessage = trans('messages.page_destroy');
        } else {
            $this->showAlert = true;
            $this->alertMessage = trans('messages.page_not_destroy');
        }

        $this->emit("refreshDt", false);
        $this->reset(['custom_page', 'updateMode', 'showModalConfirm']);
    }

    private function handleFormRequest($db): bool
    {
        $db->title = $this->custom_page['title'];
        $db->url = Str::snake($this->custom_page['title'], "-");
        $db->content = $this->custom_page['content'];
        $db->active = $this->custom_page['active'];
        return $db->save();
    }

    public function back()
    {
        return redirect()->route('custom-page');
    }

}
