<?php

namespace App\Http\Livewire\Berita;

use App\Models\Berita;
use Illuminate\Support\Str;

trait BeritaState
{
    public $previous;

    public $updateMode = false;

    public array $berita = [
        "berita_id" => "",
        "user_id" => "",
        "kategori_id" => "",
        "judul" => "",
        "url" => "",
        "gambar" => "",
        "isi" => "",
        "hit" => "",
        "aktif" => false,
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
        ["link" => "#", "title" => "Berita", "active" => true],
    ];

    public function save()
    {
        $this->updateMode ? $this->update() : $this->store();
    }

    public function store()
    {
        $rules = [
            "berita.kategori_id" => [
                "required"
            ],
            "berita.judul" => [
                "required"
            ],
            "image" => [
                "required", "image", "max:2000"
            ],
            "berita.isi" => [
                "required"
            ],
            "berita.aktif" => [
                "required"
            ],
        ];
        $this->validate($rules);


        $this->updateMode = false;

        $save = $this->handleFormRequest(new Berita);

        if ($save) {
           $this->back();
        } else {
            abort('403', 'Berita gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $berita = Berita::where('berita_id', $id)->first();
        $this->berita = $berita->toArray();
    }

    public function update()
    {
        $rules = [
            "berita.kategori_id" => [
                "required"
            ],
            "berita.judul" => [
                "required"
            ],
            "image" => [
                "nullable", "image", "max:2000"
            ],
            "berita.isi" => [
                "required"
            ],
            "berita.aktif" => [
                "required"
            ],
        ];
        $this->validate($rules);

        $save = false;

        if ($this->berita["berita_id"]) {
            $db = Berita::find($this->berita["berita_id"]);
            $save = $this->handleFormRequest($db);
        } else {
            abort('403', 'Berita Not Found');
        }

        if ($save) {
            $this->back();
        }
    }

    public function destroy($id)
    {
        $delete = Berita::destroy($id);
        if ($delete) {
            $this->showAlert = true;
            $this->alertMessage = "Berita berhasil dihapus";
        } else {
            $this->showAlert = true;
            $this->alertMessage = "Berita gagal dihapus";
        }

        $this->emit("refreshDt", false);
        $this->reset(['berita', 'updateMode', 'showModalConfirm']);
    }

    private function handleFormRequest(Berita $db): bool
    {
        if ($this->updateMode) {
            $db->user_id = $this->berita['user_id'];
        } else {
            $db->user_id = auth()->id();
        }
        $db->kategori_id = $this->berita['kategori_id'];
        $db->judul = $this->berita['judul'];
        $db->url = Str::snake($this->berita['judul'], "-");
        $db->isi = $this->berita['isi'];
        $db->hit = 0;
        $db->aktif = $this->berita['aktif'];

        if ($this->image) {
            $filename = Str::random() . "." . $this->image->getClientOriginalExtension();
            $db->gambar = $filename;
            $this->image->storeAs('/images/berita/', $filename, 'public');
        }

        return $db->save();
    }

    public function back()
    {
        redirect($this->previous);
    }


}
