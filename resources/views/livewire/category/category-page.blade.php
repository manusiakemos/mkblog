<x-slot name="htmlTitle">
    <title>{{ __('messages.category') }}</title>
</x-slot>

<main class="w-full flex-grow px-3">
    <section class="content overflow-x-scroll rounded-lg overflow-y-scroll h-full mx-auto py-5 px-5 min-h-screen">
        <div class="pb-3">
            <x-kit::breadcrumb :items="$breadcrumbs"/>
        </div>
        <div class="mb-3">
            <div class="mb-5 flex flex-grow flex-col md:flex-row items-center justify-center md:justify-between">
                <h4 class="heading mb-3 md:mb-0">{{ __('messages.category') }}</h4>

                <div class="flex flex-wrap">
                    <x-kit::button
                        wire:click="$emit('create')"
                        variant="rounded"
                        class="mb-3 bg-primary-500 hover:bg-primary-400 text-white font-semibold uppercase">
                        {{__('messages.add')}} {{ __('messages.category') }}
                    </x-kit::button>
                    <x-kit::button
                        variant="rounded"
                        class="btn bg-primary-500 hover:bg-primary-400 text-white font-semibold uppercase mb-3 mx-1"
                        wire:click="$emit('refreshDt', true)">
                        {{ __('messages.refresh_table') }}
                    </x-kit::button>
                </div>
            </div>

            <div>
                {{-- livewire alert --}}
                <x-kit::alert
                    class="text-white bg-primary-500 mb-3 border-2 border-white"
                    duration="3000"
                    wire:model="showAlert">{{$alertMessage}}</x-kit::alert>

                {{-- livewire table data --}}
                <livewire:category.category-table/>

                {{-- modal form --}}
                @include('livewire.category._category-form')

                {{-- confirm delete --}}
                @include('livewire.category._category-confirm')

                {{-- toast data table --}}
                <x-kit::toast
                    class="text-white bg-primary-500 mb-3 border-2 border-white p-3 font-semibold"
                    duration="3000"
                    wire:model="showToast">{{$toastMessage}}</x-kit::toast>
            </div>

        </div>
    </section>
</main>


@push("scripts")
    <script>
        Livewire.on("confirmDestroy", (id) => {
            @this.set('showModalConfirm', true);
            @this.set('category.category_id', id);
        });
        Livewire.on("refreshDt", (showNoty = false) => {
            console.log('refreshDt');
                Livewire.components.getComponentsByName('category.category-table')[0].$wire.$refresh();
                if (showNoty) {
                    @this.set('showToast', true);
                    @this.set('toastMessage', '{{__('messages.table_refreshed')}}');
                }
        });
    </script>
@endpush

