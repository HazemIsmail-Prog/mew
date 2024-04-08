<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('messages.users') }}
            </h2>
            <div id="add"></div>
        </div>

    </x-slot>

    @livewire('users.user-form')

    @teleport('#add')
        <x-primary-button wire:click="$dispatch('showUserForm')">
            {{ __('messages.add') }}
        </x-primary-button>
    @endteleport

    <x-table>
        <x-thead>
            <tr>
                <x-th>{{ __('messages.name') }}</x-th>
                <x-th>{{ __('messages.username') }}</x-th>
                <x-th>{{ __('messages.status') }}</x-th>
                <x-th></x-th>
            </tr>
        </x-thead>
        <tbody>
            @foreach ($this->users as $user)
                <x-tr>
                    <x-td>{{ $user->name }}</x-td>
                    <x-td>{{ $user->username }}</x-td>
                    <x-td>{{ $user->formatted_active }}</x-td>
                    <x-td>
                        <div class="flex items-center justify-end">
                            <x-primary-button wire:click="$dispatch('showUserForm',{user:{{ $user }}})">
                                {{ __('messages.edit') }}
                            </x-primary-button>
                        </div>
                    </x-td>
                </x-tr>
            @endforeach
        </tbody>
    </x-table>

    <div class="mt-3">{{ $this->users->links() }}</div>

</div>
