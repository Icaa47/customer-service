<aside class="fixed inset-y-0 left-0 z-40 w-64 h-screen bg-white text-gray-700 flex flex-col"
    x-show="$store.layout.sidebarOpen" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full" @click.away="closeOnMobile()" x-cloak>

    <div class="h-16 flex flex-col items-center justify-center border-b border-navy-700">
        <h1 class="text-sm font-bold">Customer Service</h1>
        <img src="{{ asset('images/customer-support.png') }}" alt="Logo" class="h-10 ml-2">
    </div>

    <nav class="flex-1 px-4 py-4 space-y-2">
        <a href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-2 rounded-md hover:bg-navy-700 hover:text-white {{ request()->routeIs('dashboard') ? 'bg-navy-700 text-white' : '' }}">
            <x-icons.dashboard />
            Overview
        </a>
        <a href="{{ route('akun-cs.index') }}"
            class="flex items-center px-4 py-2 rounded-md hover:bg-navy-700 hover:text-white {{ request()->routeIs('akun-cs.*') ? 'bg-navy-700 text-white' : '' }}">
            <x-icons.users />
            Akun CS
        </a>
        <a href="{{ route('rekapan.index') }}"
            class="flex items-center px-4 py-2 rounded-md hover:bg-navy-700 hover:text-white {{ request()->routeIs('rekapan.index') ? 'bg-navy-700 text-white' : '' }}">
            <x-icons.clipboard-list />
            Rekapan
        </a>

    </nav>
    <div class="px-4 py-4">
        <a href="{{ route('pengaturan.index') }}"
            class="flex items-center px-4 py-2 rounded-md hover:bg-navy-700 hover:text-white {{ request()->routeIs('pengaturan.index') ? 'bg-navy-700 text-white' : '' }}">
            <x-icons.settings />
            Pengaturan
        </a>
    </div>

</aside>
