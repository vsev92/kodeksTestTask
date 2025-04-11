<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Node;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Node>
 */
class NodeFactory extends Factory
{

    protected $model = Node::class;

    public function definition()
    {
        return [
            'value' => $this->faker->word,
            'parent_id' => null
        ];
    }

    public function withParent()
    {
        return $this->state(function () {
            return [
                'parent_id' => $this->faker->numberBetween(1, 4),
            ];
        });
    }
}
