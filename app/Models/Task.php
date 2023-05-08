<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\Tappable;

class Task extends Model
{
    use HasFactory,Tappable;

    protected $fillable = [
        'name',
        'priority'
    ];
}
