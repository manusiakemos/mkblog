<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Illuminate\Support\Str;

trait PostState
{
    public $previous;

    public $updateMode = false;

    public array $post = [
        "post_id" => "",
        "user_id" => "",
        "category_id" => "",
        "title" => "",
        "url" => "",
        "image" => "",
        "content" => "",
        "hit" => "",
        "active" => false,
    ];

    public $showAlert = false;

    public $alertMessage = '';

    public $showToast = false;

    public $toastMessage = 'Table refreshed';

    public $showModalForm = false;

    public $showModalConfirm = false;

    public $options = [];

    public array $breadcrumbs;

    public function save()
    {
        $this->updateMode ? $this->update() : $this->store();
    }

    public function store()
    {
        $rules = [
            "post.category_id" => [
                "required"
            ],
            "post.title" => [
                "required"
            ],
            "image" => [
                "required", "image", "max:2000"
            ],
            "post.content" => [
                "required"
            ],
            "post.active" => [
                "required"
            ],
        ];
        $this->validate($rules);

        $this->updateMode = false;

        $save = $this->handleFormRequest(new Post);

        if ($save) {
            $this->back();
        } else {
            abort('403', trans('messages.post_not_added'));
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $post = Post::where('post_id', $id)->first();
        $this->post = $post->toArray();
    }

    public function update()
    {
        $rules = [
            "post.category_id" => [
                "required"
            ],
            "post.title" => [
                "required"
            ],
            "image" => [
                "nullable", "image", "max:2000"
            ],
            "post.content" => [
                "required"
            ],
            "post.active" => [
                "required"
            ],
        ];
        $this->validate($rules);

        $save = false;

        if ($this->post["post_id"]) {
            $db = Post::find($this->post["post_id"]);
            $save = $this->handleFormRequest($db);
        } else {
            abort('403', 'Post Not Found');
        }

        if ($save) {
            $this->back();
        }
    }

    public function destroy($id)
    {
        $delete = Post::destroy($id);
        if ($delete) {
            $this->showAlert = true;
            $this->alertMessage =  trans('messages.post_destroy');
        } else {
            $this->showAlert = true;
            $this->alertMessage =  trans('messages.post_not_destroy');
        }

        $this->emit("refreshDt", false);
        $this->reset(['post', 'updateMode', 'showModalConfirm']);
    }

    private function handleFormRequest(Post $db): bool
    {
        if ($this->updateMode) {
            $db->user_id = $this->post['user_id'];
        } else {
            $db->user_id = auth()->id();
        }
        $db->category_id = $this->post['category_id'];
        $db->title = $this->post['title'];
        $db->url = Str::snake($this->post['title'], "-");
        $db->content = $this->post['content'];
        $db->hit = 0;
        $db->active = $this->post['active'];

        if ($this->image) {
            $filename = Str::random() . "." . $this->image->getClientOriginalExtension();
            $db->image = $filename;
            $this->image->storeAs('/images/post/', $filename, 'public');
        }

        return $db->save();
    }

    public function back()
    {
        redirect($this->previous);
    }


}
