<?php

namespace App\Models;

use App\Traits\HandlesTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory, HandlesTimestamps;

    protected $fillable = [
        'system_name',
        'photo',
        'active',
        'general_alert',
        'address',
        'phone',
        'added_by',
        'updated_by',
        'company_code',
        'customer_parent_account_number',
    ];

   

    public function getPhotoAttribute($value)
    {
        return $value ? 'storage/' . $value : null;
    }

    public function setPhotoAttribute($value)
    {
        // Check if there is an existing photo and delete it
        if (!empty($this->attributes['photo']) && Storage::disk('public')->exists($this->attributes['photo'])) {
            Storage::disk('public')->delete($this->attributes['photo']);
        }

        // Save the new photo path
        $this->attributes['photo'] = $value;
    }

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
}
