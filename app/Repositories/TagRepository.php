<?php

namespace App\Repositories;
use App\Interfaces\TagInterface;
use App\Models\Tag;
use Illuminate\Pagination\LengthAwarePaginator;

class TagRepository implements TagInterface {
    function getAllWithPagination(): LengthAwarePaginator
    {
        return Tag::withTrashed()->orderByDesc('id')->paginate(10);
    }

    function getById(int $id)
    {
        return Tag::withTrashed()->find($id);
    }

    function createItem(array $item)
    {
        Tag::create($item);
    }

    function updateItem(mixed $item, int $id)
    {
        $tag = Tag::find($id);
        $tag->name = $item['name'];
        $tag->slug = $item['slug'];
        $tag->save();
    }

    function destroyById(int $id)
    {
        return Tag::destroy($id);
    }

    function reactiveById(int $id)
    {
        return Tag::withTrashed()->find($id)->restore();
    }
}