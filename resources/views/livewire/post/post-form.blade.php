<x-slot name="htmlTitle">
    <title>{{ __('messages.post') }}</title>
</x-slot>

<main class="w-full flex-grow px-3">
    <section class="content overflow-x-scroll rounded-lg overflow-y-scroll h-full mx-auto py-5 px-5 min-h-screen">
        <div class="pb-3">
            <x-kit::breadcrumb :items="$breadcrumbs"/>
        </div>
        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg">
            <div class="mb-5 flex items-center justify-between">
                <h4 class="heading mb-3 md:mb-0">
                    {{$updateMode ? __('messages.edit') : __('messages.add')}} {{ __('messages.post') }}
                </h4>
            </div>

            <div>
                <form action="#" wire:submit.prevent="save" class="p-3">

                    <div class="md:grid md:grid-cols-2 gap-4">

                        <x-kit::form-group text-label="title" input-id="title" error-name="post.title">
                            <x-kit::input id="title" wire:model.defer="post.title"/>
                        </x-kit::form-group>

                        <x-kit::form-group text-label="category" input-id="category_id"
                                           error-name="post.category_id">
                            <x-kit::select-search
                                wire:model="post.category_id"
                                :options="$options['category']"
                                placeholder="select category"
                                option-value="category_id"
                                option-text="name"/>
                        </x-kit::form-group>
                    </div>

                    <x-kit::form-group text-label="active" input-id="active" error-name="post.active">
                        <x-kit::toggle id="active" wire:model.defer="post.active"/>
                    </x-kit::form-group>

                    <x-kit::form-group text-label="content" input-id="content" error-name="post.content">
                        <x-kit::editor id="content" wire:model.defer="post.content"/>
                    </x-kit::form-group>

                    <x-kit::form-group text-label="image" input-id="image" error-name="image">
                        <x-kit::file-upload id="image" wire:model.defer="image"/>
                    </x-kit::form-group>


                    <div class="flex place-content-end py-4">
                        <x-kit::button variant="rounded"
                                       wire:click="back"
                                       class="bg-danger-500 hover:bg-danger-400 text-white hover:bg-danger-400">
                            {{ __('messages.back') }}
                        </x-kit::button>
                        <x-kit::button variant="rounded" type="submit"
                                       class="bg-primary-500 hover:bg-primary-400 text-white hover:bg-primary-400"
                        >
                            {{$updateMode ?  __('messages.save_changes') : __('messages.save')}}
                        </x-kit::button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
