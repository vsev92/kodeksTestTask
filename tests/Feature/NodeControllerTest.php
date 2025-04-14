<?php

namespace Tests\Feature;

use App\Models\Node;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NodeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIindexReturnsTreeView()
    {
        $root = Node::factory()->create(['parent_id' => null]);
        $response = $this->get(route('nodes.index'));
        $response->assertStatus(200);
        $response->assertViewIs('nodes.index');
        $response->assertViewHas('tree', $root);
    }

    public function testIndexPlainReturnsPaginatedNodes()
    {
        Node::factory()->count(20)->create();
        $response = $this->get(route('nodes.indexPlain'));
        $response->assertStatus(200);
        $response->assertViewIs('nodes.indexPlain');
        $response->assertViewHas('nodes');
    }

    public function testStoreCreatesNodeWithValidData()
    {
        $parent = Node::factory()->create();

        $response = $this->post(route('nodes.store'), [
            'parent_id' => $parent->id,
            'value' => 'Test Node',
        ]);

        $response->assertRedirect(route('nodes.index'));
        $this->assertDatabaseHas('nodes', [
            'parent_id' => $parent->id,
            'value' => 'Test Node',
        ]);
    }

    public function testShowDisplaysSpecificNode()
    {
        $node = Node::factory()->create();
        $response = $this->get(route('nodes.show', $node));
        $response->assertStatus(200);
        $response->assertViewIs('nodes.show');
        $response->assertViewHas('tree', $node);
    }

    public function testDestroyDeletesNode()
    {
        $node = Node::factory()->create();
        $response = $this->delete(route('nodes.destroy', $node));
        $response->assertRedirect(route('nodes.index'));
        $this->assertDatabaseMissing('nodes', ['id' => $node->id]);
    }
}
