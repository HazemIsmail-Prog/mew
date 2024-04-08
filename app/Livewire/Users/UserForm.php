<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\UserForm as FormsUserForm;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserForm extends Component
{
    public User $user;
    public bool $showModal = false;
    public string $modalName = 'user-form';
    public string $modalTitle;
    public FormsUserForm $form;

    #[On('showUserForm')]
    public function show(User $user) {
        $this->resetErrorBag();
        $this->form->reset();
        $this->user = $user;
        $this->form->fill($this->user);
        $this->modalTitle = $user->id ? __('messages.edit_user'):__('messages.add_user');
        $this->showModal = true;
    }

    public function save() {
        $this->form->updateOrCreate();
        $this->dispatch('usersUpdated');
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.users.user-form');
    }
}
