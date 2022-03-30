<x-slot name="htmlTitle">
    <title>Berita</title>
</x-slot>

<main class="w-full flex-grow px-3">
    <section class="content overflow-x-scroll rounded-lg overflow-y-scroll h-full mx-auto py-5 px-5 min-h-screen">
        <div class="pb-3">
            <x-kit::breadcrumb :items="$breadcrumbs"/>
        </div>
        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg">
            <div class="mb-5 flex items-center justify-between">
                <h4 class="heading mb-3 md:mb-0">
                    {{$updateMode ? __('messages.edit') : __('messages.add')}} Berita
                </h4>
            </div>

            <div>
                <form action="#" wire:submit.prevent="save" class="p-3">

                   <div class="md:grid md:grid-cols-2 gap-4">

                       <x-kit::form-group text-label="judul" input-id="judul" error-name="berita.judul">
                           <x-kit::input id="judul" wire:model.defer="berita.judul"/>
                       </x-kit::form-group>

                       <x-kit::form-group text-label="kategori post" input-id="kategori_id" error-name="berita.kategori_id">

                           <x-kit::select-search wire:model="berita.kategori_id"
                                                 :options="$options['kategori_berita']"
                                                 placeholder="pilih kategori"
                                                 option-value="kategori_id"
                                                 option-text="nama"/>

                       </x-kit::form-group>
                   </div>

                    <x-kit::form-group text-label="aktif" input-id="aktif" error-name="berita.aktif">
                        <x-kit::toggle id="aktif" wire:model.defer="berita.aktif"/>
                    </x-kit::form-group>

                    <x-kit::form-group text-label="isi" input-id="isi" error-name="berita.isi">
                        <x-kit::editor id="isi" wire:model.defer="berita.isi"/>
                    </x-kit::form-group>

                    <x-kit::form-group text-label="gambar" input-id="gambar" error-name="image">
                        <x-kit::file-upload id="image" wire:model.defer="image"/>
                    </x-kit::form-group>



                    <div class="flex place-content-end py-4">
                        <x-kit::button variant="rounded"
                                       wire:click="back"
                                       class="bg-danger-500 hover:bg-danger-400 text-white hover:bg-danger-400">
                            Kembali
                        </x-kit::button>
                        <x-kit::button variant="rounded" type="submit"
                                       class="bg-primary-500 hover:bg-primary-400 text-white hover:bg-primary-400"
                        >
                            {{$updateMode ? "Simpan Perubahan" : "Simpan"}}
                        </x-kit::button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
