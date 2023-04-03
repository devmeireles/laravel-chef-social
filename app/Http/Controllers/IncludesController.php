<?php

namespace App\Http\Controllers;

use App\Models\Includes;
use App\Http\Requests\StoreIncludesRequest;
use App\Http\Requests\UpdateIncludesRequest;
use App\Repositories\IncludesRepository;
use Illuminate\Support\Facades\Redirect;

class IncludesController extends Controller
{
    private IncludesRepository $includesRepository;

    public function __construct(IncludesRepository $includesRepository)
    {
        $this->includesRepository = $includesRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->includesRepository->getAllWithPagination();

        return view('admin.includes.list')->with(['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.includes.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIncludesRequest $request)
    {
        $this->includesRepository->createItem($request->validated());

        return Redirect::route('admin.includes.list')->
            with('success', "$request->name service include created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $item = $this->includesRepository->getById($id);

        return view('admin.includes.form')->with(['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIncludesRequest $request, int $id)
    {
        $this->includesRepository->updateItem($request->validated(), $id);

        return Redirect::route('admin.includes.list')->
            with('success', "$request->name service include update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->includesRepository->destroyById($id);

        return Redirect::route('admin.includes.list')->
            with('success', "service include deactivated successfully");
    }

    /**
     * Reactivates the specified resource in storage.
     */
    public function reactivate(int $id)
    {
        $this->includesRepository->reactiveById($id);

        return Redirect::route('admin.includes.list')->
            with('success', "Service include restored successfully");
    }
}
