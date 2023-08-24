<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'name', 'slug', 'logo', 'status'];

    public function children(): HasMany
    {
        return $this->hasMany(Service::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'parent_id');
    }
}
