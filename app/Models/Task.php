<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use Illuminate\Support\Traits\Tappable;

class Task extends Model
{
    use Tappable;

    protected $fillable = [
        'name',
        'priority'
    ];
}


