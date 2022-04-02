<?php

namespace App\Http\Livewire\Youtube;

use App\Models\Youtube;

trait YoutubeState
{
    public $previous;

    public $updateMode = false;

    public array $youtube = [
        "youtube_id" => "",
        "title" => "",
        "embed" => "",
        "desc" => "",
    ];

    public $showAlert = false;

    public $alertMessage = '';

    public $showToast = false;

    public $toastMessage = 'Table refreshed';

    public $showModalForm = false;

    public $showModalConfirm = false;

    public array $breadcrumbs = [
        ["link" => "#", "title" => "Admin", "active" => false],
        ["link" => "#", "title" => "Youtube", "active" => true],
    ];

    public $options = [];

    public function create()
    {
        $this->reset(['youtube', 'updateMode']);
        $this->showModalForm = true;
    }

    public function store()
    {
        $rules = [
            "youtube.title" => [
                "required"
            ],
            "youtube.embed" => [
                "required"
            ],
            "youtube.desc" => [
                "required"
            ],
        ];
        $this->validate($rules);


        $this->updateMode = false;

        $save = $this->handleFormRequest(new Youtube);

        if ($save) {
            $this->reset(["youtube", "showModalForm"]);
            $this->showAlert = true;
            $this->alertMessage = trans('messages.youtube_added');
            $this->emit('refreshDt');
        } else {
            abort('403', 'Youtube gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $youtube = Youtube::where('youtube_id', $id)->first();
        $this->youtube = $youtube->toArray();
        $this->showModalForm = true;
    }

    public function update()
    {
        $rules = [
            "youtube.title" => [
                "required"
            ],
            "youtube.embed" => [
                "required"
            ],
            "youtube.desc" => [
                "required"
            ],
        ];
        $this->validate($rules);


        $save = false;

        if ($this->youtube["youtube_id"]) {
            $db = Youtube::find($this->youtube["youtube_id"]);
            $save = $this->handleFormRequest($db);
        } else {
            abort('403', 'Youtube Not Found');
        }

        if ($save) {
            $this->showAlert = true;
            $this->alertMessage = trans('messages.youtube_updated');
            $this->reset(["youtube", "showModalForm"]);
            $this->emit('refreshDt');
        }
    }

    public function destroy($id)
    {
        $delete = Youtube::destroy($id);
        if ($delete) {
            $this->showAlert = true;
            $this->alertMessage = trans('messages.youtube_destroy');
        } else {
            $this->showAlert = true;
            $this->alertMessage = trans('messages.youtube_destroy');
        }

        $this->emit("refreshDt", false);
        $this->reset(['youtube', 'updateMode', 'showModalConfirm']);
    }

    private function handleFormRequest($db): bool
    {
        try {
            $db->title = $this->youtube['title'];
            $db->embed = $this->youtube['embed'];
            $db->desc = $this->youtube['desc'];

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
