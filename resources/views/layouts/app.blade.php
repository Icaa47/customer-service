{{-- resources/views/layouts/app.blade.php --}}

<!DOCTYPE html>
<html lang="en">

<head>
    {{-- ... head content ... --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @livewireStyles
    @livewireScripts
</head>

<body class="font-sans antialiased">

    {{-- 1. Inisialisasi Alpine.js di pembungkus paling luar --}}
    <div class="min-h-screen bg-gray-100" x-data="layoutRoot()" x-init="init()"
        @keydown.window.escape="closeOnMobile()">

        {{-- 2. Panggil sidebar yang sudah Anda buat --}}
        @include('layouts.sidebar')

        {{-- 2.a Overlay hanya untuk perangkat mobile --}}
        <div class="fixed inset-0 z-30 bg-gray-900/40 md:hidden" x-cloak
            x-show="$store.layout.sidebarOpen"
            x-transition.opacity
            @click="$store.layout.closeSidebar()">
        </div>

        {{-- 3. Buat wrapper untuk konten utama dengan margin dinamis --}}
        <div class="flex-1 flex flex-col transition-all duration-300"
            :class="mainWrapperClasses()">

            {{-- 4. Panggil navigasi atas --}}

            @include('layouts.navigation')

            @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @endif

            <main>
                {{ $slot }}
            </main>

        </div>
    </div>

    @once
    <script>
        document.addEventListener('alpine:init', () => {
            const mediaQuery = window.matchMedia('(min-width: 768px)');

            Alpine.store('layout', {
                sidebarOpen: mediaQuery.matches,
                toggleSidebar() {
                    this.sidebarOpen = !this.sidebarOpen;
                },
                openSidebar() {
                    this.sidebarOpen = true;
                },
                closeSidebar() {
                    this.sidebarOpen = false;
                },
            });

            Alpine.data('layoutRoot', () => ({
                mediaQuery: null,

                init() {
                    this.mediaQuery = mediaQuery;

                    const syncSidebarState = (event) => {
                        const matches = event?.matches ?? this.mediaQuery.matches;

                        if (matches) {
                            this.$store.layout.openSidebar();
                        } else {
                            this.$store.layout.closeSidebar();
                        }
                    };

                    syncSidebarState();
                    if (typeof this.mediaQuery.addEventListener === 'function') {
                        this.mediaQuery.addEventListener('change', syncSidebarState);
                    } else if (typeof this.mediaQuery.addListener === 'function') {
                        this.mediaQuery.addListener(syncSidebarState);
                    }
                },

                closeOnMobile() {
                    if (this.mediaQuery && !this.mediaQuery.matches) {
                        this.$store.layout.closeSidebar();
                    }
                },

                mainWrapperClasses() {
                    return {
                        'md:ml-64': this.$store.layout.sidebarOpen,
                        'md:ml-0': !this.$store.layout.sidebarOpen,
                    };
                },
            }));
        });
    </script>
    @endonce

</body>

</html>
