<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Node;

class NodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rootNode = Node::factory()->create(['parent_id' => null]);
        $childNodes = Node::factory(3)->create(['parent_id' => $rootNode->id]);
        Node::factory(5)->create(['parent_id' => $childNodes[1]->id]);
    }
}
