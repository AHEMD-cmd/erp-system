<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Treasury;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TreasuryStoreRequest;
use App\Http\Requests\Admin\TreasuryUpdateRequest;

class TreasuryContoller extends Controller
{
    public function index(Request $request)
    {
        // Check if it's an AJAX request
        if ($request->ajax()) {
            $search = $request->input('search');

            // Query with optional search
            $data = Treasury::where('name', 'like', '%' . $search . '%')
                ->orderby('id', 'DESC')
                ->paginate(PAGINATION_COUNT);

            // Return the data as a JSON response
            return response()->json([
                'html' => view('admin.treasuries._table', ['data' => $data])->render(),
            ]);
        }

        // Regular request (non-AJAX)
        $data = Treasury::orderby('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.treasuries.index', ['data' => $data]);
    }


    public function create()
    {
        $treasuries = Treasury::select('id', 'name')->where(['company_code'=> auth()->user()->company_code, 'is_master' => 1])->get();
        return view('admin.treasuries.create', compact('treasuries'));
    }

    public function store(TreasuryStoreRequest $request)
    {
        Treasury::create($request->validated());

        return redirect()->route('admin.treasuries.index')->with('message', 'تم اضافة الخزنة بنجاح');
    }

    public function show(Treasury $treasury)
    {
        $treasury->load('subTreasuries');

        return view('admin.treasuries.show', compact('treasury'));
    }

    public function edit(Treasury $treasury)
    {
        $treasuries = Treasury::select('id', 'name')->where(['company_code'=> auth()->user()->company_code, 'is_master' => 1])->get();
        return view('admin.treasuries.edit', compact('treasury', 'treasuries'));
    }

    public function update(Treasury $treasury,  TreasuryUpdateRequest $request)
    {
        $treasury->update($request->validated());

        return redirect()->route('admin.treasuries.index')->with('message', 'تم تعديل الخزنة بنجاح');
    }

    public function destroy(Treasury $treasury)
    {
        $treasury->delete();
        return redirect()->route('admin.treasuries.show', $treasury->parent_id);
    }
    
}
