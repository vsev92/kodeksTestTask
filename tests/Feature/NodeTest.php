<?php

namespace Tests\Unit;

use App\Models\Node;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NodeTest extends TestCase
{
    use RefreshDatabase;

    public function testNodeCreation()
    {
        $node = Node::factory()->create(['value' => 'test-node']);
        $this->assertDatabaseHas('nodes', ['value' => 'test-node']);
    }

    public function testNodeRelationships()
    {
        $parent = Node::factory()->create();
        $child = Node::factory()->create(['parent_id' => $parent->id]);
        $this->assertEquals($parent->id, $child->parent_id);
        $this->assertTrue($parent->children->contains($child));
    }
}
