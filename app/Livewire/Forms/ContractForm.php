<?php

namespace App\Livewire\Forms;

use App\Models\Contract;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ContractForm extends Form
{
    public $id = null;
    public string $name = '';
    public int | null $contract_id;
    public bool $is_active = true;

    public function rules()
    {
        return [
            'id' => 'nullable',
            'contract_id' => 'nullable',
            'name' => ['required', Rule::unique('contracts', 'name')->ignore($this->id)],
            'is_active' => 'nullable',
        ];
    }

    public function updateOrCreate()
    {
        $this->validate();
        Contract::updateOrCreate(['id' => $this->id], $this->all());
        $this->reset();
    }
}
