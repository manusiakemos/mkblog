@props(['sessionActive', 'link'])
@php
    if( session('active') == $sessionActive){
        $classActive = 'shadow-xl bg-primary-500 text-white dark:bg-gray-700 dark:text-white rounded-xl px-3 py-3';
    }else{
        $classActive='px-3 py-3';
    }
@endphp
<li {!! $attributes->merge(['class' => 'mx-3 my-3  px-3 py-6' .$classActive]) !!}>
    <a href="{{$link}}" aria-expanded="false" class="text-sm">
        {{$slot}}
    </a>
</li>
