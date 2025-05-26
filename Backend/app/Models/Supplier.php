<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'id',
        'name',
        'contact_email',
        'phone_number',
        'address'
    ];
}
