<?php

namespace App\Http\Livewire\Gallery;

use App\Models\Gallery;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

trait GalleryState
{
    use WithFileUploads;

    public $previous;

    public $updateMode = false;

    public $image;

    public array $gallery = [
        "gallery_id" => "",
        "title" => "",
        "desc" => "",
        "slug" => "",
        "filename" => "",
    ];

    public $showAlert = false;

    public $alertMessage = '';

    public $showToast = false;

    public $toastMessage = 'Table refreshed';

    public $showModalForm = false;

    public $showModalConfirm = false;

    public array $breadcrumbs = [
        ["link" => "#", "title" => "Admin", "active" => false],
        ["link" => "#", "title" => "Gallery", "active" => true],
    ];

    public $options = [];

    public function create()
    {
        $this->reset(['gallery', 'updateMode']);
        $this->showModalForm = true;
    }

    public function store()
    {
        $rules = [
            "gallery.title" => [
                "required"
            ],
            "gallery.desc" => [
                "required"
            ],
        ];
        $this->validate($rules);

        $this->updateMode = false;

        $save = $this->handleFormRequest(new Gallery);

        if ($save) {
            $this->reset(["gallery", "image"]);
            $this->showModalForm = false;
            $this->showAlert = true;
            $this->alertMessage = trans('messages.gallery_added');
            $this->emit('refreshDt');
        } else {
            abort('403', trans('messages.gallery_not_added'));
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $gallery = Gallery::where('gallery_id', $id)->first();
        $this->gallery = $gallery->toArray();
        $this->showModalForm = true;
    }

    public function update()
    {
        $rules = [
            "gallery.title" => [
                "required"
            ],
            "gallery.desc" => [
                "required"
            ],
        ];
        $this->validate($rules);

        $save = false;

        if ($this->gallery["gallery_id"]) {
            $db = Gallery::find($this->gallery["gallery_id"]);
            $save = $this->handleFormRequest($db);
        } else {
            abort('403', 'Gallery Not Found');
        }

        if ($save) {
            $this->reset(["gallery", "image"]);
            $this->showModalForm = false;
            $this->showAlert = true;
            $this->alertMessage = trans('messages.updated');
            $this->emit('refreshDt');
        }
    }

    public function destroy($id)
    {
        $delete = Gallery::destroy($id);
        if ($delete) {
            $this->showAlert = true;
            $this->alertMessage = trans('messages.gallery_destroy');
        } else {
            $this->showAlert = true;
            $this->alertMessage = trans('messages.gallery_not_destroy');
        }

        $this->emit("refreshDt", false);
        $this->reset(['gallery', 'updateMode', 'showModalConfirm']);
    }

    private function handleFormRequest(Gallery $db): bool
    {
        $db->title = $this->gallery['title'];
        $db->desc = $this->gallery['desc'];
        $db->slug = Str::snake($this->gallery['title'], "-");

        if ($this->image) {
            $filename = Str::random() . "." . $this->image->getClientOriginalExtension();
            $db->filename = $filename;
            $this->image->storeAs('/images/gallery/', $filename, 'public');
        }

        return $db->save();
    }

    public function back()
    {
        redirect($this->previous);
    }


}
