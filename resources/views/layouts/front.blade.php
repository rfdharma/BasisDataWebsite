<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:x-transition="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    {{ config('app.name', 'Laravel') }}--}}
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Libraries -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script defer src="https://unpkg.com/alpinejs@3.7.0/dist/cdn.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous">
  </script>

  <!-- Scripts -->
  @vite(['resources/css/front.css'])

  <!-- Styles -->
  @livewireStyles
</head>

<body>
<div style="display: flex;">
    <!-- Sidebar -->
    @auth
        @if(auth()->user()->roles == 'USER')
        <aside class="" id="sidebar" style="background: #2d3748; width: 350px; max-height: 100vh; overflow-y: auto; padding: 20px; display: none;">
            <div style="color: white; font-size: 20px; font-weight: bold; margin-bottom: 20px;" class="text-center">All Notifications</div>
            @if ($notification == "Tidak ada notifikasi.")
                <p>Tidak ada perubahan</p>
            @else
                @foreach ($notification as $notif)
                    <div class="text-white flex focus:outline-none gap-2 mb-1 mt-2 ml-2">
                        <div>
                            <p tabindex="0" class="text-sm leading-none">Invoice {{ $notif->booking_id }}</p>
                        </div>
                        <div class="w-auto">
                            <p tabindex="0" class="text-sm leading-none">{{ $notif->message }}</p>
                        </div>
                    </div>
                    <div>
                        <p tabindex="0" class="text-white text-center text-sm font-bold leading-none">{{ $notif->updated_at }}</p>
                    </div>
                    <span class="block w-full border-t border-gray-400 my-4"></span>
                @endforeach
            @endif
        </aside>
       @endif
    @endauth


    <!-- Halaman Utama -->
    <main style="flex-grow: 1; display: flex; flex-direction: column;">
        <nav class="container relative my-4 lg:my-10">
            <div class="flex w-full flex-col justify-between lg:flex-row lg:items-center">
                <!-- Logo & Toggler Button here -->
                <div class="flex items-center justify-between">
                    <!-- LOGO -->
                    <a href="{{ route('front.index') }}" class="nav-link-item text-md font-bold rounded-[18px]" style="width: 100px; color: #111827;font-size: 20px">Rental-in</a>
                    <!-- RESPONSIVE NAVBAR BUTTON TOGGLER -->
                    <div class="block lg:hidden">
                        <button class="mobileMenuButton p-1 outline-none" id="navbarToggler" data-target="#navigation">
                            <svg class="h-7 w-7 text-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Nav Menu -->
                <div class="hidden w-full lg:block" id="navigation">
                    <div class="mt-6 flex flex-col items-baseline gap-4 lg:mt-0 lg:flex-row lg:items-center lg:justify-between">
                        <div class="ml-auto flex w-full flex-col gap-4 lg:w-auto lg:flex-row lg:items-center lg:gap-[50px]">
                            <a href="{{route('front.index')}}" class="nav-link-item">Home</a>
                            <a href="{{route('front.catalog')}}" class="nav-link-item">Vehicle</a>
                            <a href="{{route('front.orders')}}" class="nav-link-item">Orders</a>
                            {{--              <a href="#!" class="nav-link-item">Maps</a>--}}
                        </div>
                        @auth
                            <div class="ml-auto flex w-full flex-col lg:w-auto lg:flex-row lg:items-center gap-3">
                                @if(auth()->user()->roles == 'USER')
                                    <div x-data="{ isOpen: false }" class="relative inline-block">
                                        <!-- Dropdown toggle button -->
                                        <button @click="isOpen = !isOpen" class="relative z-10 block p-2 text-gray-700 bg-white border border-transparent rounded-md dark:text-white focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none">
                                            @if ($notification == "Tidak ada notifikasi.")
                                                <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path id="secondary" d="M15,18H9a3,3,0,0,0,3,3h0A3,3,0,0,0,15,18Z" style="fill: none; stroke: white; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                                                    <path id="primary" d="M19.38,14.38a2.12,2.12,0,0,1,.62,1.5h0A2.12,2.12,0,0,1,17.88,18H6.12A2.12,2.12,0,0,1,4,15.88H4a2.12,2.12,0,0,1,.62-1.5L6,13V9a6,6,0,0,1,6-6h0a6,6,0,0,1,6,6v4Z" style="fill: none; stroke: white; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-gray-800 dark:text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 22C10.8954 22 10 21.1046 10 20H14C14 21.1046 13.1046 22 12 22ZM20 19H4V17L6 16V10.5C6 7.038 7.421 4.793 10 4.18V2H13C12.3479 2.86394 11.9967 3.91762 12 5C12 5.25138 12.0187 5.50241 12.056 5.751H12C10.7799 5.67197 9.60301 6.21765 8.875 7.2C8.25255 8.18456 7.94714 9.33638 8 10.5V17H16V10.5C16 10.289 15.993 10.086 15.979 9.9C16.6405 10.0366 17.3226 10.039 17.985 9.907C17.996 10.118 18 10.319 18 10.507V16L20 17V19ZM17 8C16.3958 8.00073 15.8055 7.81839 15.307 7.477C14.1288 6.67158 13.6811 5.14761 14.2365 3.8329C14.7919 2.5182 16.1966 1.77678 17.5954 2.06004C18.9942 2.34329 19.9998 3.5728 20 5C20 6.65685 18.6569 8 17 8Z" fill="currentColor"></path>
                                                </svg>
                                            @endif
                                        </button>

                                        <!-- Dropdown menu -->
                                        <div x-show="isOpen"
                                             @click.away="isOpen = false"
                                             x-transition:enter="transition ease-out duration-100"
                                             x-transition:enter-start="opacity-0 scale-90"
                                             x-transition:enter-end="opacity-100 scale-100"
                                             x-transition:leave="transition ease-in duration-100"
                                             x-transition:leave-start="opacity-100 scale-100"
                                             x-transition:leave-end="opacity-0 scale-90"
                                             class="z-50 absolute right-0 w-64 mt-2 overflow-hidden origin-top-right bg-white rounded-md shadow-lg sm:w-80 dark:bg-gray-800">
                                            <div class="text-center text-white py-2 min-w-[216px] max-w-auto ml-2 mr-2">
                                                @if ($notification == "Tidak ada notifikasi.")
                                                    <p>Tidak ada notifikasi</p>
                                                @else
                                                    @foreach ($notification->take(2) as $notif)
                                                        <div class="text-white flex focus:outline-none gap-2 mb-1 mt-2 ml-2">
                                                            <div>
                                                                <p tabindex="0" class="text-sm leading-none">Invoice {{ $notif->booking_id }}</p>
                                                            </div>
                                                            <div class="w-auto">
                                                                <p tabindex="0" class="text-sm leading-none">{{ $notif->message }}</p>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <p tabindex="0" class="text-white text-right text-sm font-bold leading-none">{{ $notif->updated_at }}</p>
                                                        </div>
                                                        <span class="block w-full border-t border-gray-400 my-4"></span>
                                                    @endforeach
                                                        <div class="mb-1">
                                                            <a href="#" class="text-md text-white nav-link-item" id="toggleSidebar" style="color: white">See All Notifications</a>
                                                        </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endif
                                    <div x-data="{ isOpen: false }" class="relative inline-block">
                                        <!-- Dropdown toggle button -->
                                        <button @click="isOpen = !isOpen" class="relative z-10 block p-2 text-gray-700 bg-white border border-transparent rounded-md dark:text-white focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none">
                                            <svg class="w-5 h-5 text-gray-800 dark:text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>

                                        </button>

                                        <!-- Dropdown menu -->
                                        <div x-show="isOpen"
                                             @click.away="isOpen = false"
                                             x-transition:enter="transition ease-out duration-100"
                                             x-transition:enter-start="opacity-0 scale-90"
                                             x-transition:enter-end="opacity-100 scale-100"
                                             x-transition:leave="transition ease-in duration-100"
                                             x-transition:leave-start="opacity-100 scale-100"
                                             x-transition:leave-end="opacity-0 scale-90"
                                             class="z-50 absolute right-0 w-64 mt-2 overflow-hidden origin-top-right bg-white rounded-md shadow-lg sm:w-80 dark:bg-gray-800">
                                            <div class="text-center text-white py-2 inline-block gap-2" style="width: 100px">
                                                <a class="px-2 nav-link-item text-sm" style="color: white" href="{{ route('profile.show') }}">Edit Profile</a>
                                                <span class="block w-full border-t border-gray-400" style="margin-top: 5px;margin-bottom: 5px"></span>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <a class="px-2 nav-link-item text-sm" style="color: white" href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                  this.closest('form').submit();">
                                                        Log Out
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                {{-- Logout --}}
{{--                                <form method="POST" action="{{ route('logout') }}">--}}
{{--                                    @csrf--}}
{{--                                    <a href="{{ route('logout') }}" class="btn-secondary" style="border-radius: 0px"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                  this.closest('form').submit();">--}}
{{--                                        Log Out--}}
{{--                                    </a>--}}
{{--                                </form>--}}
                            </div>
                        @else
                            <div class="rounded-3xl ml-auto flex w-full flex-col lg:w-auto lg:flex-row lg:items-center lg:gap-12">
                                <a href="{{ route('login') }}" class="nav-link-item text-md font-bold rounded-[18px]" style="width: 100px; color: #111827;font-size: 18px;">
                                    Log In
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

        </nav>

        {{ $slot }}
    </main>
</div>



<script>
    document.getElementById("toggleSidebar").addEventListener("click", function (e) {
        e.preventDefault(); // Mencegah tautan bawa Anda ke halaman lain

        var sidebar = document.getElementById("sidebar");
        if (sidebar.style.display === "block") {
            sidebar.style.display = "none";
        } else {
            sidebar.style.display = "block";
        }
    });

</script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true,
      duration: 300,
      easing: 'ease-out'
    });
  </script>

  <script src="{{ url('js/script.js') }}"></script>

</body>

</html>
