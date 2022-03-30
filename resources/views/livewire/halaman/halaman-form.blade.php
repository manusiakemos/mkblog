<x-slot name="htmlTitle">
    <title>Halaman</title>
</x-slot>

<main class="w-full flex-grow px-3">
    <section class="content overflow-x-scroll rounded-lg overflow-y-scroll h-full mx-auto py-5 px-5 min-h-screen">
        <div class="pb-3">
            <x-kit::breadcrumb :items="$breadcrumbs"/>
        </div>
        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg">
            <div class="mb-5 flex items-center justify-between">
                <h4 class="heading mb-3 md:mb-0">
                    {{$updateMode ? __('messages.edit') : __('messages.add')}} Halaman
                </h4>
            </div>

            <div>
                <form action="#" wire:submit.prevent="save" class="p-3">

                    <x-kit::form-group text-label="judul" input-id="judul" error-name="halaman.judul">
                        <x-kit::input id="judul" wire:model.defer="halaman.judul"/>
                    </x-kit::form-group>

                    <x-kit::form-group text-label="aktif" input-id="aktif" error-name="halaman.aktif">
                        <x-kit::toggle wire:model="halaman.aktif"/>
                    </x-kit::form-group>

                    <x-kit::form-group text-label="custom url" input-id="custom" error-name="halaman.custom">
                        <x-kit::toggle wire:model="halaman.custom"/>
                    </x-kit::form-group>

                    @if($halaman['custom'])
                        <x-kit::form-group text-label="url" input-id="url" error-name="halaman.url">
                            <x-kit::input id="url" wire:model.defer="halaman.url"/>
                        </x-kit::form-group>
                    @endif

                    <x-kit::form-group text-label="gambar" input-id="image" error-name="image">
                        <x-kit::file-upload id="image" wire:model="image"/>
                    </x-kit::form-group>

                    <x-kit::form-group text-label="isi" input-id="isi" error-name="halaman.isi">
                        <x-kit::editor wire:model="halaman.isi" id="isi"/>
                    </x-kit::form-group>

                    <div class="flex place-content-end py-4">
                        <x-kit::button variant="rounded"
                                       wire:click="back"
                                       class="bg-primary-500 hover:bg-primary-400 text-white hover:bg-blue-400">
                            Kembali
                        </x-kit::button>
                        <x-kit::button variant="rounded" type="submit"
                                       class="bg-primary-500 hover:bg-primary-400 text-white hover:bg-blue-400"
                        >
                            {{$updateMode ? "Simpan Perubahan" : "Simpan"}}
                        </x-kit::button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
