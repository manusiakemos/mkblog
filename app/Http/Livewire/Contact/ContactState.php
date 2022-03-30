<?php

namespace App\Http\Livewire\Contact;

use App\Models\Contact;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ContactState
{
    public $previous;

    public $updateMode = false;

    public $image;

    public array $contact = [
        "contact_id" => "",
        "label" => "",
        "icon" => "",
        "content" => "",
    ];

    public $showAlert = false;

    public $alertMessage = '';

    public $showToast = false;

    public $toastMessage = 'Table refreshed';

    public $showModalForm = false;

    public $showModalConfirm = false;

    public array $breadcrumbs = [
        ["link" => "#", "title" => "Admin", "active" => false],
        ["link" => "#", "title" => "Contact", "active" => true],
    ];

    public $options = [];

    public function create()
    {
        $this->reset(['contact', 'updateMode']);
        $this->showModalForm = true;
    }

    public function store()
    {
        $rules = [
            "contact.label" => [
                "required"
            ],
            "contact.content" => [
                "required"
            ],
            "image" => [
                "required", "image", "max:500"
            ]
        ];
        $this->validate($rules);


        $this->updateMode = false;

        $save = $this->handleFormRequest(new Contact);

        if ($save) {
            $this->reset("contact");
            $this->showAlert = true;
            $this->alertMessage = trans('messages.contact_added');
            $this->showModalForm = false;
            $this->image = null;
            $this->emit('refreshDt');
        } else {
            abort('403', trans('messages.contact_not_added'));
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $contact = Contact::where('contact_id', $id)->first();
        $this->contact = $contact->toArray();
        $this->showModalForm = true;
    }

    public function update()
    {
        $rules = [
            "contact.label" => [
                "required"
            ],
            "contact.content" => [
                "required"
            ],
            "image" => [
                "nullable", "image", "max:500"
            ]
        ];
        $this->validate($rules);

        $save = false;

        if ($this->contact["contact_id"]) {
            $db = Contact::find($this->contact["contact_id"]);
            $save = $this->handleFormRequest($db);
        } else {
            abort('403', 'Contact Not Found');
        }

        if ($save) {
            $this->reset("contact");
            $this->showAlert = true;
            $this->alertMessage = trans('messages.contact_updated');
            $this->showModalForm = false;
            $this->image = null;
            $this->emit('refreshDt');
        }else {
            abort('403', trans('messages.contact_not_updated'));
        }
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        $delete = $contact->delete();
        if ($delete) {
            Storage::disk('public')->delete('/images/contact/'.$contact->icon);
            $this->showAlert = true;
            $this->alertMessage = trans('messages.contact_destroy');
        } else {
            $this->showAlert = true;
            $this->alertMessage = trans('messages.contact_not_destroy');
        }

        $this->emit("refreshDt", false);
        $this->reset(['contact', 'updateMode', 'showModalConfirm']);
    }

    private function handleFormRequest(Contact $db): bool
    {
        $db->label = $this->contact['label'];
        $db->content = $this->contact['content'];
        if ($this->image) {
            $filename = Str::random() . "." . $this->image->getClientOriginalExtension();
            $this->image->storeAs('/images/contact/', $filename, 'public');
            $db->icon = $filename;
        }
        return $db->save();
    }

    public function back()
    {
        redirect($this->previous);
    }


}
