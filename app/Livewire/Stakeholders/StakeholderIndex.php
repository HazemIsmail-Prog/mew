<?php

namespace App\Livewire\Stakeholders;

use App\Models\Stakeholder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class StakeholderIndex extends Component
{
    use WithPagination;

    #[Computed()]
    #[On('stakeholdersUpdated')]
    public function stakeholders()
    {
        return Stakeholder::query()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.stakeholders.stakeholder-index');
    }
}
