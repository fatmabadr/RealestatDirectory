<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



<a href ="{{route('my.units',Auth::user()->id)}}">my units </a>
<a href ="{{route('my.messages',Auth::user()->id)}}">my messages </a>






</x-app-layout>
