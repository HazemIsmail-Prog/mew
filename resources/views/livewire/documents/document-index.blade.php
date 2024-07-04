<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('messages.documents') }}
            </h2>
            <div id="add"></div>
        </div>

    </x-slot>

    @livewire('documents.document-form')

    @teleport('#add')
        <x-primary-button wire:click="$dispatch('showDocumentForm')">
            {{ __('messages.add') }}
        </x-primary-button>
    @endteleport

    {{-- Filters --}}
    <div class="grid grid-cols-1 md:grid-cols-7 items-center gap-3 border dark:border-gray-700 rounded-lg p-3 mb-3">
        {{-- Text --}}
        <div class="w-full">
            <x-input-label for="search" value="{{ __('messages.search') }}" />
            <x-text-input wire:model.live="filters.search" id="search" />
        </div>

        {{-- Type --}}
        <div class="w-full">
            <x-input-label for="type" value="{{ __('messages.type') }}" />
            <x-select wire:model.live="filters.type" id="type">
                <option value="">---</option>
                <option value="outgoing">{{ __('messages.outgoing') }}</option>
                <option value="incoming">{{ __('messages.incoming') }}</option>
            </x-select>
        </div>
        {{-- Creator --}}
        <div class="w-full">
            <x-input-label for="creator" value="{{ __('messages.creator') }}" />
            <x-searchable-select id="creator" :list="$this->creators" multipule wire:model.live="filters.created_by" />
        </div>



        {{-- Contract --}}
        <div class="w-full">
            <x-input-label for="contract" value="{{ __('messages.contract') }}" />
            <x-searchable-select id="contract" :list="$this->contracts" multipule wire:model.live="filters.contract_id" />
        </div>

        {{-- From --}}
        <div class="w-full">
            <x-input-label for="from" value="{{ __('messages.from') }}" />
            <x-searchable-select id="from" :list="$this->stakeholders" multipule wire:model.live="filters.from_id" />
        </div>

        {{-- To --}}
        <div class="w-full">
            <x-input-label for="to" value="{{ __('messages.to') }}" />
            <x-searchable-select id="to" :list="$this->stakeholders" multipule wire:model.live="filters.to_id" />
        </div>

        {{-- Status --}}
        <div class="w-full">
            <x-input-label for="status" value="{{ __('messages.status') }}" />
            <x-select wire:model.live="filters.status" id="status">
                <option value="">---</option>
                <option value="completed">{{ __('messages.is_completed') }}</option>
                <option value="pending">{{ __('messages.pending') }}</option>
            </x-select>
        </div>
    </div>

    <x-table>
        <x-thead>
            <tr>
                <x-th>{{ __('messages.type') }}</x-th>
                {{-- <x-th>{{ __('messages.creator') }}</x-th> --}}
                <x-th>{{ __('messages.title') }}</x-th>
                <x-th>{{ __('messages.contract') }}</x-th>
                <x-th>{{ __('messages.from') }}</x-th>
                <x-th>{{ __('messages.to') }}</x-th>
                <x-th>{{ __('messages.latest_step') }}</x-th>
                <x-th>{{ __('messages.status') }}</x-th>
                <x-th></x-th>
            </tr>
        </x-thead>
        <tbody>
            @foreach ($this->documents as $document)
                <x-tr>
                    <x-td>{{ __('messages.' . $document->type) }}</x-td>
                    {{-- <x-td>{{ $document->creator->name ?? '-' }}</x-td> --}}
                    <x-td>{{ $document->title }}</x-td>
                    <x-td>{{ $document->contract->name }}</x-td>
                    <x-td>{{ $document->fromStakeholder->name }}</x-td>
                    <x-td>{{ $document->toStakeholder->name }}</x-td>
                    <x-td>
                        @if ($document->latestStep)
                            <div @class([
                                'text-red-500 dark:text-red-400' => !$document->latestStep->is_completed,
                                'text-green-700 dark:text-green-400' => $document->latestStep->is_completed,
                            ])>
                                {{-- <div>{{ $document->latestStep->user->name }}</div> --}}
                                <div>{{ $document->latestStep->action }}</div>
                            </div>
                        @else
                            <div></div>
                        @endif
                    </x-td>
                    <x-td @class([
                        'text-red-500 dark:text-red-400' => !$document->is_completed,
                        'text-green-700 dark:text-green-400' => $document->is_completed,
                    ])>{{ $document->formatted_is_completed }}</x-td>
                    <x-td>
                        <div class="flex items-center justify-end gap-3">
                            <svg wire:click="$dispatch('showDocumentForm',{document:{{ $document }}})"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                                stroke="currentColor" class="w-6 h-6 text-indigo-500 dark:text-indigo-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            <svg
                                wire:confirm="{{ __('messages.are_you_sure') }}"
                                wire:click="delete({{ $document }})" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                class="w-6 h-6 text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </div>
                    </x-td>
                </x-tr>
            @endforeach
        </tbody>
    </x-table>

    <div class="mt-3">{{ $this->documents->links() }}</div>

</div>
