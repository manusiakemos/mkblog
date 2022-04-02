 <x-kit::confirm id="modalConfirm" max-width="sm" wire:model="showModalConfirm">
                   <h4 class="font-semibold tracking-wider text-3xl text-primary-500 text-center mb-3">
                       <x-slot name="title">
                            {{__('messages.delete_confirm')}}
                       </x-slot>
                   </h4>
                   <x-slot name="text">
                       <p class="text-center text-gray-700 dark:text-gray-300">
                           {{ __('messages.delete_confirm_text') }}
                       </p>
                   </x-slot>
                   <x-slot name="yes">
                       <x-kit::button wire:click="destroy('{{ $gallery['gallery_id'] }}')"
                                      variant="rounded"
                                      class="font-semibold uppercase bg-primary-500 hover:bg-primary-400 text-white grow w-full">
                           {{__('messages.yes')}}
                       </x-kit::button>
                   </x-slot>
                   <x-slot name="no">
                       <x-kit::button x-on:click="$wire.set('showModalConfirm', false)"
                                      variant="rounded"
                                      class="font-semibold uppercase bg-danger-500 hover:bg-danger-400 text-white grow w-full">
                           {{__('messages.no')}}
                       </x-kit::button>
                   </x-slot>
               </x-kit::confirm>
