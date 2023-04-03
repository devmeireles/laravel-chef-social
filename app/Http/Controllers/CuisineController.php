<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use App\Http\Requests\StoreCuisineRequest;
use App\Http\Requests\UpdateCuisineRequest;
use App\Repositories\CuisineRepository;
use Illuminate\Support\Facades\Redirect;
use Route;

class CuisineController extends Controller
{
    private CuisineRepository $cuisineRepository;

    public function __construct(CuisineRepository $cuisineRepository)
    {
        $this->cuisineRepository = $cuisineRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->cuisineRepository->getAllWithPagination();

        return view('admin.cuisine.list')->with(['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cuisine.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCuisineRequest $request)
    {
        $this->cuisineRepository->createItem($request->validated());

        return Redirect::route('admin.cuisine.list')->
            with('success', "$request->name cuisine created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuisine $cuisine, int $id)
    {
        $item = $this->cuisineRepository->getById($id);

        return view('admin.cuisine.form')->with(['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCuisineRequest $request, int $id)
    {
        $this->cuisineRepository->updateItem($request->validated(), $id);

        return Redirect::route('admin.cuisine.list')->
            with('success', "$request->name cuisine update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->cuisineRepository->destroyById($id);

        return Redirect::route('admin.cuisine.list')->
            with('success', "Cuisine deactivated successfully");
    }

    /**
     * Reactivates the specified resource in storage.
     */
    public function reactivate(int $id)
    {
        $this->cuisineRepository->reactiveById($id);

        return Redirect::route('admin.cuisine.list')->
            with('success', "Cuisine restored successfully");
    }
}