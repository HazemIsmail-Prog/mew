<?php

namespace App\Livewire\Stakeholders;

use App\Livewire\Forms\StakeholderForm as FormsStakeholderForm;
use App\Models\Stakeholder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class StakeholderForm extends Component
{
    public Stakeholder $stakeholder;
    public bool $showModal = false;
    public string $modalName = 'stakeholder-form';
    public string $modalTitle;
    public FormsStakeholderForm $form;

    #[On('showStakeholderForm')]
    public function show(Stakeholder $stakeholder)
    {
        $this->resetErrorBag();
        $this->form->reset();
        $this->stakeholder = $stakeholder;
        $this->form->fill($this->stakeholder);
        $this->modalTitle = $stakeholder->id ? __('messages.edit_stakeholder') : __('messages.add_stakeholder');
        $this->showModal = true;
    }


    public function updatedShowModal($val)
    {
        if ($val == false) {
            $this->reset('stakeholder');
        }
    }

    public function save()
    {
        $this->form->updateOrCreate();
        $this->dispatch('stakeholdersUpdated');
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.stakeholders.stakeholder-form');
    }
}
