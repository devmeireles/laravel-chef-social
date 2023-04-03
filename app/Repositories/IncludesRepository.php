<?php

namespace App\Repositories;

use App\Interfaces\IncludesInterface;
use App\Models\Includes;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Summary of IncludesRepository
 */
class IncludesRepository implements IncludesInterface
{
    function getAllWithPagination(): LengthAwarePaginator
    {
        return Includes::withTrashed()->orderByDesc('id')->paginate(10);
    }

    function getById(int $id)
    {
        return Includes::withTrashed()->find($id);
    }

    function createItem(array $item)
    {
        Includes::create($item);
    }

    function updateItem(mixed $item, int $id)
    {
        $includes = Includes::find($id);
        $includes->name = $item['name'];
        $includes->slug = $item['slug'];
        $includes->description = $item['description'];
        $includes->save();
    }

    function destroyById(int $id)
    {
        return Includes::destroy($id);
    }

    function reactiveById(int $id)
    {
        return Includes::withTrashed()->find($id)->restore();
    }

}