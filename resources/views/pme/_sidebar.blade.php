@push('sidebar')
    <x-sidebar-link icon="layout-grid" :href="route('pme.dashboard')" :active="request()->routeIs('pme.dashboard')">Tableau de bord</x-sidebar-link>
    <x-sidebar-link icon="briefcase" :href="route('pme.opportunities.index')" :active="request()->routeIs('pme.opportunities.*')">Opportunités</x-sidebar-link>
    <x-sidebar-link icon="graduation" :href="route('pme.trainings.index')" :active="request()->routeIs('pme.trainings.*')">Formations</x-sidebar-link>
    <x-sidebar-link icon="newspaper" :href="route('pme.news.index')" :active="request()->routeIs('pme.news.*')">Actualités SMI</x-sidebar-link>

    <div class="px-3 pt-5 pb-2 text-[10px] uppercase tracking-widest2 text-stone-600 font-display font-semibold">Mon entreprise</div>
    <x-sidebar-link icon="building" :href="route('pme.profile.edit')" :active="request()->routeIs('pme.profile.*')">Profil PME</x-sidebar-link>
@endpush
