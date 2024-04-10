<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contract extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Contract::class,'contract_id');
    }

    public function childs(): HasMany
    {
        return $this->hasMany(Contract::class,'contract_id');
    }

    public function getFormattedActiveAttribute()
    {
        return $this->is_active ? __('messages.active') : __('messages.inactive');
    }
}
