<?php

namespace App\Models;

use App\Traits\HandlesTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesMaterialType extends Model
{
    use HasFactory, HandlesTimestamps; 
    

    protected $fillable = [
        'name',
        'active',
        'date',
        'company_code',
        'added_by',
        'updated_by'
    ];


    public function creator()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

}
