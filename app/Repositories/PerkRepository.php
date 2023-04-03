<?php

namespace App\Repositories;

use App\Interfaces\PerkInterface;
use App\Models\Perk;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Summary of PerkRepository
 */
class PerkRepository implements PerkInterface
{
    function getAllWithPagination(): LengthAwarePaginator
    {
        return Perk::withTrashed()->orderByDesc('id')->paginate(10);
    }

    function getById(int $id)
    {
        return Perk::withTrashed()->find($id);
    }

    function createItem(array $item)
    {
        Perk::create($item);
    }

    function updateItem(mixed $item, int $id)
    {

        $perk = Perk::find($id);
        $perk->name = $item['name'];
        $perk->slug = $item['slug'];
        $perk->type = $item['type'];
        $perk->description = $item['description'];
        $perk->save();
    }

    function destroyById(int $id)
    {
        return Perk::destroy($id);
    }

    function reactiveById(int $id)
    {
        return Perk::withTrashed()->find($id)->restore();
    }

}