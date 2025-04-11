<?php

namespace Tests\Unit;

use App\Models\Node;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_node_creation()
    {
        $node = Node::factory()->create(['value' => 'test-node']);
        $this->assertDatabaseHas('nodes', ['value' => 'test-node']);
    }

    public function test_node_relationships()
    {
        $parent = Node::factory()->create();
        $child = Node::factory()->create(['parent_id' => $parent->id]);

        $this->assertEquals($parent->id, $child->parent_id);
        $this->assertTrue($parent->children->contains($child));
    }

    public function test_get_tree_of_children_returns_array()
    {
        $parent = Node::factory()->create();
        $child = Node::factory()->create(['parent_id' => $parent->id]);

        $tree = $parent->getTreeOfClildren();
        $this->assertIsArray($tree);
        $this->assertArrayHasKey('nodeValue', $tree);
        $this->assertArrayHasKey('children', $tree);
    }

    public function test_get_list_of_children_returns_array()
    {
        $parent = Node::factory()->create();
        $child = Node::factory()->create(['parent_id' => $parent->id]);

        $list = $parent->getListOfClildren();
        $this->assertIsArray($list);
        $this->assertNotEmpty($list);
    }

    public function testAddNode()
    {
        $parentNode = Node::factory()->create();
        Node::addNode($parentNode->id, 'Test Value');
        $this->assertDatabaseHas('nodes', [
            'value' => 'Test Value',
        ]);
    }

    public function testAddNodeWithInvalidParentId()
    {
        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);
        Node::addNode(999, 'Test Value');
    }

    public function testDeleteNode()
    {
        $node = Node::factory()->create();
        Node::deleteNode($node->id);
        $this->assertDatabaseMissing('nodes', [
            'id' => $node->id,
        ]);
    }

    public function testDeleteNodeWithNonExistingNode()
    {
        $this->assertNull(Node::deleteNode(999));
        $this->assertDatabaseMissing('nodes', [
            'id' => 999,
        ]);
    }
}
