<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    @if (Auth::user()->userType==1)
<a href ="{{route('my.units',Auth::user()->id)}}">my units </a> <br>
<a href ="{{route('my.messages',Auth::user()->id)}}">my messages </a><br>
<a href="{{route('unit.create')}}"> add new Property</a>
@endif





</x-app-layout>
