<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerStoreRequest;
use App\Http\Requests\Admin\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Customer::with('creator', 'updater')
            ->where('company_code', auth()->user()->company_code);

        // Apply search filters if any
        if ($request->has('searchbyradio') && $request->has('search_by_text')) {
            $searchBy = $request->input('searchbyradio');
            $searchText = $request->input('search_by_text');

            if ($searchBy === 'customer_code') {
                $query->where('customer_code', 'like', '%' . $searchText . '%');
            } elseif ($searchBy === 'account_number') {
                $query->where('account_number', 'like', '%' . $searchText . '%');
            } elseif ($searchBy === 'name') {
                $query->where('name', 'like', '%' . $searchText . '%');
            }
        }

        // Paginate the results
        $data = $query->latest()->paginate(PAGINATION_COUNT);

        if ($request->ajax()) {
            // Return filtered data as JSON
            return response()->json([
                'html' => view('admin.customers._table', compact('data'))->render(),
            ]);
        }

        // Return view for normal requests
        return view('admin.customers.index', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        Customer::create($request->validated());
        return redirect()->route('admin.customers.index')->with('messages', 'تم حفظ العميل بنجاح');
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
    public function edit($id)
    {
        $customer = Customer::where(['id' => $id, 'company_code' => auth()->user()->company_code])->firstOrFail();
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdateRequest $request, $id)
    {
        $customer = Customer::where(['id' => $id, 'company_code' => auth()->user()->company_code])->firstOrFail();
        $customer->update($request->validated());
        return redirect()->route('admin.customers.index')->with('messages', 'تم تعديل بيانات العميل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::where(['id' => $id, 'company_code' => auth()->user()->company_code])->firstOrFail();
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('messages', 'تم حذف بيانات العميل بنجاح');
    }
}
