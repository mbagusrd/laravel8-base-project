<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @if (View::hasSection('page_title'))
            @yield('page_title') -
        @endif {{ env('APP_NAME') }}
    </title>
    <link rel="stylesheet" href="{{ url(mix('css/app.css')) . '?v=' . filemtime(public_path('css/app.css')) }}">
    <link rel="stylesheet" href="{{ url(mix('css/select2.css')) . '?v=' . filemtime(public_path('css/select2.css')) }}">
    <link rel="stylesheet" href="{{ url(mix('css/style.css')) . '?v=' . filemtime(public_path('css/style.css')) }}">

    @livewireStyles
</head>

<body class="mx-auto font-sans">
    <div class="h-screen drawer drawer-mobile">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle">
        <div class="flex flex-col bg-gray-200 drawer-content">
            <!-- Navbar -->
            <div class="z-20 bg-white shadow-lg navbar">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-3" class="btn btn-square btn-ghost">
                        <i class="bi bi-list"></i>
                    </label>
                </div>
                <div class="flex-none mx-2">
                    <label for="" class="text-xl">{{ env('APP_NAME') }}</label>
                </div>
                <div class="justify-end flex-1 mx-2">
                    @auth
                        <div class="dropdown dropdown-end">
                            <label tabindex="0" class="text-xl btn btn-ghost btn-circle avatar">
                                <i class="bi bi-person-fill"></i>
                            </label>
                            <ul tabindex="0"
                                class="p-4 mt-3 shadow-xl menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                                {{-- <li>
                                    <a class="justify-between">
                                        Profile
                                        <span class="badge">New</span>
                                    </a>
                                </li>
                                <li><a>Settings</a></li> --}}
                                <li class="pb-2 font-bold">{{ auth()->user()->name }}</li>
                                <li>
                                    <form action="{{ route('logout') }}" method="post"
                                        onsubmit="return confirm('Anda Ingin Logout?')" class='p-0'>
                                        @csrf
                                        <x-button class='btn-outline btn-error btn-block btn-sm'>Logout</x-button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>

            <div class="h-full p-5 overflow-y-auto">
                @yield('content')
            </div>

            <footer class="items-center p-4 text-white footer bg-primary">
                <div class="items-center grid-flow-col">
                    <p>Copyright © 2022 - All right reserved</p>
                </div>
                <div class="hidden grid-flow-col md:grid md:justify-self-end"></div>
            </footer>
        </div>
        <div class="drawer-side">
            <label for="my-drawer-3" class="drawer-overlay"></label>
            <div class="h-full p-4 overflow-y-auto bg-[#343a40] w-72 text-[#c2c7d0] shadow-xl">
                <x-sidebar-menu></x-sidebar-menu>
            </div>
        </div>
    </div>

    @livewireScripts

    <script src="{{ url(mix('js/app.js')) . '?v=' . filemtime(public_path('js/app.js')) }}"></script>
    @stack('scripts')
    @if (app()->isLocal())
        <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
    @endif
</body>

</html>
