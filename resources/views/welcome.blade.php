<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MonsterTrack - Document & Track Monster Sightings</title>
        <meta name="description" content="Join our community of monster trackers to document, share, and explore mysterious creature sightings around the world.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="https://cdn.maptiler.com/maplibre-gl-js/v2.4.0/maplibre-gl.css" rel="stylesheet" />
        <script src="https://cdn.maptiler.com/maplibre-gl-js/v2.4.0/maplibre-gl.js"></script>
        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] text-[#1b1b18] min-h-screen flex flex-col">
        <header class="w-full px-6 lg:px-8 py-6 border-b border-[#19140015] ">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center">
                    <div class="text-2xl font-bold text-indigo-600 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M8 3v3a2 2 0 0 1-2 2H3m18 0h-3a2 2 0 0 1-2-2V3m0 18v-3a2 2 0 0 1 2-2h3M3 16h3a2 2 0 0 1 2 2v3"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M12 19c-4.2 0-7-2.8-7-7s2.8-7 7-7 7 2.8 7 7-2.8 7-7 7Z"></path>
                            <path d="M12 19c-3 0-6-1.5-6-5s3-5 6-5 6 1.5 6 5-3 5-6 5Z"></path>
                        </svg>
                        MonsterTrack
                    </div>
                </div>
                
                @if (Route::has('login'))
                    <nav class="flex items-center gap-4">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="inline-block px-5 py-1.5 border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] rounded-sm text-sm leading-normal"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="inline-block px-5 py-1.5 text-[#1b1b18] border border-transparent hover:border-[#19140035] rounded-sm text-sm leading-normal"
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="inline-block px-5 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white border border-transparent rounded-sm text-sm leading-normal transition-colors"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <main class="flex-grow">
            <!-- Hero Section -->
            <section class="relative overflow-hidden py-16 sm:py-24">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-white opacity-50"></div>
                <div class="relative max-w-7xl mx-auto px-6 lg:px-8 flex flex-col lg:flex-row items-center">
                    <div class="lg:w-1/2 lg:pr-12 mb-12 lg:mb-0">
                        <h1 class="text-4xl sm:text-5xl font-bold tracking-tight mb-6">
                            Discover & Track <span class="text-indigo-600">Mysterious Creatures</span> Around the World
                        </h1>
                        <p class="text-lg text-gray-600 mb-8">
                            Join our global community of monster trackers documenting sightings of unexplained creatures. Report your encounters, explore the interactive map, and help unravel the mysteries that lurk in the shadows.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex justify-center items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-base font-medium rounded-md shadow-sm transition-colors">
                                    Start Tracking
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="m12 5 7 7-7 7"></path>
                                    </svg>
                                </a>
                            @endif
                            <a href="#how-it-works" class="inline-flex justify-center items-center px-6 py-3 border border-[#19140035] hover:border-[#1915014a] rounded-md text-base font-medium transition-colors">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <div class="lg:w-1/2 relative">
                        <div class="relative w-full h-[400px] rounded-xl overflow-hidden shadow-2xl">
                            <div id="preview-map" class="absolute inset-0"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex items-end">
                                <div class="p-6 text-white">
                                    <div class="flex items-center mb-2">
                                        <div class="h-3 w-3 rounded-full bg-red-500 mr-2"></div>
                                        <span class="text-sm font-medium">Dangerous Sighting</span>
                                    </div>
                                    <h3 class="text-xl font-bold mb-1">Giant Sea Serpent</h3>
                                    <p class="text-sm opacity-80">Reported 2 days ago near Pacific Coast</p>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -top-4 -right-4 bg-yellow-400 text-yellow-800 px-4 py-2 rounded-full font-bold text-sm shadow-lg transform rotate-12">
                            Live Sightings!
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section id="how-it-works" class="py-16 sm:py-24 bg-white">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl font-bold tracking-tight mb-4">How MonsterTrack Works</h2>
                        <p class="max-w-2xl mx-auto text-lg text-gray-600">
                            Our platform makes it easy to document, explore, and analyze monster sightings from around the globe.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Feature 1 -->
                        <div class="bg-[#FDFDFC] p-6 rounded-lg shadow-sm border border-[#19140015]">
                            <div class="h-12 w-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-3">Report Sightings</h3>
                            <p class="text-gray-600 mb-4">
                                Document your monster encounters with detailed descriptions, images, and precise location data.
                            </p>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <svg class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Upload photos as evidence
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Automatic location tagging
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Categorize by monster type
                                </li>
                            </ul>
                        </div>

                        <!-- Feature 2 -->
                        <div class="bg-[#FDFDFC] p-6 rounded-lg shadow-sm border border-[#19140015]">
                            <div class="h-12 w-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-3">Explore the Map</h3>
                            <p class="text-gray-600 mb-4">
                                Navigate our interactive global map to discover monster sightings in your area and around the world.
                            </p>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <svg class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Filter by monster type
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Find sightings near you
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    View detailed sighting info
                                </li>
                            </ul>
                        </div>

                        <!-- Feature 3 -->
                        <div class="bg-[#FDFDFC] p-6 rounded-lg shadow-sm border border-[#19140015]">
                            <div class="h-12 w-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-3">Join the Community</h3>
                            <p class="text-gray-600 mb-4">
                                Connect with fellow monster enthusiasts, researchers, and curious minds from across the globe.
                            </p>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <svg class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Track your sighting history
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Get alerts for nearby sightings
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Contribute to research
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Recent Sightings Section -->
            <section class="py-16 sm:py-24">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold tracking-tight mb-4">Recent Monster Sightings</h2>
                        <p class="max-w-2xl mx-auto text-lg text-gray-600">
                            Check out the latest documented encounters from our global community.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Sighting Card 1 -->
                        <div class="bg-white rounded-lg overflow-hidden shadow-md border border-[#19140015] transition-transform hover:scale-[1.02]">
                            <div class="h-48 bg-gray-200 relative">
                                <img src="https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2l0eXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="Urban Cryptid" class="w-full h-full object-cover">
                                <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">Dangerous</div>
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="text-xl font-bold">Urban Cryptid</h3>
                                    <span class="text-xs text-gray-500">2 days ago</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">Spotted lurking in abandoned subway tunnels. Approximately 7 feet tall with glowing red eyes.</p>
                                <div class="flex items-center text-xs text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    New York City, USA
                                </div>
                            </div>
                        </div>

                        <!-- Sighting Card 2 -->
                        <div class="bg-white rounded-lg overflow-hidden shadow-md border border-[#19140015] transition-transform hover:scale-[1.02]">
                            <div class="h-48 bg-gray-200 relative">
                                <img src="https://images.unsplash.com/photo-1439405326854-014607f694d7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8b2NlYW58ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="Sea Serpent" class="w-full h-full object-cover">
                                <div class="absolute top-3 right-3 bg-yellow-500 text-yellow-800 text-xs font-bold px-2 py-1 rounded">Caution</div>
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="text-xl font-bold">Sea Serpent</h3>
                                    <span class="text-xs text-gray-500">5 days ago</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">Massive serpentine creature spotted from fishing vessel. Estimated length over 30 meters.</p>
                                <div class="flex items-center text-xs text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    Pacific Ocean, Near Japan
                                </div>
                            </div>
                        </div>

                        <!-- Sighting Card 3 -->
                        <div class="bg-white rounded-lg overflow-hidden shadow-md border border-[#19140015] transition-transform hover:scale-[1.02]">
                            <div class="h-48 bg-gray-200 relative">
                                <img src="https://images.unsplash.com/photo-1448375240586-882707db888b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Zm9yZXN0fGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="Forest Spirit" class="w-full h-full object-cover">
                                <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">Friendly</div>
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="text-xl font-bold">Forest Spirit</h3>
                                    <span class="text-xs text-gray-500">1 week ago</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">Luminous humanoid figure observed helping lost hikers find their way back to the trail.</p>
                                <div class="flex items-center text-xs text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    Black Forest, Germany
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-12">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-6 py-3 border border-[#19140035] hover:border-[#1915014a] rounded-md text-base font-medium transition-colors">
                                    View All Sightings
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="m12 5 7 7-7 7"></path>
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-base font-medium rounded-md shadow-sm transition-colors">
                                    Join to See More
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="m12 5 7 7-7 7"></path>
                                    </svg>
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="py-16 sm:py-24 bg-indigo-600">
                <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-white mb-6">Ready to Join the Monster Tracking Community?</h2>
                    <p class="max-w-2xl mx-auto text-lg text-indigo-100 mb-8">
                        Create your account today and start documenting mysterious creatures, exploring sightings, and connecting with fellow enthusiasts.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex justify-center items-center px-6 py-3 bg-white hover:bg-gray-100 text-indigo-600 text-base font-medium rounded-md shadow-sm transition-colors">
                                Create Free Account
                            </a>
                        @endif
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="inline-flex justify-center items-center px-6 py-3 border border-white hover:bg-indigo-700 text-white text-base font-medium rounded-md transition-colors">
                                Sign In
                            </a>
                        @endif
                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-white border-t border-[#19140015] py-12">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="md:col-span-2">
                        <div class="text-2xl font-bold text-indigo-600 flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M8 3v3a2 2 0 0 1-2 2H3m18 0h-3a2 2 0 0 1-2-2V3m0 18v-3a2 2 0 0 1 2-2h3M3 16h3a2 2 0 0 1 2 2v3"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M12 19c-4.2 0-7-2.8-7-7s2.8-7 7-7 7 2.8 7 7-2.8 7-7 7Z"></path>
                                <path d="M12 19c-3 0-6-1.5-6-5s3-5 6-5 6 1.5 6 5-3 5-6 5Z"></path>
                            </svg>
                            MonsterTrack
                        </div>
                        <p class="text-gray-600 mb-4">
                            Join our global community dedicated to documenting and researching mysterious creature sightings around the world. Together, we can uncover the truth behind these enigmatic beings.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-500 hover:text-indigo-600">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600">
                                <span class="sr-only">Instagram</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Company</h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="#" class="text-base text-gray-600 hover:text-indigo-600">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-600 hover:text-indigo-600">
                                    Privacy Policy
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-600 hover:text-indigo-600">
                                    Terms of Service
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-base text-gray-600 hover:text-indigo-600">
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <p class="text-base text-gray-500 text-center">
                        &copy; {{ date('Y') }} MonsterTrack. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const apiKey = '{{ config('app.maptiler_api_key') }}';

                maplibregl.setRTLTextPlugin(
                    'https://cdn.maptiler.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.3/mapbox-gl-rtl-text.js',
                    null,
                    true
                );
                
                const map = new maplibregl.Map({
                    container: 'preview-map',
                    style: `https://api.maptiler.com/maps/streets/style.json?key=${apiKey}`,
                    center: [125.9772806, 8.5038080], // San Francisco
                    zoom: 11,
                    interactive: false
                });
                
                // Create a marker
                const marker = new maplibregl.Marker({
                    anchor: 'bottom'
                })
                .setLngLat([125.9772806, 8.5038080])
                .addTo(map);
            });
        </script>
    </body>
</html>

