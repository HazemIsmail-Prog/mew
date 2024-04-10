<?php

namespace App\Livewire\Documents;

use App\Livewire\Forms\DocumentForm as FormsDocumentForm;
use App\Models\Contract;
use App\Models\Document;
use App\Models\Stakeholder;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class DocumentForm extends Component
{
    public Document $document;
    public bool $showModal = false;
    public string $modalName = 'document-form';
    public string $modalTitle;
    public FormsDocumentForm $form;

    #[Computed()]
    public function stakeholders()
    {
        return Stakeholder::query()->select('id', 'name')->orderBy('name')->get();
    }

    #[Computed()]
    public function contracts()
    {
        return Contract::query()
            ->whereDoesntHave('childs')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
    }

    #[Computed()]
    public function creators()
    {
        return User::query()->select('id', 'name')->orderBy('name')->get();
    }

    public function updatedShowModal($val)
    {
        if ($val == false) {
            $this->reset('document');
        }
    }

    #[On('showDocumentForm')]
    public function show(Document $document)
    {
        $this->resetErrorBag();
        $this->form->reset();
        $this->document = $document;
        $this->form->fill($this->document);
        $this->modalTitle = $document->id ? __('messages.edit_document') : __('messages.add_document');
        $this->showModal = true;
    }

    public function save()
    {
        $this->form->updateOrCreate();
        $this->dispatch('documentsUpdated');
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.documents.document-form');
    }
}
