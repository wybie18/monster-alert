<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        <div class="flex">
            <!-- Sidebar Navigation (hidden on mobile) -->
            @include('layouts.navigation')

            <!-- Mobile header & content wrapper -->
            <div class="md:pl-64 flex flex-col flex-1">
                <!-- Mobile top navigation -->
                <div class="sticky top-0 z-10 flex h-16 flex-shrink-0 bg-white border-b border-gray-100 md:hidden">
                    <div class="flex-1 flex justify-between px-4">
                        <div class="flex-1 flex items-center">
                            <a href="{{ route('dashboard') }}">
                                <x-application-logo class="block h-8 w-auto fill-current text-indigo-600" />
                            </a>
                        </div>
                        <div class="flex items-center">
                            <!-- Mobile menu button -->
                            <button type="button" x-data="{}" @click="$dispatch('open-slideover')" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                <span class="sr-only">Open menu</span>
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile sidebar (hidden by default) -->
                <div x-data="{ open: false }" @open-slideover.window="open = true" x-show="open" class="fixed inset-0 flex z-40 md:hidden" x-cloak>
                    <!-- Backdrop -->
                    <div @click="open = false" x-show="open" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
                    
                    <!-- Slideover panel -->
                    <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
                        <div class="absolute top-0 right-0 -mr-12 pt-2">
                            <button @click="open = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                                <span class="sr-only">Close sidebar</span>
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Mobile navigation content -->
                        <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                            <div class="flex-shrink-0 flex items-center px-4">
                                <a href="{{ route('dashboard') }}">
                                    <x-application-logo class="h-8 w-auto fill-current text-indigo-600" />
                                </a>
                            </div>
                            <nav class="mt-5 px-2 space-y-1">
                                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }} group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="{{ request()->routeIs('dashboard') ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500' }} mr-4 flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                </a>
                                
                                <!-- Add your mobile menu items here -->

                                <div class="pt-6">
                                    <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Account</p>
                                </div>
                                
                                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }} group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="{{ request()->routeIs('profile.edit') ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500' }} mr-4 flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profile
                                </a>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-600 hover:bg-gray-50 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-400 group-hover:text-gray-500 mr-4 flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Log Out
                                    </a>
                                </form>
                            </nav>
                        </div>
                        
                        <!-- Mobile user information -->
                        <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                        <span class="text-indigo-600 font-medium text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <main class="flex-1">
                    @isset($header)
                        <header class="bg-white shadow-sm sm:fixed w-full z-50">
                            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                                <h1 class="text-lg font-semibold text-gray-900">
                                    {{ $header }}
                                </h1>
                            </div>
                        </header>
                    @endisset

                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>
</html>