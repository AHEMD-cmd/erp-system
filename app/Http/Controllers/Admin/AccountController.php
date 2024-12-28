<?php

namespace App\Http\Controllers\Admin;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccountStoreRequest;
use App\Http\Requests\Admin\AccountUpdateRequest;
use App\Models\AccountType;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $accountTypes = AccountType::select('id', 'name')->where(['active' => 1, 'related_to_internal_accounts' => 0])->get();

        if ($request->ajax()) {
            // Get filter inputs
            $searchBy = $request->input('searchbyradio');
            $searchText = $request->input('search_by_text');
            $accountTypeId = $request->input('account_type_id');
            $isParent = $request->input('is_parent');
            $active = $request->input('active');

            // Build the query
            $query = Account::with('accountType', 'parent')->where('company_code', auth()->user()->company_code);

            // Apply search filters
            if ($searchText) {
                if ($searchBy === 'account_number') {
                    $query->where('account_number', 'like', '%' . $searchText . '%');
                } elseif ($searchBy === 'name') {
                    $query->where('name', 'like', '%' . $searchText . '%');
                }
            }

            // Apply account type filter
            if ($accountTypeId && $accountTypeId !== 'all') {
                $query->where('account_type_id', $accountTypeId);
            }

            // Apply parent account filter
            if ($isParent !== null && $isParent !== 'all') {
                $query->where('is_parent', $isParent);
            }

            // Apply active status filter
            if ($active !== null && $active !== 'all') {
                $query->where('active', $active);
            }

            // Paginate the results
            $data = $query->latest()->paginate(PAGINATION_COUNT);

            // Return the filtered data as JSON
            return response()->json([
                'html' => view('admin.accounts._table', compact('data', 'accountTypes'))->render(),
            ]);
        }

        // Regular request (non-AJAX)
        $data = Account::with('accountType', 'parent')
            ->where('company_code', auth()->user()->company_code)
            ->latest()
            ->paginate(PAGINATION_COUNT);

        return view('admin.accounts.index', compact('data', 'accountTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accountTypes = AccountType::select('id', 'name')->where(['active' => 1, 'related_to_internal_accounts' => 0])->get();
        $parentAccounts = Account::select('account_number', 'name')->where(['is_parent' => 1, 'company_code' => auth()->user()->company_code])->get();

        return view('admin.accounts.create', compact('accountTypes', 'parentAccounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountStoreRequest $request)
    {
        Account::create($request->validated());
        return redirect()->route('admin.accounts.index')->with('messages', 'تم حفظ الحساب بنجاح');
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
        $account = Account::where(['id' => $id, 'company_code' => auth()->user()->company_code])->first();
        if (!$account) {
            return redirect()->route('admin.accounts.index');
        }
        $accountTypes = AccountType::select('id', 'name')->where(['active' => 1, 'related_to_internal_accounts' => 0])->get();
        $parentAccounts = Account::select('account_number', 'name')->where(['is_parent' => 1, 'company_code' => auth()->user()->company_code])->get();

        return view('admin.accounts.edit', compact('account', 'accountTypes', 'parentAccounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountUpdateRequest $request, $id)
    {
        $account = Account::where(['id' => $id, 'company_code' => auth()->user()->company_code])->first();
        if (!$account) {
            return redirect()->route('admin.accounts.index');
        }
        $account->update($request->validated());
        return redirect()->route('admin.accounts.index')->with('messages', 'تم تعديل الحساب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::where(['id' => $id, 'company_code' => auth()->user()->company_code])->first();
        if (!$account) {
            return redirect()->route('admin.accounts.index');
        }
        $account->delete();
        return redirect()->route('admin.accounts.index')->with('messages', 'تم تعديل الحساب بنجاح');
    }
}
