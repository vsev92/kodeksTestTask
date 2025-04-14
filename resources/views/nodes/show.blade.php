@extends('layouts.home')
@section('content')
<section class="bg-white dark:bg-gray-900 pt-20">
    <div class="w-[30vw]">
        <div class="text-center">
            <h2 class="text-2xl font-semibold">Узел {{$tree->id}}</h2>
        </div>
        @include('nodes.tree', ['node' => $tree, 'nestingLevel' => $nestingLevel])
    </div>
</section>
@endsection