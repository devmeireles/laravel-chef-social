<?php

namespace App\Repositories;

use App\Interfaces\CuisineInterface;
use App\Models\Cuisine;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Summary of CuisineRepository
 */
class CuisineRepository implements CuisineInterface
{
    function getAllWithPagination(): LengthAwarePaginator
    {
        return Cuisine::withTrashed()->orderByDesc('id')->paginate(10);
    }

    function getById(int $id)
    {
        return Cuisine::withTrashed()->find($id);
    }

    function createItem(array $item)
    {
        Cuisine::create($item);
    }

    function updateItem(mixed $item, int $id)
    {
        $cuisine = Cuisine::find($id);
        $cuisine->name = $item['name'];
        $cuisine->slug = $item['slug'];
        $cuisine->description = $item['description'];
        $cuisine->save();
    }

    function destroyById(int $id)
    {
        return Cuisine::destroy($id);
    }

    function reactiveById(int $id)
    {
        return Cuisine::withTrashed()->find($id)->restore();
    }

}