<?php

namespace App\Http\Livewire\Halaman;

use App\Models\Halaman;
use Illuminate\Support\Str;

trait HalamanState
{
    public $previous;

    public $updateMode = false;

    public array $halaman = [
        "halaman_id" => "",
        "judul" => "",
        "custom" => false,
        "gambar" => "",
        "url" => "",
        "aktif" => "",
        "isi" => "",
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
        ["link" => "#", "title" => "Halaman", "active" => true],
    ];

    public function save()
    {
        $this->updateMode ? $this->update() : $this->store();
    }

    public function store()
    {
        $rules = [
            "halaman.judul" => [
                "required"
            ],
            "halaman.custom" => [
                "required"
            ],
            "halaman.aktif" => [
                "required"
            ],
            "halaman.isi" => [
                "required"
            ],
        ];
        $this->validate($rules);


        $this->updateMode = false;

        $save = $this->handleFormRequest(new Halaman);

        if ($save) {
            $this->reset("halaman");
            $this->back();
        } else {
            abort('403', 'Halaman gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $halaman = Halaman::where('halaman_id', $id)->first();
        $this->halaman = $halaman->toArray();
    }

    public function update()
    {
        $rules = [
            "halaman.judul" => [
                "required"
            ],
            "halaman.custom" => [
                "required"
            ],
            "halaman.aktif" => [
                "required"
            ],
            "halaman.isi" => [
                "required"
            ],
        ];
        $this->validate($rules);

        $save = false;

        if ($this->halaman["halaman_id"]) {
            $db = Halaman::find($this->halaman["halaman_id"]);
            $save = $this->handleFormRequest($db);
        } else {
            abort('403', 'Halaman Not Found');
        }

        if ($save) {
            $this->back();
        }
    }

    public function destroy($id)
    {
        $delete = Halaman::destroy($id);
        if ($delete) {
            $this->showToast = true;
            $this->toastMessage = "Halaman berhasil dihapus";
        } else {
            $this->showToast = true;
            $this->toastMessage = "Halaman gagal dihapus";
        }

        $this->emit("refreshDt", false);
        $this->reset(['halaman', 'updateMode', 'showModalConfirm']);
    }

    private function handleFormRequest(Halaman $db): bool
    {
        $db->judul = $this->halaman['judul'];

        if ($this->image){
            $filename = Str::random() . "." . $this->image->getClientOriginalExtension();
            $this->image->storeAs('/images/halaman/', $filename, 'public');
            $db->gambar = $filename;
        }

        $db->custom = $this->halaman['custom'];
        if ($this->halaman['custom']){
            $db->url = $this->halaman['url'];
        }else{
            $db->url = Str::snake($this->halaman['judul'], "-");
        }
        $db->aktif = $this->halaman['aktif'];
        $db->isi = $this->halaman['isi'];

        return $db->save();
    }

    public function back()
    {
        redirect($this->previous);
    }


}
