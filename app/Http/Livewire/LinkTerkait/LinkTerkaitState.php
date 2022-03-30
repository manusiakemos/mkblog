<?php

namespace App\Http\Livewire\LinkTerkait;

use App\Models\LinkTerkait;
use Illuminate\Support\Str;

trait LinkTerkaitState
{
    public $previous;

    public $updateMode = false;

    public $image;

    public array $link_terkait = [
        "link_terkait_id" => "",
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
        $this->reset(['link_terkait', 'updateMode', 'image']);
        $this->showModalForm = true;
    }

    public function store()
    {
        $rules = [
            "link_terkait.label" => [
                "required"
            ],
            "link_terkait.url" => [
                "required", "url"
            ],
            "image" => [
                "required", "image", "max:500"
            ]
        ];
        $this->validate($rules);


        $this->updateMode = false;

        $save = $this->handleFormRequest(new LinkTerkait);

        if ($save) {
            $this->reset("link_terkait");
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
        $link_terkait = LinkTerkait::where('link_terkait_id', $id)->first();
        $this->link_terkait = $link_terkait->toArray();
        $this->showModalForm = true;
    }

    public function update()
    {
        $rules = [
            "link_terkait.label" => [
                "required"
            ],
            "link_terkait.url" => [
                "required", "url"
            ],
            "image" => [
                "nullable", "image", "max:500"
            ]
        ];
        $this->validate($rules);

        $save = false;

        if ($this->link_terkait["link_terkait_id"]) {
            $db = LinkTerkait::find($this->link_terkait["link_terkait_id"]);
            $save = $this->handleFormRequest($db);
        } else {
            abort('403', 'LinkTerkait Not Found');
        }

        if ($save) {
            $this->reset("link_terkait");
            $this->showAlert = true;
            $this->alertMessage = "Link Terkait berhasil diupdate";
            $this->showModalForm = false;
            $this->emit('refreshDt');
        }
    }

    public function destroy($id)
    {
        $delete = LinkTerkait::destroy($id);
        if ($delete) {
            $this->showAlert = true;
            $this->alertMessage = "Link Terkait berhasil dihapus";
        } else {
            $this->showAlert = true;
            $this->alertMessage = "Link Terkait gagal dihapus";
        }

        $this->emit("refreshDt", false);
        $this->reset(['link_terkait', 'updateMode', 'showModalConfirm']);
    }

    private function handleFormRequest(LinkTerkait $db): bool
    {
        $db->label = $this->link_terkait['label'];
        $db->url = $this->link_terkait['url'];

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
