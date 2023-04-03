<?php

namespace App\Http\Controllers;

use App\Enums\PerksEnum;
use App\Models\Perk;
use App\Http\Requests\StorePerkRequest;
use App\Http\Requests\UpdatePerkRequest;
use App\Repositories\PerkRepository;
use Redirect;

class PerkController extends Controller
{

    private PerkRepository $perkRepository;

    public function __construct(PerkRepository $perkRepository)
    {
        $this->perkRepository = $perkRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->perkRepository->getAllWithPagination();

        return view('admin.perk.list')->with(['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perkOptions = PerksEnum::cases();
        return view('admin.perk.form')->with(['perkOptions' => $perkOptions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePerkRequest $request)
    {
        $this->perkRepository->createItem($request->validated());

        return Redirect::route('admin.perk.list')->
            with('success', "$request->name perk created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $item = $this->perkRepository->getById($id);
        $perkOptions = PerksEnum::cases();

        return view('admin.perk.form')->with([
            'item' => $item,
            'perkOptions' => $perkOptions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePerkRequest $request, int $id)
    {
        $this->perkRepository->updateItem($request->validated(), $id);

        return Redirect::route('admin.perk.list')->
            with('success', "$request->name perk update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->perkRepository->destroyById($id);

        return Redirect::route('admin.perk.list')->
            with('success', "Perk deactivated successfully");
    }
}