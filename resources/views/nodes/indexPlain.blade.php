@extends('layouts.home')
@section('content')
@vite(['resources/css/app.css', 'resources/js/app.js'])

<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="csrf-param" content="_token">
<section class="bg-white dark:bg-gray-900">
    <div class="grid w-[90%] max-w-full px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-3 lg:pt-28">
        <table class="border border-gray-300 border-collapse w-full text-left">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">ID узла</th>
                    <th class="border border-gray-300 px-4 py-2">Значение узла</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nodes as $node)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">
                        <a class="text-blue-600 hover:underline" href="{{route('nodes.show', $node->id)}}">
                            {{ $node->id }}
                        </a>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $node->value }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div>
        <div class="pagination grid w-[40%]">
            {{ $nodes->links() }}
        </div>
    </div>
</section>
@endsection