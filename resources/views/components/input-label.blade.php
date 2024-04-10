@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => ' flex items-center mb-1 block font-bold text-sm text-gray-700 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
    @if ($required)
        <div class=" ms-2 mt-2 text-red-500">*</div>
    @endif
</label>
