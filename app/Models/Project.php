<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Task;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Project extends Model
{
    use HasFactory;
    protected $guarded = [];

   public function tasks(): HasMany
    {

        return $this->hasMany(Task::class);
    }

    
   /* public static function boot()
    {



        parent::boot();


        static::creating(function ($task, string $project_name) {

            $task->project()->create(['project' => $project_name, 'tasks' => $task->name]);
        });
    }*/

   protected $casts = [
        'tasks' => 'array'
    ];

    /*protected function tasks(): Attribute
{
    return Attribute::make(
        get: fn ($value) => json_decode($value, true),
        set: fn ($value) => json_encode($value),
    );
}*/
}
