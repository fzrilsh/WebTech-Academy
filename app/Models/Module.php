<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Module extends Model
{
    protected $fillable = [
        'name',
        'category',
        'summary',
        'media_path',
        'exercise_path',
        'marking_path',
        'publisher_id',
    ];

    protected $appends = ['marking', 'tasks', 'attempts'];

    public function Publisher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }

    public function Marking(): HasOne
    {
        return $this->hasOne(ModuleMarking::class);
    }

    public function Tasks(): HasMany
    {
        return $this->hasMany(ModuleTask::class);
    }

    public function getMarkingAttribute()
    {
        return $this->Marking()->first();
    }

    public function getTasksAttribute()
    {
        return $this->Tasks()->get();
    }

    public function getAttemptsAttribute()
    {
        return $this->Tasks()->get()->count();
    }
}
