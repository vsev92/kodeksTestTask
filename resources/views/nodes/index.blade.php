@extends('layouts.home')
@section('content')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="csrf-param" content="_token">
<section class="bg-white dark:bg-gray-900">
    @include('nodes.tree', ['node' => $tree, 'nestingLevel' => $nestingLevel])
</section>
@endsection