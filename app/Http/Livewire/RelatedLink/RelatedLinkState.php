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
            $this->alertMessage = "Link Terkait berhasil ditambahkan";
            $this->showModalForm = false;
            $this->emit('refreshDt');
        } else {
            abort('403', 'Link Terkait gagal ditambahkan');
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
            abort('403', 'LinkTerkait Not Found');
        }

        if ($save) {
            $this->reset("related_link");
            $this->showAlert = true;
            $this->alertMessage = "Link Terkait berhasil diupdate";
            $this->showModalForm = false;
            $this->emit('refreshDt');
        }
    }

    public function destroy($id)
    {
        $delete = RelatedLink::destroy($id);
        if ($delete) {
            $this->showAlert = true;
            $this->alertMessage = "Link Terkait berhasil dihapus";
        } else {
            $this->showAlert = true;
            $this->alertMessage = "Link Terkait gagal dihapus";
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
            $this->image->storeAs('/images/link-terkait/', $filename, 'public');
            $db->icon = $filename;
        }

        return $db->save();
    }

    public function back()
    {
        redirect($this->previous);
    }


}
