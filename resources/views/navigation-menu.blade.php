<nav x-data="{ open: false }" class="border-b border-gray-100 bg-white">
  <!-- Primary Navigation Menu -->
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 justify-between">
      <div class="flex">
        <!-- Logo -->

        <!-- Navigation Links ADMINN-->
{{--          @if(auth()->user()->roles == 'ADMIN')--}}
{{--              <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">--}}
{{--                  <x-jet-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">--}}
{{--                      {{ __('Dashboard') }}--}}
{{--                  </x-jet-nav-link>--}}
{{--                  <x-jet-nav-link href="{{ route('admin.brands.index') }}" :active="request()->routeIs('admin.brands.index')">--}}
{{--                      {{ __('Brands') }}--}}
{{--                  </x-jet-nav-link>--}}
{{--                  <x-jet-nav-link href="{{ route('admin.types.index') }}" :active="request()->routeIs('admin.types.index')">--}}
{{--                      {{ __('Types') }}--}}
{{--                  </x-jet-nav-link>--}}
{{--                  <x-jet-nav-link href="{{ route('admin.items.index') }}" :active="request()->routeIs('admin.items.index')">--}}
{{--                      {{ __('Items') }}--}}
{{--                  </x-jet-nav-link>--}}
{{--              </div>--}}
{{--          @endif--}}

          @if(auth()->user()->roles == 'OWNER')
              <div class="flex shrink-0 items-center">
                  <a href="{{ route('owner.dashboard') }}">
                      <x-jet-application-mark class="block h-9 w-auto" />
                  </a>
              </div>
              <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                  <x-jet-nav-link href="{{ route('owner.dashboard') }}" :active="request()->routeIs('owner.dashboard')">
                      {{ __('Dashboard') }}
                  </x-jet-nav-link>
                  <x-jet-nav-link href="{{ route('owner.brands.index') }}" :active="request()->routeIs('owner.brands.index')">
                      {{ __('Brands') }}
                  </x-jet-nav-link>
                  <x-jet-nav-link href="{{ route('owner.types.index') }}" :active="request()->routeIs('owner.types.index')">
                      {{ __('Types') }}
                  </x-jet-nav-link>
                  <x-jet-nav-link href="{{ route('owner.items.index') }}" :active="request()->routeIs('owner.items.index')">
                      {{ __('Items') }}
                  </x-jet-nav-link>
              </div>
          @elseif(auth()->user()->roles == 'ADMIN')
              <div class="flex shrink-0 items-center">
                  <a href="{{ route('admin.dashboard') }}">
                      <x-jet-application-mark class="block h-9 w-auto" />
                  </a>
              </div>
              <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                  <x-jet-nav-link href="{{ route('admin.bookings.index') }}" :active="request()->routeIs('admin.bookings.index')">
                      {{ __('Bookings') }}
                  </x-jet-nav-link>
              </div>
          @else
              <div class="flex shrink-0 items-center">
                  <a href="{{ route('front.index') }}" class="hover:bg-gray-200 hover:underline text-md font-bold rounded-[18px]" style="">Rental-in</a>
              </div>
          @endif

      </div>

      <div class="hidden sm:ml-6 sm:flex sm:items-center">
        <!-- Teams Dropdown -->
        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
          <div class="relative ml-3">
            <x-jet-dropdown align="right" width="60">
              <x-slot name="trigger">
                <span class="inline-flex rounded-md">
                  <button type="button"
                    class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition hover:bg-gray-50 hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50">
                    {{ Auth::user()->currentTeam->name }}

                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                    </svg>
                  </button>
                </span>
              </x-slot>

              <x-slot name="content">
                <div class="w-60">
                  <!-- Team Management -->
                  <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                  </div>

                  <!-- Team Settings -->
                  <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                    {{ __('Team Settings') }}
                  </x-jet-dropdown-link>

                  @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                    <x-jet-dropdown-link href="{{ route('teams.create') }}">
                      {{ __('Create New Team') }}
                    </x-jet-dropdown-link>
                  @endcan

                  <div class="border-t border-gray-100"></div>

                  <!-- Team Switcher -->
                  <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Switch Teams') }}
                  </div>

                  @foreach (Auth::user()->allTeams() as $team)
                    <x-jet-switchable-team :team="$team" />
                  @endforeach
                </div>
              </x-slot>
            </x-jet-dropdown>
          </div>
        @endif

        <!-- Settings Dropdown -->
        <div class="relative ml-3">
          <x-jet-dropdown align="right" width="48">
            <x-slot name="trigger">
              @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <button class="flex rounded-full border-2 border-transparent text-sm transition focus:border-gray-300 focus:outline-none">
                  <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </button>
              @else
                <span class="inline-flex rounded-md">
                  <button type="button"
                    class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50">
                    {{ Auth::user()->name }}

                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                  </button>
                </span>
              @endif
            </x-slot>

            <x-slot name="content">
              <!-- Account Management -->
              <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Manage Account') }}
              </div>

              <x-jet-dropdown-link href="{{ route('profile.show') }}">
                {{ __('Profile') }}
              </x-jet-dropdown-link>

              @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                  {{ __('API Tokens') }}
                </x-jet-dropdown-link>
              @endif

              <div class="border-t border-gray-100"></div>

              <!-- Authentication -->
              <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf

                <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                  {{ __('Log Out') }}
                </x-jet-dropdown-link>
              </form>
            </x-slot>
          </x-jet-dropdown>
        </div>
      </div>

      <!-- Hamburger -->
      <div class="-mr-2 flex items-center sm:hidden">
        <button @click="open = ! open"
          class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    <div class="space-y-1 pt-2 pb-3">
      <x-jet-responsive-nav-link href="{{ route('owner.dashboard') }}" :active="request()->routeIs('owner.dashboard')">
        {{ __('Dashboard') }}
      </x-jet-responsive-nav-link>
      <x-jet-responsive-nav-link href="{{ route('owner.brands.index') }}" :active="request()->routeIs('owner.brands.index')">
        {{ __('Brands') }}
      </x-jet-responsive-nav-link>
      <x-jet-responsive-nav-link href="{{ route('owner.types.index') }}" :active="request()->routeIs('owner.types.index')">
        {{ __('Types') }}
      </x-jet-responsive-nav-link>
      <x-jet-responsive-nav-link href="{{ route('owner.items.index') }}" :active="request()->routeIs('owner.items.index')">
        {{ __('Items') }}
      </x-jet-responsive-nav-link>
{{--      <x-jet-responsive-nav-link href="{{ route('owner.bookings.index') }}" :active="request()->routeIs('owner.bookings.index')">--}}
{{--        {{ __('Bookings') }}--}}
{{--      </x-jet-responsive-nav-link>--}}
    </div>

    <!-- Responsive Settings Options -->
    <div class="border-t border-gray-200 pt-4 pb-1">
      <div class="flex items-center px-4">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
          <div class="mr-3 shrink-0">
            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
          </div>
        @endif

        <div>
          <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
          <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
        </div>
      </div>

      <div class="mt-3 space-y-1">
        <!-- Account Management -->
        <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
          {{ __('Profile') }}
        </x-jet-responsive-nav-link>

        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
          <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
            {{ __('API Tokens') }}
          </x-jet-responsive-nav-link>
        @endif

        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}" x-data>
          @csrf

          <x-jet-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
            {{ __('Log Out') }}
          </x-jet-responsive-nav-link>
        </form>

        <!-- Team Management -->
        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
          <div class="border-t border-gray-200"></div>

          <div class="block px-4 py-2 text-xs text-gray-400">
            {{ __('Manage Team') }}
          </div>

          <!-- Team Settings -->
          <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
            {{ __('Team Settings') }}
          </x-jet-responsive-nav-link>

          @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
            <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
              {{ __('Create New Team') }}
            </x-jet-responsive-nav-link>
          @endcan

          <div class="border-t border-gray-200"></div>

          <!-- Team Switcher -->
          <div class="block px-4 py-2 text-xs text-gray-400">
            {{ __('Switch Teams') }}
          </div>

          @foreach (Auth::user()->allTeams() as $team)
            <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
          @endforeach
        @endif
      </div>
    </div>
  </div>
</nav>
