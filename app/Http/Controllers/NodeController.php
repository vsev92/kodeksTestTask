<?php

namespace App\Http\Controllers;

use App\Models\Node;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rootNode = Node::where('parent_id', null)->firstOrFail();
        //$tree = $rootNode->getTreeOfClildren();
        //$nodes = Node::query();
        // dd($nodes->get());
        $html = $this->generateHtmlTree($rootNode, 1);
        return view('nodes.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Node $node)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Node $node)
    {
        //
    }

    private function generateHtmlTree(Node $node, int $nestingLevel)
    {
        $html = '';



        if (is_null($node->parent)) {
            $html = "<ul>-{$node->value}";
            $nestingLevel++;
        }

        $hyphenCount = str_repeat('-', $nestingLevel);
        $nextNestingLevel = $nestingLevel + 1;

        $children = $node->children;
        if ($children->count()) {
            $html .= '<ul>';

            foreach ($children as $node) {

                $html .= '<li>' . $hyphenCount . e($node->value);


                $html .= $this->generateHtmlTree($node, $nextNestingLevel);

                $html .= '</li>';
            }

            $html .= '</ul>';
        }
        if (is_null($node->parent)) {
            $html .= '</ul>';
        }
        return $html;
    }
}
