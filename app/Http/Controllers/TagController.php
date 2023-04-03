<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Repositories\TagRepository;
use Illuminate\Support\Facades\Redirect;

class TagController extends Controller
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->tagRepository->getAllWithPagination();

        return view('admin.tag.list')->with(['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tag.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        $this->tagRepository->createItem($request->validated());

        return Redirect::route('admin.tag.list')->
            with('success', "$request->name tag created successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag, int $id)
    {
        $item = $this->tagRepository->getById($id);

        return view('admin.tag.form')->with(['item' => $item]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, int $id)
    {
        $this->tagRepository->updateItem($request->validated(), $id);

        return Redirect::route('admin.tag.list')->
            with('success', "$request->name tag update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->tagRepository->destroyById($id);

        return Redirect::route('admin.tag.list')->
            with('success', "Tag deactivated successfully");
    }

    /**
     * Reactivates the specified resource in storage.
     */
    public function reactivate(int $id)
    {
        $this->tagRepository->reactiveById($id);

        return Redirect::route('admin.tag.list')->
            with('success', "Tag restored successfully");
    }
}