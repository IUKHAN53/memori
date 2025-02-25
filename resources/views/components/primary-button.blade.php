<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-custom-500 hover:bg-custom-800 font-bold py-2 px-4 rounded inline-flex items-center text-white gap-2'])}}>
    {{ $slot }}
</button>
