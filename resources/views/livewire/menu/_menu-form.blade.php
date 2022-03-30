<div>
   <x-kit::modal id="modal_form" wire:model="showModalForm" size="md">
       <form action="#" wire:submit.prevent="save" class="p-3">
            <x-kit::form-group text-label="Parent" input-id="parent_id" error-name="menu.parent_id">
                    <x-kit::input id="parent_id" wire:model.defer="menu.parent_id"/>
                </x-kit::form-group>

    <x-kit::form-group text-label="type" input-id="type" error-name="menu.type">
                    <x-kit::input id="type" wire:model.defer="menu.type"/>
                </x-kit::form-group>

    <x-kit::form-group text-label="Nama" input-id="name" error-name="menu.name">
                    <x-kit::input id="name" wire:model.defer="menu.name"/>
                </x-kit::form-group>

    <x-kit::form-group text-label="url" input-id="url" error-name="menu.url">
                    <x-kit::input id="url" wire:model.defer="menu.url"/>
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

