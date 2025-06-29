<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ Add this
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory; // ✅ Required for factory() to work

    protected $fillable = ['user_id', 'bio', 'phone'];
}

