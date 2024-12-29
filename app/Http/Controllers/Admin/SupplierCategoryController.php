<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SupplierCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SupplierCategoryStoreRequest;
use App\Http\Requests\Admin\SupplierCategoryUpdateRequest;

class SupplierCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SupplierCategory::with('creator', 'updater')->where('company_code', auth()->user()->company_code)->latest()->get();
        return view('admin.supplier_categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierCategoryStoreRequest $request)
    {
        SupplierCategory::create($request->validated());

        return redirect()->route('admin.supplier-categories.index')->with('message', 'تم إضافة الفئة بنجاح');
    }

    /**
     * Show the specified resource.
     *
     * @param  \App\Models\SupplierCategory  $supplierCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierCategory $supplierCategory)
    {
        // Add logic if necessary
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierCategory  $supplierCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierCategory $supplierCategory)
    {
        return view('admin.supplier_categories.edit', compact('supplierCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierCategory  $supplierCategory
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierCategoryUpdateRequest $request, SupplierCategory $supplierCategory)
    {
        $supplierCategory->update($request->validated());

        return redirect()->route('admin.supplier-categories.index')->with('success', 'تم تحديث الفئة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierCategory  $supplierCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierCategory $supplierCategory)
    {
        $supplierCategory->delete();

        return redirect()->route('admin.supplier-categories.index')
            ->with('success', 'تم حذف الفئة بنجاح');
    }
}
