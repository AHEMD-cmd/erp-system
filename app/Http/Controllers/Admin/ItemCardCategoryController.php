<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ItemCardCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ItemCardCategoryStoreRequest;
use App\Http\Requests\Admin\ItemCardCategoryUpdateRequest;

class ItemCardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ItemCardCategory::with('creator', 'updater')->latest()->get();
        return view('admin.item_card_categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.item_card_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\ItemCardCategoryStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemCardCategoryStoreRequest $request)
    {
        ItemCardCategory::create($request->validated());

        return redirect()->route('admin.item-card-categories.index')->with('message', 'تم إضافة الفئة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemCardCategory  $itemCardCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ItemCardCategory $itemCardCategory)
    {
        return view('admin.item_card_categories.show', compact('itemCardCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemCardCategory  $itemCardCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemCardCategory $itemCardCategory)
    {
        return view('admin.item_card_categories.edit', compact('itemCardCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\ItemCardCategoryUpdateRequest  $request
     * @param  \App\Models\ItemCardCategory  $itemCardCategory
     * @return \Illuminate\Http\Response
     */
    public function update(ItemCardCategoryUpdateRequest $request, ItemCardCategory $itemCardCategory)
    {
        $itemCardCategory->update($request->validated());

        return redirect()->route('admin.item-card-categories.index')->with('success', 'تم تحديث الفئة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemCardCategory  $itemCardCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemCardCategory $itemCardCategory)
    {
        $itemCardCategory->delete();

        return redirect()->route('admin.item-card-categories.index')
            ->with('success', 'تم حذف الفئة بنجاح');
    }
}
