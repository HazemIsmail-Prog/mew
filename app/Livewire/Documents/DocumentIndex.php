<?php

namespace App\Livewire\Documents;

use App\Models\Contract;
use App\Models\Document;
use App\Models\Stakeholder;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class DocumentIndex extends Component
{
    use WithPagination;

    public $filters = [
        'search' => '',
        'type' => '',
        // 'created_by' => [],
        'contract_id' => [],
        'from_id' => [],
        'to_id' => [],
        'status' => '',
    ];

    // #[Computed()]
    // public function creators()
    // {
    //     return User::query()->select('id', 'name')->orderBy('name')->get();
    // }

    #[Computed()]
    public function contracts()
    {
        return Contract::query()->select('id', 'name')->orderBy('name')->get();
    }

    #[Computed()]
    public function stakeholders()
    {
        return Stakeholder::query()->select('id', 'name')->orderBy('name')->get();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    #[Computed()]
    #[On('documentsUpdated')]
    #[On('stepsUpdated')]
    public function documents()
    {
        return Document::query()
            // ->with('creator')
            ->with('contract')
            ->with('fromStakeholder')
            ->with('toStakeholder')
            ->with('latestStep.user')
            ->when($this->filters['search'], function (Builder $q) {
                $q->where(function (Builder $q) {
                    $q->whereAny(
                        [
                            'title',
                            'content',
                            'notes',
                            'ref'
                        ],
                        'LIKE',
                        "%" . $this->filters['search'] . "%"
                    );

                    $q->orWhereRelation('steps', 'action', 'like', "%" . $this->filters['search'] . "%");
                });
            })
            ->when($this->filters['type'], function (Builder $q) {
                $q->where('type', $this->filters['type']);
            })
            // ->when($this->filters['created_by'], function (Builder $q) {
            //     $q->whereIn('created_by', $this->filters['created_by']);
            // })
            ->when($this->filters['contract_id'], function (Builder $q) {
                $q->whereIn('contract_id', $this->filters['contract_id']);
                $q->orWhereHas('contract.parent', function ($query) {
                    $query->whereIn('id', $this->filters['contract_id']);
                });
            })
            ->when($this->filters['from_id'], function (Builder $q) {
                $q->whereIn('from_id', $this->filters['from_id']);
            })
            ->when($this->filters['to_id'], function (Builder $q) {
                $q->whereIn('to_id', $this->filters['to_id']);
            })
            ->when($this->filters['status'], function (Builder $q) {
                $q->where('is_completed', $this->filters['status'] == 'completed');
            })
            ->orderBy('id', 'desc')
            ->orderBy('is_completed')
            ->paginate(10);
    }

    public function delete(Document $document)
    {
        $document->delete();
        $this->dispatch('documentsUpdated');
    }

    public function render()
    {
        return view('livewire.documents.document-index');
    }
}
