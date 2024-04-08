<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    #[Computed()]
    #[On('usersUpdated')]
    public function users()
    {
        return User::query()
            ->paginate(10);
    }
    public function render()
    {
        return view('livewire.users.user-index');
    }
}
