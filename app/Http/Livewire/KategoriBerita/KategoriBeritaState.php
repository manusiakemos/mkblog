<?php

namespace App\Http\Livewire\KategoriBerita;

use App\Models\KategoriBerita;

trait KategoriBeritaState
{
    public $previous;

    public $updateMode = false;

    public array $kategori_berita = [
        "kategori_id" => "",
        "nama" => "",
        "aktif" => true,
        "created_at" => "",
        "updated_at" => "",
    ];

    public $showAlert = false;

    public $alertMessage = '';

    public $showToast = false;

    public $toastMessage = 'Table refreshed';

    public $showModalForm = false;

    public $showModalConfirm = false;

    public array $breadcrumbs = [
        ["link" => "#", "title" => "Admin", "active" => false],
        ["link" => "#", "title" => "Kategori Berita", "active" => true],
    ];

    public $options = [];

    public function create()
    {
        $this->reset(['kategori_berita', 'updateMode']);
        $this->showModalForm = true;
    }

    public function store()
    {
        $rules = [
            "kategori_berita.nama" => [
                "required"
            ],
            "kategori_berita.aktif" => [
                "required"
            ],
        ];
        $this->validate($rules);

        $this->updateMode = false;

        $save = $this->handleFormRequest(new KategoriBerita);

        if ($save) {
            $this->showAlert = true;
            $this->alertMessage = "Kategori Berita berhasil diupdate";
            $this->emit('refreshDt');
            $this->reset("kategori_berita");
            $this->showModalForm = false;
        } else {
            abort('403', 'Kategori Berita gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $kategori_berita = KategoriBerita::where('kategori_id', $id)->first();
        $this->kategori_berita = $kategori_berita->toArray();
        $this->showModalForm = true;
    }

    public function update()
    {
        $rules = [
            "kategori_berita.nama" => [
                "required"
            ],
            "kategori_berita.aktif" => [
                "required"
            ]
        ];
        $this->validate($rules);


        $save = false;

        if ($this->kategori_berita["kategori_id"]) {
            $db = KategoriBerita::find($this->kategori_berita["kategori_id"]);
            $save = $this->handleFormRequest($db);
        } else {
            abort('403', 'Kategori Berita Not Found');
        }

        if ($save) {
            $this->reset("kategori_berita");
            $this->showModalForm = false;
            $this->showAlert = true;
            $this->alertMessage = "Kategori Berita berhasil diupdate";
            $this->emit('refreshDt');
        }
    }

    public function destroy($id)
    {
        $delete = KategoriBerita::destroy($id);
        if ($delete) {
            $this->showAlert = true;
            $this->alertMessage = "Kategori Berita berhasil dihapus";
        } else {
            $this->showAlert = true;
            $this->alertMessage = "Kategori Berita gagal dihapus";
        }

        $this->emit("refreshDt");
        $this->reset(['kategori_berita', 'updateMode', 'showModalConfirm']);
    }

    private function handleFormRequest($db): bool
    {
        $db->nama = $this->kategori_berita['nama'];
        $db->aktif = $this->kategori_berita['aktif'];
        return $db->save();
    }

    public function back()
    {
        redirect($this->previous);
    }


}
