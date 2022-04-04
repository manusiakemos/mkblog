<x-slot name="htmlTitle">
    <title>Menu Builder</title>
</x-slot>

<main class="w-full flex-grow px-3">
    <section class="content overflow-x-scroll rounded-lg overflow-y-scroll h-full mx-auto py-5 px-5 min-h-screen">
        <div class="pb-3">
            <x-kit::breadcrumb :items="$breadcrumbs"/>
        </div>
        <div class="mb-3">
            <div class="mb-5 flex flex-grow flex-col md:flex-row items-center justify-center md:justify-between">
                <h4 class="heading mb-3 md:mb-0">Menu Builder</h4>

                <div class="flex flex-wrap">
                    <x-kit::button wire:click="$emit('create')"
                                   variant="rounded"
                                   class="mb-3 bg-primary-500 hover:bg-primary-400 text-white font-semibold uppercase">
                        {{__('messages.add')}} Menu
                    </x-kit::button>
                </div>
            </div>

            <div>
                {{-- livewire alert --}}
                <x-kit::alert
                    class="text-white bg-primary-500 mb-3 border-2 border-white"
                    duration="3000"
                    wire:model="showAlert">{{$alertMessage}}</x-kit::alert>

                {{-- modal form --}}
                @include('livewire.menu._menu-form')

                {{-- confirm delete --}}
                @include('livewire.menu._menu-confirm')

                {{-- toast data table --}}
                <x-kit::toast class="text-white bg-primary-500 mb-3 border-2 border-white" duration="3000"
                              wire:model="showToast">{{$toastMessage}}</x-kit::toast>
            </div>

            {{--menu component vue--}}
            <div id="menuApp" wire:ignore>
                <div>
                    <nested-draggable v-model="list"/>
                </div>

                <div class="flex gap-4 mt-3">
                    <button
                        class="font-semibold uppercase w-full bg-gray-700 mt-1 bg-primary-500 py-3 mb-6 text-white p-3 rounded"
                        v-on:click="saveList">
                        {{__('messages.save')}}
                    </button>

                    @if(config('app.debug'))
                        <button
                            class="font-semibold uppercase w-full bg-gray-700 mt-1 bg-primary-500 py-3 mb-6 text-white p-3 rounded"
                            v-on:click="resetList">
                            Reset
                        </button>
                    @endif
                </div>
            </div>

        </div>
    </section>
</main>
@push("stylesBefore")
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush

@push("scriptsBefore")
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push("scripts")

    <script src="{{ asset('vendor/vue/vue.js') }}"></script>
    <script src="{{ asset('vendor/livewire/livewire-vue.js') }}"></script>
    <script src="{{ asset('vendor/vue-sortable/sortable.min.js') }}"></script>
    <script src="{{ asset('vendor/vue-sortable/vue-draggable.min.js') }}"></script>

  @include('livewire.menu._menu-script')
@endpush

