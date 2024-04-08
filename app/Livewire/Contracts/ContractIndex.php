<?php

namespace App\Livewire\Contracts;

use App\Models\Contract;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ContractIndex extends Component
{
    use WithPagination;

    #[Computed()]
    #[On('contractsUpdated')]
    public function contracts()
    {
        return Contract::query()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.contracts.contract-index');
    }
}
