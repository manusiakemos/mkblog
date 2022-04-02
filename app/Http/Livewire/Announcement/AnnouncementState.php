<?php

namespace App\Http\Livewire\Announcement;

use App\Models\Announcement;

trait AnnouncementState
{
    public $previous;

    public $updateMode = false;

    public array $announcement = [
        "announcement_id" => "",
        "title" => "",
        "date" => "",
        "repeat" => false,
        "active" => true,
        "content" => "",
    ];

    public $showAlert = false;

    public $alertMessage = '';

    public $showToast = false;

    public $toastMessage = 'Table refreshed';

    public $showModalForm = false;

    public $showModalConfirm = false;

    public array $breadcrumbs;

    public $options = [];

    public function create()
    {
        $this->reset(['announcement', 'updateMode']);
        $this->showModalForm = true;
    }

    public function store()
    {
        $rules = [
            "announcement.title" => [
                "required"
            ],
            "announcement.date" => [
                "required"
            ],
            "announcement.repeat" => [
                "required"
            ],
            "announcement.active" => [
                "required"
            ],
            "announcement.content" => [
                "required"
            ],
        ];
        $this->validate($rules);

        $this->updateMode = false;

        $save = $this->handleFormRequest(new Announcement);

        if ($save) {
            $this->reset(["announcement", "showModalForm"]);
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
        $announcement = Announcement::where('announcement_id', $id)->first();
        $this->announcement = $announcement->toArray();
        $this->showModalForm = true;
    }

    public function update()
    {
        $rules = [
            "announcement.title" => [
                "required"
            ],
            "announcement.date" => [
                "required"
            ],
            "announcement.repeat" => [
                "required"
            ],
            "announcement.active" => [
                "required"
            ],
            "announcement.content" => [
                "required"
            ],
        ];
        $this->validate($rules);


        $save = false;

        if ($this->announcement["announcement_id"]) {
            $db = Announcement::find($this->announcement["announcement_id"]);
            $save = $this->handleFormRequest($db);
        } else {
            abort('403', 'Pengumuman Not Found');
        }

        if ($save) {
            $this->reset("announcement");
            $this->showAlert = true;
            $this->alertMessage = "Pengumuman berhasil diupdate";
            $this->reset(["announcement", "showModalForm"]);
            $this->emit('refreshDt');
        }
    }

    public function destroy($id)
    {
        $delete = Announcement::destroy($id);
        if ($delete) {
            $this->showAlert = true;
            $this->alertMessage = "Pengumuman berhasil dihapus";
        } else {
            $this->showAlert = true;
            $this->alertMessage = "Pengumuman gagal dihapus";
        }

        $this->emit("refreshDt", false);
        $this->reset(['announcement', 'updateMode', 'showModalConfirm']);
    }

    private function handleFormRequest($db): bool
    {
        try {
            $db->title = $this->announcement['title'];
            $db->date = $this->announcement['date'];
            $db->repeat = $this->announcement['repeat'];
            $db->active = $this->announcement['active'];
            $db->content = $this->announcement['content'];

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
