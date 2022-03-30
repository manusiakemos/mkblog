<div>
    <x-kit::modal id="modal_form" wire:model="showModalForm" size="md">
        <form action="#" wire:submit.prevent="save" class="p-3">

            <x-kit::form-group text-label="nama" input-id="nama" error-name="kategori_berita.nama">
                <x-kit::input id="nama" wire:model.defer="kategori_berita.nama"/>
            </x-kit::form-group>

            <x-kit::form-group text-label="aktif" input-id="aktif" error-name="kategori_berita.aktif">
                <x-kit::toggle wire:model.defer="kategori_berita.aktif"/>
            </x-kit::form-group>

            <div class="flex place-content-end py-4">
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

