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
    <div class="pt-20">
        <ul>
            @include('nodes.node', ['node' => $tree, 'nestingLevel' => $nestingLevel])
        </ul>
</section>
@endsection