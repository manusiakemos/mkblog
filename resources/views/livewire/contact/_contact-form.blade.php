<div xmlns:x-kit="http://www.w3.org/1999/html">
    <x-kit::modal id="modal_form" wire:model="showModalForm" size="md">
        <form action="#" wire:submit.prevent="save" class="p-3">

            <x-kit::form-group text-label="label" input-id="label" error-name="contact.label">
                <x-kit::input id="label" wire:model.defer="contact.label"/>
            </x-kit::form-group>

            <x-kit::form-group text-label="icon" input-id="image" error-name="image">
                <x-kit::file-upload id="image" wire:model="image"></x-kit::file-upload>
            </x-kit::form-group>

            <x-kit::form-group text-label="content" input-id="content" error-name="contact.content">
                <x-kit::textarea id="content" wire:model.defer="contact.content"/>
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

