<nav x-data="{ open: false }" class="hidden md:flex md:flex-col md:w-64 md:fixed md:inset-y-0 bg-white border-r border-gray-100">
    <!-- Logo -->
    <div class="flex items-center h-16 px-6 border-b border-gray-100">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center">
            <x-application-logo class="h-8 w-auto fill-current text-indigo-600" />
            <span class="ml-2 text-lg font-medium text-gray-900">{{ config('app.name', 'Laravel') }}</span>
        </a>
    </div>
    
    <!-- Navigation Links -->
    <div class="flex-1 flex flex-col overflow-y-auto pt-5 pb-4">
        <nav class="flex-1 px-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }} group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="{{ request()->routeIs('admin.dashboard') ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500' }} mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('monsters.index') }}" class="{{ request()->routeIs('monsters.index') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }} group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="{{ request()->routeIs('submissions.index') ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500' }} mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Monster Records
            </a>
            <a href="{{ route('submissions.index') }}" class="{{ request()->routeIs('submissions.index') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }} group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="{{ request()->routeIs('submissions.index') ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500' }} mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                User Submission
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