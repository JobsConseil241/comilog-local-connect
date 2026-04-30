@props(['href', 'active' => false, 'icon' => null])

<a href="{{ $href }}"
   @class([
       'group relative flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition-all duration-150',
       'bg-white/[0.08] text-white shadow-inner-glow' => $active,
       'text-stone-400 hover:bg-white/[0.04] hover:text-white' => !$active,
   ])>
    @if($active)
        <span class="absolute left-0 top-2 bottom-2 w-0.5 rounded-r bg-bronze-500"></span>
    @endif
    @if($icon)
        <x-icon :name="$icon" :size="18" :class="$active ? 'text-bronze-400' : 'text-stone-500 group-hover:text-stone-300'" />
    @endif
    <span>{{ $slot }}</span>
</a>
