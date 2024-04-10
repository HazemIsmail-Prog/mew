@props(
[
    'title' => '---',
    'multipule' => false,
    'list' , 
    'unique_id' => rand(),
])

<div 
    wire:ignore
    x-data="{

        isOpen: false, 
        title: {{ @json_encode($title) }},
        multipule: {{ @json_encode($multipule) }},
        search: null,
        options: {{ @json_encode($list) }},
        currentlySelected: @entangle($attributes->wire('model')),

        setWidth: function() {

            buttonWidth = $refs.button.offsetWidth;
            $refs.dropdownMenu.style.width = buttonWidth + 'px';
            
        },

        setTitle: function() {

            this.options.forEach(option => {

                if(this.multipule){

                    if(this.currentlySelected.length > 0){
                        this.title = this.currentlySelected.length + ' items selected';
                    }else{
                        this.title = {{ @json_encode($title) }};
                    }

                }else{
                    if (option.id == this.currentlySelected) {
                        this.title = option.name;
                    }
                }
            });

        },

        filteredOptions: function() {
            if (!this.search)
                return this.options;
            if (!this.search.trim()) return this.options;
            return this.options.filter(option => {
                return option.name.toLowerCase().includes(this.search.toLowerCase());
            });
        },
        
        selectSingleOption: function(option) {

            if (option) {

                this.currentlySelected = option.id;

                this.setTitle();
    
                this.isOpen = false;

            }

        },

        selectMultipuleOptions: function(option) {
            
            if (option ) {
                if(this.currentlySelected.includes(option.id)){
                    this.currentlySelected.splice(this.currentlySelected.indexOf(option.id), 1);
                }else{
                    this.currentlySelected.push(option.id);
                }
            }

            this.setTitle();
            
        },

        handleButtonClick: function() {
            this.isOpen = !this.isOpen;
            this.setWidth();
            this.search = null;
            setTimeout(() => $refs.search.focus(), 50);
        },
    }" 

    x-init="
        setWidth();
        setTitle();
    "
    
    @resize.window = "setWidth"
>
    <button 
        x-ref="button" 
        @click="handleButtonClick"
        {{ $attributes->merge([
            'class' => 'relative w-full border focus:ring-1 focus:outline-none px-3 py-2 text-center flex items-center justify-between 
                        border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'
        ]) }}
        type="button">
        <span class=" truncate" x-text="title"></span>
        <x-svgs.chevron-down />
    </button>

    <!-- Dropdown menu -->
    <div 
        x-ref="dropdownMenu" 
        x-show="isOpen" 
        @click.away="isOpen = false"
        class="border border-gray-300 dark:border-gray-700 absolute min-w-[240px] mt-1 z-10 bg-white rounded-lg shadow-xl dark:bg-gray-900">
        
        <div class="p-3">
        
            <label for="input-group-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <x-svgs.search />
                </div>
                <input x-ref="search" x-model="search" type="text"
                    class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('messages.search') }}">
            </div>
        
        </div>

        <ul class="max-h-[557px] overflow-x-hidden px-3 pb-3 overflow-y-auto text-gray-700 dark:text-gray-200">

            <template 
                x-for="option in filteredOptions" 
                :key="option.id"
            >

                <li>

                    <div
                        class="flex items-center ps-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600"
                        :class="{ 'bg-indigo-600 text-gray-100 hover:text-gray-700 ': option.id == currentlySelected && !multipule }"
                    >
                        @if ($multipule)

                            <input
                                :id="{{ @json_encode($unique_id) }} + option.id"
                                :value="option.id"
                                :checked="currentlySelected.includes(option.id)"
                                @change="selectMultipuleOptions(option)"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                            >
                            <label  
                                :for="{{ @json_encode($unique_id) }} + option.id"
                                class="w-full py-2 ms-2 font-medium truncate " 
                                x-text="option.name"
                            ></label>
                            
                        @else

                            <label 
                                @click="selectSingleOption(option)" 
                                class="w-full py-2 ms-2 font-medium truncate " 
                                x-text="option.name"
                            ></label>

                        @endif

                    </div>

                </li>
            </template>
        </ul>
    </div>
</div>