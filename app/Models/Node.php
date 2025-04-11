<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Node extends Model
{
    use HasFactory;

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
        $result['nodeValue'] = $this->value;
        $result['children'] = $this->children->map(function ($child) {
            $child->getTreeOfClildren();
        });
        return $result;
    }

    public function getListOfClildren(): array
    {
        $result[] = $this->value;
        $this->children->map(function ($child) use ($result) {
            $descendants = $child->getListOfClildren();
            $result = [...$result, ...$descendants];
        });
        return $result;
    }

    public static function getChildrenById($id): array
    {
        $node = self::findOrFail($id);
        return $node->children;
    }

    public static function addNode(int $parentId, string $value)
    {
        self::findOrFail($parentId);
        $node = new self();
        $node->value = $value;
        $node->save();
    }

    public static function deleteNode(int $id)
    {
        $node = self::find($id);
        $node?->delete();
    }
}
