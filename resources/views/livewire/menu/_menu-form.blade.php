<div>
    <x-kit::modal id="modal_form" wire:model="showModalForm" size="md">
        <form action="#" wire:submit.prevent="save" class="p-3">

            <x-kit::form-group text-label="type" input-id="type" error-name="menu.type">
                <x-kit::select2 wire:model="menu.type"
                                id="type"
                                dropdown-parent="modal_form"
                                placeholder="select menu type"
                >
                    @foreach($options['menu_type'] as $item)
                        <option value="{{$item['id']}}">
                            {{$item['name']}}
                        </option>
                    @endforeach
                </x-kit::select2>
            </x-kit::form-group>

            {{-- dynamic menu url form --}}
            @if($menu['type'] == 'link')
                {{--link--}}
                <x-kit::form-group text-label="url" input-id="url" error-name="menu.url">
                    <x-kit::input id="url" wire:model.defer="menu.url"/>
                </x-kit::form-group>
            @elseif($menu['type'] == 'page')
                {{--page select2--}}
                <x-kit::form-group text-label="page" input-id="url" error-name="menu.url">
                    <x-kit::select2 wire:model="menu.url"
                                    id="page"
                                    dropdown-parent="modal_form"
                                    placeholder="select a page"
                    >
                        @foreach($options['custom_page'] as $item)
                            <option value="{{$item['custom_page_id']}}">
                                {{$item['title']}}
                            </option>
                        @endforeach
                    </x-kit::select2>
                </x-kit::form-group>
            @elseif($menu['type'] == 'fixed')
                <x-kit::form-group text-label="fixed page" input-id="url" error-name="menu.url">
                    <x-kit::select2 wire:model="menu.url"
                                    id="fixed"
                                    dropdown-parent="modal_form"
                                    placeholder="select a page"
                    >
                        @foreach($options['fixed'] as $item)
                            <option value="{{$item['id']}}">
                                {{$item['name']}}
                            </option>
                        @endforeach
                    </x-kit::select2>
                </x-kit::form-group>
            @endif

            <x-kit::form-group text-label="Label" input-id="label" error-name="menu.label">
                <x-kit::input id="label" wire:model.defer="menu.label"/>
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

