<?php

namespace App\Models;

use App\Traits\HandlesTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory, HandlesTimestamps;

    protected $fillable = [
        'name',
        'account_type_id',
        'parent_account_number',    
        'account_number', //unique per company_code
        'start_balance',
        'current_balance',
        'other_table_FK', // represents the id of the internal tables
        'notes',
        'added_by',
        'updated_by',
        'company_code',
        'date',
        'active',
        'is_parent',
        'start_balance_status',
    ];

    /**
     * Relationship to the account type.
     */
    public function accountType()
    {
        return $this->belongsTo(AccountType::class, 'account_type_id');
    }

    /**
     * Relationship to the parent account.
     */
    public function parent()
    {
        return $this->belongsTo(Account::class, 'parent_account_number', 'id')
            ->where('company_code', auth()->user()->company_code)
            ->withDefault();
    }


    /**
     * Relationship to child accounts.
     */
    public function children()
    {
        return $this->hasMany(Account::class, 'parent_id');
    }

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function setStartBalanceAttribute($value)
    {
        // Check if the status is 'مدين' and ensure the balance is negative
        if ($this->attributes['start_balance_status'] == 'مدين') {
            $this->attributes['start_balance'] = $value * -1;
        }
    }
}
