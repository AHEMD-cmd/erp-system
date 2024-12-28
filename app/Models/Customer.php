<?php

namespace App\Models;

use App\Traits\HandlesTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, HandlesTimestamps;

    protected $fillable = [
        'name',

        'account_number',
        'customer_code',
        
        'start_balance_status',
        'start_balance',
        'current_balance',
        
        'notes',
        'phone',
        'address',
        
        'added_by',
        'updated_by',
        
        'company_code',
        'date',
        'active',
    ];

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
