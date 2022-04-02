<?php

namespace App\Http\Livewire\RelatedLink;

use App\Models\RelatedLink;
use Illuminate\Support\Str;

trait RelatedLinkState
{
    public $previous;

    public $updateMode = false;

    public $image;

    public array $related_link = [
        "related_link_id" => "",
        "label" => "",
        "url" => "https://",
        "icon" => "",
    ];

    public $showAlert = false;

    public $alertMessage = '';

    public $showToast = false;

    public $toastMessage = 'Table refreshed';

    public $showModalForm = false;

    public $showModalConfirm = false;

    public array $breadcrumbs = [
        ["link" => "#", "title" => "Admin", "active" => false],
        ["link" => "#", "title" => "LinkTerkait", "active" => true],
    ];

    public $options = [];

    public function create()
    {
        $this->reset(['related_link', 'updateMode', 'image']);
        $this->showModalForm = true;
    }

    public function store()
    {
        $rules = [
            "related_link.label" => [
                "required"
            ],
            "related_link.url" => [
                "required", "url"
            ],
            "image" => [
                "required", "image", "max:500"
            ]
        ];
        $this->validate($rules);


        $this->updateMode = false;

        $save = $this->handleFormRequest(new RelatedLink);

        if ($save) {
            $this->reset("related_link");
            $this->showAlert = true;
            $this->alertMessage = trans('messages.related_link_added');
            $this->showModalForm = false;
            $this->emit('refreshDt');
        } else {
            abort('403',  trans('messages.related_link_not_added'));
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $this->reset("image");
        $related_link = RelatedLink::where('related_link_id', $id)->first();
        $this->related_link = $related_link->toArray();
        $this->showModalForm = true;
    }

    public function update()
    {
        $rules = [
            "related_link.label" => [
                "required"
            ],
            "related_link.url" => [
                "required", "url"
            ],
            "image" => [
                "nullable", "image", "max:500"
            ]
        ];
        $this->validate($rules);

        $save = false;

        if ($this->related_link["related_link_id"]) {
            $db = RelatedLink::find($this->related_link["related_link_id"]);
            $save = $this->handleFormRequest($db);
        } else {
            abort('403', 'Related Link Not Found');
        }

        if ($save) {
            $this->reset("related_link");
            $this->showAlert = true;
            $this->alertMessage =  trans('messages.related_link_updated');
            $this->showModalForm = false;
            $this->emit('refreshDt');
        }
    }

    public function destroy($id)
    {
        $delete = RelatedLink::destroy($id);
        if ($delete) {
            $this->showAlert = true;
            $this->alertMessage =  trans('messages.related_link_destroy');
        } else {
            $this->showAlert = true;
            $this->alertMessage =  trans('messages.related_link_not_destroy');
        }

        $this->emit("refreshDt", false);
        $this->reset(['related_link', 'updateMode', 'showModalConfirm']);
    }

    private function handleFormRequest(RelatedLink $db): bool
    {
        $db->label = $this->related_link['label'];
        $db->url = $this->related_link['url'];

        if ($this->image){
            $filename = Str::random() . "." . $this->image->getClientOriginalExtension();
            $this->image->storeAs('/images/related-link/', $filename, 'public');
            $db->icon = $filename;
        }

        return $db->save();
    }

    public function back()
    {
        redirect($this->previous);
    }


}
