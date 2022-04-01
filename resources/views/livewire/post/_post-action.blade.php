<div class="flex items-center">
    <a href="{{route('post.form', $row->post_id)}}">
        <x-kit::button class="bg-primary-500 text-white hover:bg-primary-400"
                        variant="circle"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
            <span class="flex items-center fi-rr-pencil"></span>
        </x-kit::button>
    </a>
    <x-kit::button variant="circle" class="bg-danger-500 text-white hover:bg-danger-400"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                    wire:click="$emit('confirmDestroy', {{$row->post_id}})">
        <span class="flex items-center fi-rr-trash"></span>
    </x-kit::button>
</div>
