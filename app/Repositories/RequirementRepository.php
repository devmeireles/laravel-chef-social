<?php

namespace App\Repositories;

use App\Interfaces\RequirementInterface;
use App\Models\Requirement;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Summary of RequirementRepository
 */
class RequirementRepository implements RequirementInterface
{
    function getAllWithPagination(): LengthAwarePaginator
    {
        return Requirement::withTrashed()->orderByDesc('id')->paginate(10);
    }

    function getById(int $id)
    {
        return Requirement::withTrashed()->find($id);
    }

    function createItem(array $item)
    {
        Requirement::create($item);
    }

    function updateItem(mixed $item, int $id)
    {
        $requirement = Requirement::find($id);
        $requirement->name = $item['name'];
        $requirement->slug = $item['slug'];
        $requirement->description = $item['description'];
        $requirement->save();
    }

    function destroyById(int $id)
    {
        return Requirement::destroy($id);
    }

    function reactiveById(int $id)
    {
        return Requirement::withTrashed()->find($id)->restore();
    }

}