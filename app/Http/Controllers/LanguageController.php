<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Repositories\LanguageRepository;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    private LanguageRepository $languageRepository;

    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->languageRepository->getAllWithPagination();

        return view('admin.language.list')->with(['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.language.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLanguageRequest $request)
    {
        $this->languageRepository->createItem($request->validated());

        return Redirect::route('admin.language.list')->
            with('success', "$request->name language created successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $item = $this->languageRepository->getById($id);

        return view('admin.language.form')->with(['item' => $item]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanguageRequest $request, int $id)
    {
        $this->languageRepository->updateItem($request->validated(), $id);

        return Redirect::route('admin.language.list')->
            with('success', "$request->name language update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->languageRepository->destroyById($id);

        return Redirect::route('admin.language.list')->
            with('success', "Language deactivated successfully");
    }

    /**
     * Reactivates the specified resource in storage.
     */
    public function reactivate(int $id)
    {
        $this->languageRepository->reactiveById($id);

        return Redirect::route('admin.language.list')->
            with('success', "Language restored successfully");
    }
}
