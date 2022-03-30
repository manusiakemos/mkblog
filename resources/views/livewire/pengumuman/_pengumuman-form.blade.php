<div>
    <x-kit::modal id="modal_form" wire:model="showModalForm" size="md">
        <form action="#" wire:submit.prevent="save" class="p-3">
            <x-kit::form-group text-label="judul" input-id="judul" error-name="pengumuman.judul">
                <x-kit::input id="judul" wire:model.defer="pengumuman.judul"/>
            </x-kit::form-group>

            <x-kit::form-group text-label="tanggal" input-id="tanggal" error-name="pengumuman.tanggal">
                <div class="md:w-1/3">
                    <x-kit::input type="date" id="tanggal" wire:model.defer="pengumuman.tanggal"/>
                </div>
            </x-kit::form-group>

            <x-kit::form-group text-label="rutin" input-id="rutin" error-name="pengumuman.rutin">
                <x-kit::toggle wire:model="pengumuman.rutin"/>
            </x-kit::form-group>

            <x-kit::form-group text-label="aktif" input-id="aktif" error-name="pengumuman.aktif">
                <x-kit::toggle wire:model="pengumuman.aktif"/>
            </x-kit::form-group>

            <x-kit::form-group text-label="isi" input-id="isi" error-name="pengumuman.isi">
                <x-kit::textarea id="isi" wire:model.defer="pengumuman.isi"/>
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

