<div xmlns:x-kit="http://www.w3.org/1999/html">
    <x-kit::modal id="modal_form" wire:model="showModalForm" size="md">
        <form action="#" wire:submit.prevent="save" class="p-3">
            <x-kit::form-group text-label="judul" input-id="judul" error-name="gallery.judul">
                <x-kit::input id="judul" wire:model.defer="gallery.judul"/>
            </x-kit::form-group>

            <x-kit::form-group text-label="keterangan" input-id="keterangan" error-name="gallery.keterangan">
                <x-kit::textarea id="keterangan" wire:model.defer="gallery.keterangan"/>
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

