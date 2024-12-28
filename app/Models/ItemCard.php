<?php

namespace App\Models;

use App\Traits\HandlesTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemCard extends Model
{
    use HasFactory, HandlesTimestamps;

    protected $fillable = [
        //independent fields
        'name',
        'item_type',
        'photo',
        'item_card_category_id',
        'parent_id',
        'item_code',
        'barcode', //
        'has_fixed_price',

        'company_code',
        'date',
        'active',
        'updated_by',
        'added_by',

        'uom_id',
        //dependent fields
        'cost_price',
        'price',
        'nos_gomla_price',
        'gomla_price',

        'does_has_retail_unit',
        //dependent fields
        'retail_uom_id',
        'retail_uom_qty_to_parent',
        'cost_price_retail',
        'price_retail',
        'nos_gomla_price_retail',
        'gomla_price_retail',



        'qty', // in uom
        'qty_retail', // in retail uom
        'all_qty_in_retail', // in retail uom


    ];

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }

    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    /**
     * Get the category of the item card.
     */
    public function category()
    {
        return $this->belongsTo(ItemCardCategory::class, 'item_card_category_id');
    }

    /**
     * Get the parent item card.
     */
    public function parent()
    {
        return $this->belongsTo(ItemCard::class, 'parent_id')->withDefault();
    }

    /**
     * Get the retail unit of measurement.
     */
    public function retailUnit()
    {
        return $this->belongsTo(Uom::class, 'retail_uom_id')->withDefault();
    }

    /**
     * Get the base unit of measurement.
     */
    public function unit()
    {
        return $this->belongsTo(Uom::class, 'uom_id')->withDefault();
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
}
