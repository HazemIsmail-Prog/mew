<?php

namespace App\Livewire\Forms;

use App\Models\Stakeholder;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StakeholderForm extends Form
{
    public $id = null;
    public string $name = '';
    public bool $is_active = true;

    public function rules()
    {
        return [
            'id' => 'nullable',
            'name' => ['required', Rule::unique('stakeholders', 'name')->ignore($this->id)],
            'is_active' => 'nullable',
        ];
    }

    public function updateOrCreate()
    {
        $this->validate();
        Stakeholder::updateOrCreate(['id' => $this->id], $this->all());
        $this->reset();
    }
}
