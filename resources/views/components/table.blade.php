<div class="relative overflow-x-auto">
    <table {{ $attributes->merge(['class' => 'w-full text-sm text-left rtl:text-right  dark:text-gray-400']) }}>
        {{ $slot }}
    </table>
</div>
