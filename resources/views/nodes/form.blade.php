<div class="flex flex-col">
    <div>
        <label for="name">Значение узла</label>
    </div>
    <div class="mt-2">
        <input class="rounded border-gray-300 w-1/3" type="text" name="value" id="value" value="{{$node->value}}">
    </div>
    @if ($errors->has('name'))
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->get('name') as $error)
            <li class="text-rose-600">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="mt-2">
        <label for="parent">Имя родительского узла</label>
    </div>
    <div>
        <select class="rounded border-gray-300 w-1/3" name="parent" id="parent">
            <option value=""></option>
            @foreach ($nodes as $node)
            @if (is_null($node->parent))
            <option value="{{$node->id}}" selected="selected"> {{$node->value}} </option>
            @else
            <option value="{{$node->id}}"> {{$node->value}} </option>
            @endif
            @endforeach
        </select>
    </div>
    @if ($errors->has('status_id'))
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->get('status_id') as $error)
            <li class="text-rose-600">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


</div>