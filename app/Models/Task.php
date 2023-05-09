<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Traits\Tappable;

class Task extends Model
{
    use HasFactory, Tappable;

    protected $fillable = [
        'name',
        'priority'
    ];

    public function project():HasOne
    {

        return $this->hasOne(Project::class);
    }
}
