    <div>
        <x-side-modal maxWidth="xl" :name="$modalName" wire:model.live="showModal">

            <div class="p-6">

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ $modalTitle }}
                </h2>

                <x-divider />

                @if ($showModal)
                    <form wire:submit="save" class="space-y-4">

                        @if ($document->id)
                            @livewire('steps.step-index', ['document' => $document], key($document->id))
                        @endif

                        {{-- Is Completed --}}
                        <div>
                            <label class="inline-flex items-center cursor-pointer">
                                <input wire:model="form.is_completed" type="checkbox" class="sr-only peer">
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                                <span
                                    class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('messages.is_completed') }}</span>
                            </label>
                            <x-input-error :messages="$errors->get('form.is_completed')" />
                        </div>

                        {{-- Type --}}
                        <div>
                            <x-input-label required for="incoming" value="{{ __('messages.type') }}" />
                            <div class=" flex items-center gap-4">
                                <div class="flex items-center">
                                    <input wire:model.live="form.type" id="incoming" type="radio" value="incoming"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="incoming"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('messages.incoming') }}</label>
                                </div>
                                <div class="flex items-center">
                                    <input wire:model.live="form.type" id="outgoing" type="radio" value="outgoing"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="outgoing"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('messages.outgoing') }}</label>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('form.type')" />
                        </div>

                        {{-- Creator --}}
                        @if ($form->type == 'outgoing')
                            <div>
                                <x-input-label required for="creator" value="{{ __('messages.creator') }}" />
                                <x-select wire:model="form.created_by" id="creator">
                                    <option value="">---</option>
                                    @foreach ($this->creators as $creator)
                                        <option value="{{ $creator->id }}">{{ $creator->name }}</option>
                                    @endforeach
                                </x-select>
                                <x-input-error :messages="$errors->get('form.created_by')" />
                            </div>
                        @endif

                        {{-- From --}}
                        <div>
                            <x-input-label required for="from" value="{{ __('messages.from') }}" />
                            <x-select wire:model="form.from_id" id="from">
                                <option value="">---</option>
                                @foreach ($this->stakeholders as $stakeholder)
                                    <option value="{{ $stakeholder->id }}">{{ $stakeholder->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error :messages="$errors->get('form.from_id')" />
                        </div>

                        {{-- To --}}
                        <div>
                            <x-input-label required for="to" value="{{ __('messages.to') }}" />
                            <x-select wire:model="form.to_id" id="to">
                                <option value="">---</option>
                                @foreach ($this->stakeholders as $stakeholder)
                                    <option value="{{ $stakeholder->id }}">{{ $stakeholder->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error :messages="$errors->get('form.to_id')" />
                        </div>

                        {{-- Contract --}}
                        <div>
                            <x-input-label required for="contract" value="{{ __('messages.contract') }}" />
                            <x-select wire:model="form.contract_id" id="contract">
                                <option value="">---</option>
                                @foreach ($this->contracts as $contract)
                                    <option class="truncate" value="{{ $contract->id }}">{{ $contract->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error :messages="$errors->get('form.contract_id')" />
                        </div>

                        {{-- Title --}}
                        <div>
                            <x-input-label required for="title" value="{{ __('messages.title') }}" />
                            <x-textarea wire:model="form.title" id="title" rows="2"></x-textarea>
                            <x-input-error :messages="$errors->get('form.title')" />
                        </div>

                        {{-- Content --}}
                        <div>
                            <x-input-label for="content" value="{{ __('messages.content') }}" />
                            <x-textarea wire:model="form.content" id="content" rows="2"></x-textarea>
                            <x-input-error :messages="$errors->get('form.content')" />
                        </div>

                        {{-- Notes --}}
                        <div>
                            <x-input-label for="notes" value="{{ __('messages.notes') }}" />
                            <x-textarea wire:model="form.notes" id="notes" rows="2"></x-textarea>
                            <x-input-error :messages="$errors->get('form.notes')" />
                        </div>

                        {{-- ref --}}
                        <div>
                            <x-input-label for="ref" value="{{ __('messages.ref') }}" />
                            <x-text-input wire:model="form.ref" id="ref" />
                            <x-input-error :messages="$errors->get('form.ref')" />
                        </div>

                        {{-- date --}}
                        <div>
                            <x-input-label for="date" value="{{ __('messages.date') }}" />
                            <x-text-input wire:model="form.date" id="date" type="date" />
                            <x-input-error :messages="$errors->get('form.date')" />
                        </div>

                        {{-- hyperlink --}}
                        <div>
                            <x-input-label for="hyperlink" value="{{ __('messages.hyperlink') }}" />
                            <x-text-input wire:model="form.hyperlink" id="hyperlink" />
                            <x-input-error :messages="$errors->get('form.hyperlink')" />
                        </div>


                        <x-divider />

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

        </x-side-modal>
    </div>
