<?php

namespace App\Models;

use App\Traits\HandlesTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasFactory;
    use HandlesTimestamps; // Use the trait

    protected $fillable=[
        'name', 'email', 'username', 'password', 'added_by', 'updated_by', 'company_code'
        ];
}
