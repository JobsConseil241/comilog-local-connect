<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-navy border border-transparent rounded-md font-semibold text-sm text-white shadow-sm hover:bg-navy-dark focus:bg-navy-dark active:bg-navy-dark focus:outline-none focus:ring-2 focus:ring-navy focus:ring-offset-2 transition']) }}>
    {{ $slot }}
</button>
