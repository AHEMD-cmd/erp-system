<?php

namespace App\Models;

use App\Traits\HandlesTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treasury extends Model
{
    use HasFactory, HandlesTimestamps;
    
    protected $fillable = [
        'name',
        'is_master',
        'active',
        'last_isal_exchange',
        'last_isal_collect',
        'added_by',
        'updated_by',
        'company_code',
        'date',
        'parent_id',
    ];

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function subTreasuries()
    {
        return $this->hasMany(Treasury::class, 'parent_id');
    }

}
