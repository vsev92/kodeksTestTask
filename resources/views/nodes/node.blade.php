<li class="pl-5">
    <a class="text-blue-600 hover:text-blue-900" href="{{route('nodes.show', $node->id)}}">
        {{str_repeat('-',$nestingLevel)}} {{ $node->value }}
    </a>
    <a data-confirm="Вы уверены?" data-method="delete" href="{{ route('nodes.destroy', $node->id) }}">
        &#10006;
    </a>
    @if (!empty($node->children))
    <ul class="list-none">
        @foreach ($node->children as $child)
        @include('nodes.node', ['node' => $child, 'nestingLevel' => $nestingLevel + 1])
        @endforeach
    </ul>
    @endif
</li>