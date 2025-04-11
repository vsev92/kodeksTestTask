@extends('layouts.home')
@section('content')
@vite(['resources/css/app.css', 'resources/js/app.js'])

<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="csrf-param" content="_token">
<style>
    ul {
        list-style-type: none;
    }

    li {
        padding-left: 20px;
    }
</style>
<section class="bg-white dark:bg-gray-900">
    <div class="grid w-[90%] max-w-full px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        {!! $html !!}
    </div>
</section>
@endsection