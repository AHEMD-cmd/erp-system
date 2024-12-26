<?php

namespace App\Http\Controllers\Admin;

use App\Models\Uom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UomStoreRequest;
use App\Http\Requests\Admin\UomUpdateRequest;

class UomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check if it's an AJAX request
        if ($request->ajax()) {
            $search = $request->input('search');
            $isMaster = $request->input('is_master'); // Get the 'is_master' filter if provided
    
            // Query with optional search and is_master filter
            $query = Uom::query();
    
            if ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }
    
            if ($isMaster !== null) {  // Check if 'is_master' filter is provided
                $query->where('is_master', $isMaster);
            }
    
            $data = $query->orderby('id', 'DESC')->paginate(PAGINATION_COUNT);
    
            // Return the data as a JSON response
            return response()->json([
                'html' => view('admin.uoms._table', ['data' => $data])->render(),
            ]);
        }
    
        // Regular request (non-AJAX)
        $data = Uom::with('creator', 'updater')->orderby('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.uoms.index', ['data' => $data]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.uoms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UomStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UomStoreRequest $request)
    {
        Uom::create($request->validated());

        return redirect()->route('admin.uoms.index')->with('message', 'تم اضافة وحدة القياس بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Uom  $uom
     * @return \Illuminate\Http\Response
     */
    public function show(Uom $uom)
    {
        return view('admin.uoms.show', compact('uom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Uom  $uom
     * @return \Illuminate\Http\Response
     */
    public function edit(Uom $uom)
    {
        return view('admin.uoms.edit', compact('uom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Uom  $uom
     * @param  \App\Http\Requests\Admin\UomUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Uom $uom, UomUpdateRequest $request)
    {
        $uom->update($request->validated());

        return redirect()->route('admin.uoms.index')->with('message', 'تم تعديل وحدة القياس بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Uom  $uom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Uom $uom)
    {
        $uom->delete();
        return redirect()->route('admin.uoms.index');
    }
}
