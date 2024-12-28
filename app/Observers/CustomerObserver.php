<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\Customer;
use App\Models\Setting;

class CustomerObserver
{
    /**
     * Handle the Customer "created" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function created(Customer $customer)
    {
        // dd(Account::where('name', 'عميل')->value('id'));
        Account::create([
            'name' => $customer->name,
            'account_type_id' => AccountType::where('name', 'عميل')->value('id'),
            'parent_account_number' => Setting::where('company_code', auth()->user()->company_code)->value('customer_parent_account_number'),
            'account_number' => $customer->account_number,
            'start_balance_status' => $customer->start_balance_status,
            'start_balance' => $customer->start_balance,
            'current_balance' => $customer->current_balance,
            'other_table_FK' => $customer->id,
            'notes' => $customer->notes,
            'added_by' => $customer->added_by,
            'company_code' => $customer->company_code,
            'date' => $customer->date,
            'active' => $customer->active,
            'is_parent' => '0',
        ]);
    }

    /**
     * Handle the Customer "updated" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function updated(Customer $customer)
    {
        $account = Account::where('other_table_FK', $customer->id)->first();
        $account->update([
            'name' => $customer->name,
            'active' => $customer->active,
            'notes' => $customer->notes,
            'updated_by' => $customer->updated_by,
        ]);
    }

    /**
     * Handle the Customer "deleted" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function deleted(Customer $customer)
    {
        //
    }

    /**
     * Handle the Customer "restored" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function restored(Customer $customer)
    {
        //
    }

    /**
     * Handle the Customer "force deleted" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function forceDeleted(Customer $customer)
    {
        //
    }
}
