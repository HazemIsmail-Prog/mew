<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('messages.contracts') }}
            </h2>
            <div id="add"></div>
        </div>

    </x-slot>

    @livewire('contracts.contract-form')

    @teleport('#add')
        <x-primary-button wire:click="$dispatch('showContractForm')">
            {{ __('messages.add') }}
        </x-primary-button>
    @endteleport

    <x-table>
        <x-thead>
            <tr>
                <x-th>{{ __('messages.name') }}</x-th>
                <x-th>{{ __('messages.parent') }}</x-th>
                <x-th>{{ __('messages.status') }}</x-th>
                <x-th></x-th>
            </tr>
        </x-thead>
        <tbody>
            @foreach ($this->contracts as $contract)
                <x-tr>
                    <x-td>{{ $contract->name }}</x-td>
                    <x-td>{{ $contract->parent->name ?? '-' }}</x-td>
                    <x-td>{{ $contract->formatted_active }}</x-td>
                    <x-td>
                        <div class="flex items-center justify-end">
                            <x-primary-button wire:click="$dispatch('showContractForm',{contract:{{ $contract }}})">
                                {{ __('messages.edit') }}
                            </x-primary-button>
                        </div>
                    </x-td>
                </x-tr>
            @endforeach
        </tbody>
    </x-table>

    <div class="mt-3">{{ $this->contracts->links() }}</div>

</div>
