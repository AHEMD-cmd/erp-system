<?php

namespace App\Models;

use App\Traits\HandlesTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    use HasFactory, HandlesTimestamps;

    protected $fillable=['name', 'active', 'related_to_internal_accounts'];
}
