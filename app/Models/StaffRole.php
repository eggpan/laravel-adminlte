<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRole extends Model
{
    use HasFactory;

    protected $table = 'staff_roles';

    protected $fillable = [
        'staff_id',
        'role_id',
    ];
}
