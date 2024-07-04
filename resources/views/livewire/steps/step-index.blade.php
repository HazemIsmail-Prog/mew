<div class=" border dark:border-gray-700 rounded-lg p-3 space-y-2">

    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('messages.steps') }}
    </h2>

    {{-- Steps --}}
    <div class=" text-xs divide-y dark:divide-gray-700">
        @foreach ($this->steps as $step)
            <div wire:key="{{ rand() }}" x-data class="flex items-center gap-5 py-2">
                <div>{{ $loop->iteration }}</div>
                <div @class([
                    'flex-1',
                    'text-green-700 dark:text-green-400' => $step->is_completed,
                    'text-red-500 dark:text-red-400' => !$step->is_completed,
                ])>
                    {{-- <div>{{ $step->user->name }}</div> --}}
                    <div>{{ $step->action }}</div>
                </div>
                {{-- Is Completed --}}
                <label class="inline-flex items-center cursor-pointer">
                    <input id="is_completed-{{ $step->id }}" @checked($step->is_completed) {{-- x-model="is_completed_{{ $loop->index }}" --}}
                        @change="$wire.setCompleted($event.target.checked, {{ $step }})" type="checkbox"
                        class="sr-only peer">
                    <div
                        class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                </label>
                <svg wire:click="delete({{ $step }})" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5 text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </div>
        @endforeach
    </div>

    {{-- Form --}}
    <div class="flex items-center gap-1">
        {{-- Action User --}}
        {{-- <div class=" flex-1">
            <x-searchable-select class="!py-1" id="to" :list="$this->users" wire:model="user_id" />
            <x-input-error :messages="$errors->get('user_id')" />
        </div> --}}

        {{-- Action --}}
        <div class=" flex-1">
            <x-text-input x-data @keydown.enter="$wire.save_step" list='datalist' class="py-1" wire:model="action" id="action"
                placeholder="{{ __('messages.action') }}" />
            <x-input-error :messages="$errors->get('action')" />
                <datalist id="datalist">
                    <option value="تم الاستلام من">تم الاستلام من</option>
                    <option value="م. مصطفى للمراجعة">م. مصطفى للمراجعة</option>
                    <option value="المراقب للاعتماد">المراقب للاعتماد</option>
                    <option value="المراقب للتحويل">المراقب للتحويل</option>
                    <option value="علي لاعتماد المدير">علي لاعتماد المدير</option>
                </datalist>
        </div>

        <x-primary-button type="button" wire:click="save_step">{{ __('messages.save') }}</x-primary-button>

    </div>

</div>
