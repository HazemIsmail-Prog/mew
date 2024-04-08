<?php

namespace App\Livewire\Contracts;

use App\Livewire\Forms\ContractForm as FormsContractForm;
use App\Models\Contract;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class ContractForm extends Component
{
    public Contract $contract;
    public bool $showModal = false;
    public string $modalName = 'contract-form';
    public string $modalTitle;
    public FormsContractForm $form;

    #[Computed()]
    public function contracts()
    {
        return Contract::query()->select('id', 'name')->get();
    }

    #[On('showContractForm')]
    public function show(Contract $contract)
    {
        $this->resetErrorBag();
        $this->form->reset();
        $this->contract = $contract;
        $this->form->fill($this->contract);
        $this->modalTitle = $contract->id ? __('messages.edit_contract') : __('messages.add_contract');
        $this->showModal = true;
    }

    public function save()
    {
        $this->form->updateOrCreate();
        $this->dispatch('contractsUpdated');
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.contracts.contract-form');
    }
}
