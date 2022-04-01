<x-slot name="htmlTitle">
    <title>{{ __('messages.page') }}</title>
</x-slot>

<main class="w-full flex-grow px-3">
    <section class="content overflow-x-scroll rounded-lg overflow-y-scroll h-full mx-auto py-5 px-5 min-h-screen">
        <div class="pb-3">
            <x-kit::breadcrumb :items="$breadcrumbs"/>
        </div>
        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg">
            <div class="mb-5 flex items-center justify-between">
                <h4 class="heading mb-3 md:mb-0">
                    {{$updateMode ? __('messages.edit') : __('messages.add')}} {{ __('messages.page') }}
                </h4>

                <x-kit::button
                    class="bg-primary-500 text-white hover:bg-primary-400"
                    wire:click="back"
                    variant="circle">
                    <span class="flex justify-center items-center fi-rr-cross"></span>
                </x-kit::button>
            </div>

            <div>
                <form action="#" wire:submit.prevent="save" class="p-3">
                    <x-kit::form-group text-label="Title" input-id="title" error-name="custom_page.title">
                        <x-kit::input id="title" wire:model.defer="custom_page.title"/>
                    </x-kit::form-group>

                    <x-kit::form-group text-label="active" input-id="active" error-name="custom_page.active">
                        <x-kit::toggle id="active" wire:model.defer="custom_page.active"/>
                    </x-kit::form-group>

                    <x-kit::form-group text-label="Content" input-id="content" error-name="custom_page.content">
                        <x-kit::editor id="content" wire:model.defer="custom_page.content"/>
                    </x-kit::form-group>

                    <div class="flex place-content-end py-4">
                        <x-kit::button variant="rounded"
                                       wire:click="back"
                                       class="bg-danger-500 hover:bg-danger-400 text-white hover:bg-danger-400">
                            {{__('messages.back')}}
                        </x-kit::button>
                        <x-kit::button variant="rounded" type="submit"
                                       class="bg-primary-500 hover:bg-primary-400 text-white hover:bg-primary-400"
                        >
                            {{$updateMode ? __('messages.save_changes') : __('messages.save') }}
                        </x-kit::button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
