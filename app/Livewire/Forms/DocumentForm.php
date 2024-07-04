<?php

namespace App\Livewire\Forms;

use App\Models\Document;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DocumentForm extends Form
{
    public $id;
    public bool $is_completed = false;
    public $type;
    public $created_by;
    public $contract_id;
    public $from_id;
    public $to_id;
    public $title;
    public $content;
    public $notes;
    public $ref;
    public $date;
    public $hyperlink;

    public function rules()
    {
        return [
            'id' => 'nullable',
            'type' => 'required|string',
            'is_completed' => 'nullable',
            // 'created_by' => 'required_if:type,outgoing',
            'contract_id' => 'required',
            'from_id' => 'required',
            'to_id' => 'required',
            'title' => 'required',
            'ref' => 'nullable',
            'date' => 'nullable',
            'content' => 'nullable',
            'hyperlink' => 'nullable',
            'notes' => 'nullable',
        ];
    }

    public function updateOrCreate()
    {
        $this->validate();

        // if ($this->type == 'incoming') {
        $this->created_by = auth()->id();
        // }

        Document::updateOrCreate(['id' => $this->id], $this->all());
        $this->reset();
    }
}
