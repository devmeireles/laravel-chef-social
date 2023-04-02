<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use App\Http\Requests\StoreCuisineRequest;
use App\Http\Requests\UpdateCuisineRequest;
use Illuminate\Support\Facades\Redirect;
use Route;

class CuisineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Cuisine::withTrashed()->orderByDesc('id')->paginate(10);
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
        Cuisine::create($request->validated());

        return Redirect::route('admin.cuisine.list')->
            with('success', "$request->name cuisine created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuisine $cuisine, int $id)
    {
        $item = Cuisine::withTrashed()->find($id);
        return view('admin.cuisine.form')->with(['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCuisineRequest $request, int $id)
    {
        $request->validated();

        $cuisine = Cuisine::find($id);
        $cuisine->name = $request->name;
        $cuisine->description = $request->description;
        $cuisine->save();

        return Redirect::route('admin.cuisine.list')->
            with('success', "$request->name cuisine update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Cuisine::destroy($id);

        return Redirect::route('admin.cuisine.list')->
            with('success', "Cuisine deactivated successfully");
    }

    /**
     * Reactivates the specified resource in storage.
     */
    public function reactivate(int $id)
    {
        $cuisine = Cuisine::withTrashed()->find($id);
        $cuisine->restore();

        return Redirect::route('admin.cuisine.list')->
            with('success', "$cuisine->name cuisine restored successfully");
    }
}