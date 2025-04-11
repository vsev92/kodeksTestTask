<li>
    {{str_repeat('-',$nestingLevel)}} {{ $node->value }}
    <a data-confirm="Вы уверены?" data-method="delete" href="{{ route('nodes.destroy', $node->id) }}">
        &#10006;
    </a>
    @if (!empty($node->children))
    <ul>
        @foreach ($node->children as $child)
        @include('nodes.node', ['node' => $child, 'nestingLevel' => $nestingLevel + 1])
        @endforeach
    </ul>
    @endif
</li>