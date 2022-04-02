<div xmlns:x-kit="http://www.w3.org/1999/html">
    <x-kit::modal id="modal_form" wire:model="showModalForm" size="md">
        <form action="#" wire:submit.prevent="save" class="p-3">
            <x-kit::form-group text-label="title" input-id="title" error-name="youtube.title">
                <x-kit::input id="title" wire:model.defer="youtube.title"/>
            </x-kit::form-group>

            <x-kit::form-group text-label="embed" input-id="embed" error-name="youtube.embed">
                <x-kit::textarea id="embed" wire:model.defer="youtube.embed"/>
            </x-kit::form-group>

            <x-kit::form-group text-label="desc" input-id="desc" error-name="youtube.desc">
                <x-kit::textarea id="desc" wire:model.defer="youtube.desc"/>
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

