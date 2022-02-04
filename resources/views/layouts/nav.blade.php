

<x-jet-banner />

<div class="min-h-screen bg-gray-100">
    @livewire('navigation-menu')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class=" max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif


    <!-- Page Content -->
    <div class="m-2 p-2"  >
        @yield('content')
    </div>
</div>

@stack('modals')

@livewireScripts
