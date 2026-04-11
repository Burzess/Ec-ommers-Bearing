<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex w-full justify-center rounded-xl bg-red-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 transition-all duration-200']) }}>
    {{ $slot }}
</button>
