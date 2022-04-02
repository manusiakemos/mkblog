@php
    $id = Illuminate\Support\Str::random(10);
@endphp

<div class="rounded-md                           shadow-sm prose dark:text-white w-full relative prose-sm dark:prose-invert"
     x-data="{
        value: @entangle($attributes->wire('model')),
        isFocused(){
            return document.activeElement !== this.$refs.trix
        },
        setValue(){
            this.$refs.trix.editor.loadHTML(this.value)
        },
        attachmentAdd(value){
            console.log('attachmentAdd', value);
        }
    }"
     x-init="
        setValue();
        $watch('value', () => isFocused() && setValue());
    "
     x-on:trix-change="value = $event.target.value"
     x-on:trix-attachment-add="attachmentAdd"
     wire:ignore
    {{ $attributes->whereDoesntStartWith('wire:model') }} />

<input class="w-full h-full" id="{{ $id }}" type="hidden">
<trix-editor
    input="{{ $id }}"
    x-ref="trix"
    class="w-full">
</trix-editor>
</div>

@push('stylesBefore')
    @if (config('tall-stack-kit.trix.files') === false)
        <style>
            .trix-button-group.trix-button-group--file-tools {
                display: none;
            }
        </style>
    @endif
@endpush

@push('scripts')
    <script
        data-turbolinks-eval="false"
        data-turbo-eval="false"
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endpush
