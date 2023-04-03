<?php

namespace App\Repositories;
use App\Interfaces\LanguageInterface;
use App\Models\Language;
use Illuminate\Pagination\LengthAwarePaginator;

class LanguageRepository implements LanguageInterface {
    function getAllWithPagination(): LengthAwarePaginator
    {
        return Language::withTrashed()->orderByDesc('id')->paginate(10);
    }

    function getById(int $id)
    {
        return Language::withTrashed()->find($id);
    }

    function createItem(array $item)
    {
        Language::create($item);
    }

    function updateItem(mixed $item, int $id)
    {
        $language = Language::find($id);
        $language->name = $item['name'];
        $language->slug = $item['slug'];
        $language->save();
    }

    function destroyById(int $id)
    {
        return Language::destroy($id);
    }

    function reactiveById(int $id)
    {
        return Language::withTrashed()->find($id)->restore();
    }
}