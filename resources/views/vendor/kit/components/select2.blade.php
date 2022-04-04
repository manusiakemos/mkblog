<div
    wire:ignore
    {!! $attributes->merge(['class'=>'relative']) !!}
    x-data="{
        select2 : null,
        selected: @entangle($attributes->wire('model')),
    }"
    x-init="
        $nextTick(() => {
            this.select2 = $($refs.select).select2({
                dropdownParent: $('#{{$attributes->get('dropdown-parent')}}')
            });
            this.select2.on('select2:select', (event) => {
                selected = event.target.value;
            });
            $watch('selected', (value) => {
                this.select2.val(value).trigger('change');
            });

            setTimeout(()=>{
               this.select2.val(null).trigger('change');
            },100)
        });
    ">
    <select
        data-placeholder="{{$attributes->get('placeholder')}}"
        x-model="selected"
        x-ref="select">
        {{$slot}}
    </select>
</div>
