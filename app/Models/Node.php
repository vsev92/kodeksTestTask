<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    public function parent()
    {
        return $this->belongsTo(Node::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Node::class, 'parent_id');
    }


    public function getTreeOfClildren(): array
    {
        $result['node'] = $this;
        $result['children'] = $this->children()->map(fn($child) =>  $child->getTreeOfClildren())->all();
        return $result;
    }

    public function getListOfClildren(): array
    {
        $result[] = $this;
        $clildren = $this->children();
        $result = [...$result, ...$clildren];
        $clildren->map(function ($child) use ($result) {
            $descendants = $child->getListOfClildren()->all();
            $result = [...$result, ...$descendants];
        });
        return $result;
    }

    public static function getChildrenById($id): array
    {
        $node = self::findOrFail($id);
        return $node->children();
    }

    public static function addNode(int $parentId, string $value): array
    {
        self::findOrFail($parentId);
        $node = new self();
        $node->value = $value;
        $node->save();
    }

    public static function deleteNode(int $id): array
    {
        $node = self::find($id);
        $node?->delete();
    }
}
