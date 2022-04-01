<div xmlns:x-kit="http://www.w3.org/1999/html">
    <x-kit::modal id="modal_form" wire:model="showModalForm" size="md">
        <form action="#" wire:submit.prevent="save" class="p-3">
            <x-kit::form-group text-label="title" input-id="title" error-name="gallery.title">
                <x-kit::input id="title" wire:model.defer="gallery.title"/>
            </x-kit::form-group>

            <x-kit::form-group text-label="desc" input-id="desc" error-name="gallery.desc">
                <x-kit::textarea id="desc" wire:model.defer="gallery.desc"/>
            </x-kit::form-group>

            <x-kit::form-group text-label="image" input-id="image" error-name="image">
                <x-kit::file-upload id="image" wire:model="image"/>
            </x-kit::form-group>


            <div class="md:flex place-content-end py-4">
                <x-kit::button
                    variant="rounded"
                    x-on:click="$wire.showModalForm = false"
                    class="bg-danger-500 hover:bg-danger-400 text-white">
                    {{ __('messages.close') }}
                </x-kit::button>
                <x-kit::button variant="rounded"
                               type="submit"
                               class="bg-primary-500 hover:bg-primary-400 text-white">
                    {{$updateMode ? __('messages.save_changes') : __('messages.save')}}
                </x-kit::button>
            </div>
        </form>
    </x-kit::modal>
</div>

