<?php

namespace App\Http\Livewire\Pengumuman;

use App\Models\Pengumuman;

trait PengumumanState
{
    public $previous;

    public $updateMode = false;

    public array $pengumuman = [
        "pengumuman_id" => "",
        "judul" => "",
        "tanggal" => "",
        "rutin" => "",
        "aktif" => "",
        "isi" => "",
    ];

    public $showAlert = false;

    public $alertMessage = '';

    public $showToast = false;

    public $toastMessage = 'Table refreshed';

    public $showModalForm = false;

    public $showModalConfirm = false;

    public array $breadcrumbs = [
        ["link" => "#", "title" => "Admin", "active" => false],
        ["link" => "#", "title" => "Pengumuman", "active" => true],
    ];

    public $options = [];

    public function create()
    {
        $this->reset(['pengumuman', 'updateMode']);
        $this->showModalForm = true;
    }

    public function store()
    {
        $rules = [
            "pengumuman.judul" => [
                "required"
            ],
            "pengumuman.tanggal" => [
                "required"
            ],
            "pengumuman.rutin" => [
                "required"
            ],
            "pengumuman.aktif" => [
                "required"
            ],
            "pengumuman.isi" => [
                "required"
            ],
        ];
        $this->validate($rules);

        $this->updateMode = false;

        $save = $this->handleFormRequest(new Pengumuman);

        if ($save) {
            $this->reset(["pengumuman", "showModalForm"]);
            $this->showAlert = true;
            $this->alertMessage = "Pengumuman berhasil ditambahkan";
            $this->emit('refreshDt');
        } else {
            abort('403', 'Pengumuman gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $pengumuman = Pengumuman::where('pengumuman_id', $id)->first();
        $this->pengumuman = $pengumuman->toArray();
        $this->showModalForm = true;
    }

    public function update()
    {
        $rules = [
            "pengumuman.judul" => [
                "required"
            ],
            "pengumuman.tanggal" => [
                "required"
            ],
            "pengumuman.rutin" => [
                "required"
            ],
            "pengumuman.aktif" => [
                "required"
            ],
            "pengumuman.isi" => [
                "required"
            ],
        ];
        $this->validate($rules);


        $save = false;

        if ($this->pengumuman["pengumuman_id"]) {
            $db = Pengumuman::find($this->pengumuman["pengumuman_id"]);
            $save = $this->handleFormRequest($db);
        } else {
            abort('403', 'Pengumuman Not Found');
        }

        if ($save) {
            $this->reset("pengumuman");
            $this->showAlert = true;
            $this->alertMessage = "Pengumuman berhasil diupdate";
            $this->reset(["pengumuman", "showModalForm"]);
            $this->emit('refreshDt');
        }
    }

    public function destroy($id)
    {
        $delete = Pengumuman::destroy($id);
        if ($delete) {
            $this->showAlert = true;
            $this->alertMessage = "Pengumuman berhasil dihapus";
        } else {
            $this->showAlert = true;
            $this->alertMessage = "Pengumuman gagal dihapus";
        }

        $this->emit("refreshDt", false);
        $this->reset(['pengumuman', 'updateMode', 'showModalConfirm']);
    }

    private function handleFormRequest($db): bool
    {
        try {
            $db->judul = $this->pengumuman['judul'];
            $db->tanggal = $this->pengumuman['tanggal'];
            $db->rutin = $this->pengumuman['rutin'];
            $db->aktif = $this->pengumuman['aktif'];
            $db->isi = $this->pengumuman['isi'];

            return $db->save();
        } catch (\Exception $e) {
            return $e->getTraceAsString();
        }
    }

    public function back()
    {
        redirect($this->previous);
    }


}
