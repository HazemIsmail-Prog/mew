    <div>
        <x-modal :name="$modalName" wire:model.live="showModal" focusable>

            <div class="p-6">

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ $modalTitle }}
                </h2>

                <hr class="my-3">

                @if ($showModal)
                    <form wire:submit="save" class="space-y-4">

                        <div>
                            <x-input-label for="name" value="{{ __('messages.name') }}" />
                            <x-text-input wire:model="form.name" id="name" type="text" />
                            <x-input-error :messages="$errors->get('form.name')" />
                        </div>

                        <div>
                            <label class="inline-flex items-center cursor-pointer">
                                <input wire:model="form.is_active" type="checkbox" class="sr-only peer">
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                                <span
                                    class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('messages.active') }}</span>
                            </label>
                            <x-input-error :messages="$errors->get('form.is_active')" />
                        </div>

                        <div class="flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('messages.cancel') }}
                            </x-secondary-button>

                            <x-primary-button class="ms-3">
                                {{ __('messages.save') }}
                            </x-primary-button>
                        </div>
                    </form>
                @endif

            </div>

        </x-modal>
    </div>
