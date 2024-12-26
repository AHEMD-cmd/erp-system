<?php

namespace App\Traits;

trait HandlesTimestamps
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->updated_at = null;
        });

        static::updating(function ($model) {
            $model->updated_at = now();
        });
    }
}
