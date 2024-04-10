<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Document extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function creator() : BelongsTo {
        return $this->belongsTo(User::class,'created_by');
    }

    public function contract() : BelongsTo {
        return $this->belongsTo(Contract::class);
    }

    public function steps() : HasMany {
        return $this->hasMany(Step::class);
    }

    public function latestStep() : HasOne {
        return $this->hasOne(Step::class)->latestOfMany();
    }

    public function fromStakeholder() : BelongsTo {
        return $this->belongsTo(Stakeholder::class,'from_id');
    }

    public function toStakeholder() : BelongsTo {
        return $this->belongsTo(Stakeholder::class,'to_id');
    }

    public function getFormattedIsCompletedAttribute() {
        return $this->is_completed ? __('messages.is_completed') : __('messages.pending');
    }

}
