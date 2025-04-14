<?php

namespace App\Http\Controllers;

use App\Models\Node;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rootNode = Node::where('parent_id', null)->firstOrFail();
        $nestingLevel = 1;
        $tree = $rootNode;
        return view('nodes.index', compact('tree', 'nestingLevel'));
    }

    public function indexPlain()
    {
        $nodes = Node::paginate(15);
        return view('nodes.indexPlain', compact('nodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $node = new Node();
        $node->value = 'newNode';
        $nodes = Node::all();
        return view('nodes.create', compact('node', 'nodes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $nodesValues = Node::pluck('id');

        $data = $request->validate([
            'parent_id' => ['required', Rule::in($nodesValues)],
            'value' => ['required', 'string'],
        ]);
        $node = new Node();
        $node->fill($data);
        $node->save();

        return redirect()->route('nodes.index')->with('success', 'Узел создан!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Node $node)
    {
        $rootNode = Node::where('id', $node->id)->firstOrFail();
        $nestingLevel = 1;
        $tree = $rootNode;
        return view('nodes.show', compact('tree', 'nestingLevel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Node $node)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Node $node)
    {
        //
    }

    public function destroy(Node $node)
    {
        $node->delete();
        return redirect()->route('nodes.index');
    }
}
