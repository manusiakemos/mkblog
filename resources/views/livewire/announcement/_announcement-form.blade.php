<div>
    <x-kit::modal id="modal_form" wire:model="showModalForm" size="md">
        <form action="#" wire:submit.prevent="save" class="p-3">
            <x-kit::form-group text-label="title" input-id="title" error-name="announcement.title">
                <x-kit::input id="title" wire:model.defer="announcement.title"/>
            </x-kit::form-group>

            <x-kit::form-group text-label="date" input-id="date" error-name="announcement.date">
                <div class="md:w-1/3">
                    <x-kit::input type="date" id="date" wire:model.defer="announcement.date"/>
                </div>
            </x-kit::form-group>

            <x-kit::form-group text-label="repeat yearly" input-id="repeat" error-name="announcement.repeat">
                <x-kit::toggle wire:model="announcement.repeat"/>
            </x-kit::form-group>

            <x-kit::form-group text-label="active" input-id="active" error-name="announcement.active">
                <x-kit::toggle wire:model="announcement.active"/>
            </x-kit::form-group>

            @if($showModalForm)
                <x-kit::form-group text-label="content" input-id="content" error-name="announcement.content">
                    <x-kit::editor wire:model="announcement.content" id="content"/>
                </x-kit::form-group>
            @endif


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

