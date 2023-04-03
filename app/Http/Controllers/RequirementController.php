<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use App\Http\Requests\StoreRequirementRequest;
use App\Http\Requests\UpdateRequirementRequest;
use App\Repositories\RequirementRepository;
use Illuminate\Support\Facades\Redirect;

class RequirementController extends Controller
{

    private RequirementRepository $requirementRepository;

    public function __construct(RequirementRepository $requirementRepository)
    {
        $this->requirementRepository = $requirementRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->requirementRepository->getAllWithPagination();

        return view('admin.requirement.list')->with(['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.requirement.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequirementRequest $request)
    {
        $this->requirementRepository->createItem($request->validated());

        return Redirect::route('admin.requirement.list')->
            with('success', "$request->name requirement created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $item = $this->requirementRepository->getById($id);

        return view('admin.requirement.form')->with(['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequirementRequest $request, int $id)
    {
        $this->requirementRepository->updateItem($request->validated(), $id);

        return Redirect::route('admin.requirement.list')->
            with('success', "$request->name requirement update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->requirementRepository->destroyById($id);

        return Redirect::route('admin.requirement.list')->
            with('success', "Menu requirement deactivated successfully");
    }
}
