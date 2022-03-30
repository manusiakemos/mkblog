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
        "judul" => "",
        "keterangan" => "",
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
            "gallery.judul" => [
                "required"
            ],
            "gallery.keterangan" => [
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
            $this->alertMessage = "Gallery berhasil ditambahkan";
            $this->emit('refreshDt');
        } else {
            abort('403', 'Gallery gagal ditambahkan');
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
            "gallery.judul" => [
                "required"
            ],
            "gallery.keterangan" => [
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
            $this->alertMessage = "Gallery berhasil diupdate";
            $this->emit('refreshDt');
        }
    }

    public function destroy($id)
    {
        $delete = Gallery::destroy($id);
        if ($delete) {
            $this->showAlert = true;
            $this->alertMessage = "Gallery berhasil dihapus";
        } else {
            $this->showAlert = true;
            $this->alertMessage = "Gallery gagal dihapus";
        }

        $this->emit("refreshDt", false);
        $this->reset(['gallery', 'updateMode', 'showModalConfirm']);
    }

    private function handleFormRequest(Gallery $db): bool
    {
        $db->judul = $this->gallery['judul'];
        $db->keterangan = $this->gallery['keterangan'];
        $db->slug = Str::snake($this->gallery['judul'], "-");

        if ($this->image){
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
