@push('sidebar')
    <div class="px-3 pb-2 text-[10px] uppercase tracking-widest2 text-stone-600 font-display font-semibold">Pilotage</div>
    <x-sidebar-link icon="trending-up" :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">KPI &amp; Insights</x-sidebar-link>

    <div class="px-3 pt-5 pb-2 text-[10px] uppercase tracking-widest2 text-stone-600 font-display font-semibold">Communauté</div>
    <x-sidebar-link icon="users" :href="route('admin.pmes.index')" :active="request()->routeIs('admin.pmes.*')">PME inscrites</x-sidebar-link>
    <x-sidebar-link icon="tag" :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">Catégories métier</x-sidebar-link>

    <div class="px-3 pt-5 pb-2 text-[10px] uppercase tracking-widest2 text-stone-600 font-display font-semibold">Publications</div>
    <x-sidebar-link icon="briefcase" :href="route('admin.opportunities.index')" :active="request()->routeIs('admin.opportunities.*')">Opportunités</x-sidebar-link>
    <x-sidebar-link icon="graduation" :href="route('admin.trainings.index')" :active="request()->routeIs('admin.trainings.*')">Formations</x-sidebar-link>
    <x-sidebar-link icon="newspaper" :href="route('admin.news.index')" :active="request()->routeIs('admin.news.*')">Actualités SMI</x-sidebar-link>
@endpush
