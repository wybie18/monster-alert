<nav x-data="{ open: false }" class="hidden md:flex md:flex-col md:w-64 md:fixed md:inset-y-0 bg-white border-r border-gray-100">
    <!-- Logo -->
    <div class="flex items-center h-16 px-6 border-b border-gray-100">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <x-application-logo class="h-8 w-auto fill-current text-indigo-600" />
            <span class="ml-2 text-lg font-medium text-gray-900">{{ config('app.name', 'Laravel') }}ss</span>
        </a>
    </div>
    
    <!-- Navigation Links -->
    <div class="flex-1 flex flex-col overflow-y-auto pt-5 pb-4">
        <nav class="flex-1 px-4 space-y-1">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }} group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="{{ request()->routeIs('dashboard') ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500' }} mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
            
            <!-- Add more navigation links here as needed -->
            
            <div class="pt-8">
                <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Account</p>
            </div>
            
            <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }} group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="{{ request()->routeIs('profile.edit') ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500' }} mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Profile
            </a>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-600 hover:bg-gray-50 group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Log Out
                </a>
            </form>
        </nav>
    </div>
</nav>