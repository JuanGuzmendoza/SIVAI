<nav x-data="{ open: false }" class="bg-green-50 border-b border-green-200">
    <!-- Primary Navigation Menu -->
    <div style="max-width: 80rem; margin: 0 auto; padding: 0 1rem;">
        <div style="display: flex; justify-content: space-between; height: 4rem;">
            <div style="display: flex;">
                <!-- Logo -->
                <div style="display: flex; align-items: center;">
                    <a href="{{ route('dashboard') }}" style="transition: transform 0.2s;">
                        <x-application-logo class="block h-9 w-auto fill-current text-green-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <a href="{{ route('dashboard') }}" class="text-green-600 hover:text-green-800 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-green-100' : '' }}">
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('profesores.index') }}" class="text-green-600 hover:text-green-800 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('profesores.index') ? 'bg-green-100' : '' }}">
                        {{ __('Profesores') }}
                    </a>
                    <a href="{{ route('ambientes.index') }}" class="text-green-600 hover:text-green-800 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('ambientes.index') ? 'bg-green-100' : '' }}">
                        {{ __('Ambientes') }}
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center text-green-600 hover:text-green-800 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-green-700 hover:bg-green-100">
                            {{ __('Profile') }}
                        </a>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); this.closest('form').submit();"
                               class="block px-4 py-2 text-sm text-green-700 hover:bg-green-100">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-green-600 hover:text-green-800 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-800 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-green-600 hover:text-green-800 hover:bg-green-100 {{ request()->routeIs('dashboard') ? 'bg-green-100' : '' }}">
                {{ __('Dashboard') }}
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-green-200">
            <div class="px-4">
                <div class="font-medium text-base text-green-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-green-600">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-green-600 hover:text-green-800 hover:bg-green-100">
                    {{ __('Profile') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="block pl-3 pr-4 py-2 text-base font-medium text-green-600 hover:text-green-800 hover:bg-green-100">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Estilos adicionales */
    .bg-green-50 { background-color: #f0fdf4; }
    .bg-green-100 { background-color: #dcfce7; }
    .text-green-600 { color: #16a34a; }
    .text-green-700 { color: #15803d; }
    .text-green-800 { color: #166534; }
    .hover\:text-green-800:hover { color: #166534; }
    .hover\:bg-green-100:hover { background-color: #dcfce7; }
    .border-green-200 { border-color: #bbf7d0; }

    /* Transiciones */
    .transition { transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform; }
    .duration-150 { transition-duration: 150ms; }
    .ease-in-out { transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); }

    /* Responsive */
    @media (min-width: 640px) {
        .sm\:flex { display: flex; }
        .sm\:hidden { display: none; }
        .sm\:items-center { align-items: center; }
        .sm\:ml-6 { margin-left: 1.5rem; }
    }
</style>
