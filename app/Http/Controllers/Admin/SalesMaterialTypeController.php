<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SalesMaterialType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SalesMaterialTypeStoreRequest;
use App\Http\Requests\Admin\SalesMaterialTypeUpdateRequest;

class SalesMaterialTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SalesMaterialType::with('creator', 'updater')->latest()->get();
        return view('admin.sales_material_types.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sales_material_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalesMaterialTypeStoreRequest $request)
    {
        SalesMaterialType::create($request->validated());

        return redirect()->route('admin.sales-material-types.index')->with('message', 'تم اضافة الفئة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // In your SalesMaterialTypeController

    public function edit(SalesMaterialType $salesMaterialType)
    {
        return view('admin.sales_material_types.edit', compact('salesMaterialType'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalesMaterialTypeUpdateRequest $request, SalesMaterialType $salesMaterialType)
    {

        $salesMaterialType->update($request->validated());

        return redirect()->route('admin.sales-material-types.index')->with('success', 'تم تحديث فئة الفواتير بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesMaterialType $salesMaterialType)
    {
        $salesMaterialType->delete();

        return redirect()->route('admin.sales-material-types.index')
            ->with('success', 'فئة الفواتير تم حذفها بنجاح');
    }
}
