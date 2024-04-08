<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{

    public $id = null;
    public string $name = '';
    public string $username = '';
    public string $password = '';
    public bool $is_active = true;

    public function rules()
    {
        return [
            'id' => 'nullable',
            'name' => 'required',
            'username' => ['required', Rule::unique('users', 'username')->ignore($this->id)],
            'password' => [Rule::requiredIf(!$this->id)],
            'is_active' => 'nullable',
        ];
    }

    public function updateOrCreate() {
        $this->validate();
        if($this->password){
            $this->password = bcrypt($this->password);
            User::updateOrCreate(['id'=>$this->id],$this->all());
        }else{
            User::updateOrCreate(['id'=>$this->id],$this->except('password'));
        }
        $this->reset();
    }
}
