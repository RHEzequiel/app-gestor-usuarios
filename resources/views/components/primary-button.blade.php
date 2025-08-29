<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-indigo-700 focus:outline-none transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
