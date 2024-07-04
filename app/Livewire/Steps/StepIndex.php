<?php

namespace App\Livewire\Steps;

use App\Models\Document;
use App\Models\Step;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class StepIndex extends Component
{

    public Document $document;

    protected $listeners = [
        'stepsUpdated' => '$refresh',
    ];

    // #[Rule('required')]
    public $user_id;
    #[Rule('required')]
    public $action;

    #[Computed()]
    public function steps()
    {
        return Step::query()
            ->with('user')
            ->where('document_id', $this->document->id)
            ->get();
    }

    // #[Computed()]
    // public function users()
    // {
    //     return User::query()
    //         ->select('id', 'name')
    //         ->orderBy('name')
    //         ->get();
    // }

    public function delete(Step $step)
    {
        $step->delete();
        $this->dispatch('stepsUpdated');
    }

    public function setCompleted($isChecked, Step $step)
    {
        $step->is_completed = $isChecked;
        $step->save();
        $this->dispatch('stepsUpdated');
    }

    public function save_step()
    {
        $this->validate();
        $data = [
            'document_id' => $this->document->id,
            'user_id' => auth()->id(),
            'action' => $this->action,
            'is_completed' => false,
        ];

        Step::create($data);
        $this->reset('user_id', 'action');
        $this->dispatch('stepsUpdated');
    }

    public function render()
    {
        return view('livewire.steps.step-index');
    }
}
