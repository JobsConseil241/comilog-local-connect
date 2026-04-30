@props(['variant' => 'default'])

@if($variant === 'mark')
    {{-- Just the COMILOG mark for compact use --}}
    <img src="{{ asset('images/comilog-logo.png') }}" alt="COMILOG" {{ $attributes->merge(['class' => 'h-8 w-auto']) }}>
@else
    {{-- Full lockup: COMILOG Local Connect --}}
    <div {{ $attributes->merge(['class' => 'flex items-center gap-3']) }}>
        <img src="{{ asset('images/comilog-logo.png') }}" alt="ERAMET COMILOG" class="h-9 w-auto">
        <span class="h-7 w-px bg-stone-300/80"></span>
        <div class="leading-tight">
            <div class="font-display text-[13px] font-bold text-navy tracking-tightish">Local Connect</div>
            <div class="text-[10px] uppercase tracking-widest2 text-stone-500 -mt-0.5">PME local content</div>
        </div>
    </div>
@endif
