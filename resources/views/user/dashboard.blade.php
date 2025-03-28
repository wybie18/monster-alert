<x-user-layout>
    <x-slot name="header">Dashboard</x-slot>

    <div class="space-y-6">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- Welcome Section -->
                <div class="p-6 bg-white shadow sm:rounded-lg">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Welcome back, {{ Auth::user()->name }}!</h2>
                            <p class="mt-1 text-sm text-gray-600">Here's what's happening with monster sightings around
                                the world.</p>
                        </div>
                        <div class="mt-4 md:mt-0 flex space-x-3">
                            <a href="{{ route('user.report') }}"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Report Sighting
                            </a>
                            <a href="{{ route('user.map') }}"
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                                Explore Map
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Total Sightings -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Total Sightings</dt>
                                        <dd class="flex items-baseline">
                                            <div class="text-2xl font-semibold text-gray-900">{{ $totalSightings }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Your Sightings -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Your Sightings</dt>
                                        <dd class="flex items-baseline">
                                            <div class="text-2xl font-semibold text-gray-900">{{ $userSightings }}</div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Sightings -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Recent (24h)</dt>
                                        <dd class="flex items-baseline">
                                            <div class="text-2xl font-semibold text-gray-900">{{ $recentSightings }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Nearby Sightings -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Nearby (50km)</dt>
                                        <dd class="flex items-baseline">
                                            <div class="text-2xl font-semibold text-gray-900">{{ $nearbySightings }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Sightings List -->
                    <div class="lg:col-span-2 bg-white shadow sm:rounded-lg overflow-hidden">
                        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Monster Sightings</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Latest reports from around the world.</p>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @forelse($recentMonsters as $monster)
                                <div class="px-4 py-4 sm:px-6 hover:bg-gray-50">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            <img class="h-12 w-12 rounded-md object-cover"
                                                src="{{ asset('storage/' . $monster->image) }}"
                                                alt="{{ $monster->name }}">
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-indigo-600 truncate">
                                                    {{ $monster->name }}</p>
                                                <div class="ml-2 flex-shrink-0 flex">
                                                    <p
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $monster->monster_type == 'dangerous' ? 'red' : ($monster->monster_type == 'friendly' ? 'green' : 'yellow') }}-100 text-{{ $monster->monster_type == 'dangerous' ? 'red' : ($monster->monster_type == 'friendly' ? 'green' : 'yellow') }}-800">
                                                        {{ ucfirst($monster->monster_type) }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="mt-1 flex justify-between">
                                                <p class="text-sm text-gray-500 truncate">
                                                    {{ Str::limit($monster->description, 60) }}</p>
                                                <p class="text-xs text-gray-400">
                                                    {{ $monster->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="px-4 py-6 sm:px-6 text-center">
                                    <p class="text-gray-500">No recent monster sightings.</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="bg-gray-50 px-4 py-4 sm:px-6 border-t border-gray-200">
                            <a href="{{ route('user.map') }}"
                                class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all sightings on
                                map <span aria-hidden="true">&rarr;</span></a>
                        </div>
                    </div>

                    <!-- Map Preview & Your Sightings -->
                    <div class="space-y-6">
                        <!-- Map Preview -->
                        <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Nearby Sightings</h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Monster activity in your area.</p>
                            </div>
                            <div class="p-4">
                                <div id="map-preview" class="h-48 rounded-lg border border-gray-200"></div>
                            </div>
                            <div class="bg-gray-50 px-4 py-4 sm:px-6 border-t border-gray-200">
                                <a href="{{ route('user.map') }}"
                                    class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Open full map
                                    <span aria-hidden="true">&rarr;</span></a>
                            </div>
                        </div>

                        <!-- Your Sightings -->
                        <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Your Sightings</h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Monsters you've reported.</p>
                            </div>
                            <div class="divide-y divide-gray-200">
                                @forelse($userMonsters as $monster)
                                    <div class="px-4 py-4 sm:px-6 hover:bg-gray-50">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-md object-cover"
                                                    src="{{ asset('storage/' . $monster->image) }}"
                                                    alt="{{ $monster->name }}">
                                            </div>
                                            <div class="ml-4 flex-1">
                                                <div class="flex items-center justify-between">
                                                    <p class="text-sm font-medium text-indigo-600 truncate">
                                                        {{ $monster->name }}</p>
                                                    <p class="text-xs text-gray-400">
                                                        {{ $monster->created_at->format('M d, Y') }}</p>
                                                </div>
                                                <div class="mt-1">
                                                    <p class="text-xs text-gray-500 truncate">
                                                        {{ Str::limit($monster->description, 40) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="px-4 py-6 sm:px-6 text-center">
                                        <p class="text-gray-500">You haven't reported any sightings yet.</p>
                                        <a href="{{ route('user.report') }}"
                                            class="mt-2 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                            Report your first sighting
                                        </a>
                                    </div>
                                @endforelse
                            </div>
                            @if (count($userMonsters) > 0)
                                <div class="bg-gray-50 px-4 py-4 sm:px-6 border-t border-gray-200">
                                    <a href="#"
                                        class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all your
                                        reports <span aria-hidden="true">&rarr;</span></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Monster Type Distribution</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Breakdown of monster types reported globally.
                        </p>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            @foreach ($monsterTypes as $type => $count)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 rounded-full bg-{{ $type == 'dangerous' ? 'red' : ($type == 'friendly' ? 'green' : 'yellow') }}-100 flex items-center justify-center">
                                            <svg class="h-6 w-6 text-{{ $type == 'dangerous' ? 'red' : ($type == 'friendly' ? 'green' : 'yellow') }}-600"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                @if ($type == 'dangerous')
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                @elseif($type == 'friendly')
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                @endif
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-medium text-gray-900">{{ ucfirst($type) }}</h4>
                                            <div class="mt-1 flex items-baseline">
                                                <p class="text-2xl font-semibold text-gray-900">{{ $count }}
                                                </p>
                                                <p class="ml-2 text-sm text-gray-500">sightings</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-{{ $type == 'dangerous' ? 'red' : ($type == 'friendly' ? 'green' : 'yellow') }}-600 h-2.5 rounded-full"
                                            style="width: {{ ($count / $totalSightings) * 100 }}%"></div>
                                    </div>
                                    <p class="mt-1 text-xs text-right text-gray-500">
                                        {{ round(($count / $totalSightings) * 100) }}% of total</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <link href="https://cdn.maptiler.com/maplibre-gl-js/v2.4.0/maplibre-gl.css" rel="stylesheet" />
        <script src="https://cdn.maptiler.com/maplibre-gl-js/v2.4.0/maplibre-gl.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const apiKey = '{{ config('app.maptiler_api_key') }}';

                const map = new maplibregl.Map({
                    container: 'map-preview',
                    style: `https://api.maptiler.com/maps/streets/style.json?key=${apiKey}`,
                    center: [0, 20],
                    zoom: 2,
                    interactive: false
                });

                const monsters = @json($nearbyMonsters);

                monsters.forEach(monster => {
                    const el = document.createElement('div');
                    el.className = 'marker';
                    el.style.width = '15px';
                    el.style.height = '15px';
                    el.style.borderRadius = '50%';
                    el.style.backgroundColor = '#EF4444';
                    el.style.border = '2px solid white';
                    el.style.boxShadow = '0 0 0 1px rgba(0, 0, 0, 0.1)';

                    const marker = new maplibregl.Marker({
                            element: el,
                            anchor: 'bottom'
                        })
                        .setLngLat([monster.longitude, monster.latitude])
                        .addTo(map);
                });

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(position => {
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;

                        const userMarker = new maplibregl.Marker({
                                anchor: 'center'
                            })
                            .setLngLat([userLng, userLat])
                            .addTo(map);

                        map.flyTo({
                            center: [userLng, userLat],
                            zoom: 9,
                            essential: true
                        });

                    }, error => {
                        console.error('Error getting location:', error);
                        const bounds = new maplibregl.LngLatBounds();
                        monsters.forEach(monster => {
                            bounds.extend([monster.longitude, monster.latitude]);
                        });

                        if (!bounds.isEmpty()) {
                            map.fitBounds(bounds, {
                                padding: 30
                            });
                        }
                    });
                } else {
                    const bounds = new maptilersdk.LngLatBounds();
                    monsters.forEach(monster => {
                        bounds.extend([monster.longitude, monster.latitude]);
                    });

                    if (!bounds.isEmpty()) {
                        map.fitBounds(bounds, {
                            padding: 30
                        });
                    }
                }
            });
        </script>
    @endpush
</x-user-layout>
