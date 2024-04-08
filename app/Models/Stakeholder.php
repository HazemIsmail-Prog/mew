<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stakeholder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFormattedActiveAttribute()
    {
        return $this->is_active ? __('messages.active') : __('messages.inactive');
    }
}
