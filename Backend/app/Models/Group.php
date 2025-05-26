<?php

namespace App\Models;


use Spatie\Permission\Models\Role;

class Group extends Role
{
    protected $fillable = ['name', 'code', 'note', 'created_by', 'guard_name'];
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
