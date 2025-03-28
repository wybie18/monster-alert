<x-user-layout>
    <x-slot name="header">World Map</x-slot>
    <div class="space-y-6">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="flex flex-col space-y-4">
                        <!-- Map Controls -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">Monster Sightings</h2>
                                <p class="mt-1 text-sm text-gray-600">Explore monster sightings around the world</p>
                            </div>
                        </div>
                        
                        <!-- Map Container -->
                        <div id="map" class="w-full h-[600px] rounded-lg border border-gray-200 overflow-hidden"></div>
                        
                        <!-- Monster Info Panel (Hidden by default) -->
                        <div id="monster-info" class="hidden bg-white border border-gray-200 rounded-lg p-4 shadow-md">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <img id="monster-image" src="" alt="Monster" class="h-24 w-24 object-cover rounded-lg">
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between">
                                        <h3 id="monster-name" class="text-lg font-medium text-gray-900"></h3>
                                        <span id="monster-type" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800"></span>
                                    </div>
                                    <p id="monster-description" class="mt-1 text-sm text-gray-500"></p>
                                    <div class="mt-2 text-xs text-gray-500">
                                        <span>Reported by: <span id="monster-reporter"></span></span>
                                        <span class="ml-4">Sighted on: <span id="monster-date"></span></span>
                                    </div>
                                </div>
                            </div>
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
                container: 'map',
                style: `https://api.maptiler.com/maps/streets/style.json?key=${apiKey}`,
                center: [0, 20], // Default center (will be updated with user location)
                zoom: 2
            });
            
            const monsters = @json($monsters);
            
            const markers = [];
            let userMarker;
            
            monsters.forEach(monster => {
                // Create marker element
                const el = document.createElement('div');
                el.className = 'marker';
                el.style.width = '25px';
                el.style.height = '25px';
                el.style.borderRadius = '50%';
                el.style.backgroundColor = '#EF4444';
                el.style.border = '2px solid white';
                el.style.boxShadow = '0 0 0 2px rgba(0, 0, 0, 0.1)';
                el.style.cursor = 'pointer';
                
                const marker = new maplibregl.Marker({
                    element: el,
                    anchor: 'bottom'
                })
                .setLngLat([monster.longitude, monster.latitude])
                .addTo(map);
                
                // Add click event to show monster info
                marker.getElement().addEventListener('click', () => {
                    document.getElementById('monster-name').textContent = monster.name;
                    document.getElementById('monster-type').textContent = monster.monster_type;
                    document.getElementById('monster-description').textContent = monster.description;
                    document.getElementById('monster-image').src = `{{ asset('storage/') }}` + '/' + monster.image;
                    document.getElementById('monster-reporter').textContent = monster.user.name; // You might want to fetch the actual user name
                    document.getElementById('monster-date').textContent = new Date(monster.created_at).toLocaleDateString();
                    
                    document.getElementById('monster-info').classList.remove('hidden');
                    
                    map.flyTo({
                        center: [monster.longitude, monster.latitude],
                        zoom: 14,
                        essential: true
                    });
                });
                
                markers.push({
                    marker,
                    data: monster
                });
            });
            
            function createUserMarker(lat, lng) {
                if (userMarker) {
                    userMarker.remove();
                }
                
                userMarker = new maplibregl.Marker({
                    anchor: 'center'
                })
                .setLngLat([lng, lat])
                .addTo(map);
                
                return userMarker;
            }
            
            function getUserLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(position => {
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;
                        
                        createUserMarker(userLat, userLng);
                        
                        map.flyTo({
                            center: [userLng, userLat],
                            zoom: 11,
                            essential: true
                        });
                        
                        window.userCoordinates = {
                            lat: userLat,
                            lng: userLng
                        };
                        
                    }, error => {
                        console.error('Error getting location:', error);
                        alert('Unable to get your location. Please check your browser permissions.');
                    });
                } else {
                    alert('Geolocation is not supported by your browser.');
                }
            }
            
            map.on('load', function() {
                getUserLocation();
            });
        });
    </script>
    
    <style>
        /* Pulse animation for markers */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
            }
            70% {
                box-shadow: 0 0 0 15px rgba(255, 255, 255, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
            }
        }
        
        .pulse {
            animation: pulse 1.5s infinite;
        }

        /* User marker styles */
        .user-marker {
            position: relative;
        }

        .user-marker-pulse {
            position: absolute;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.3);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: user-pulse 2s infinite;
            z-index: -1;
        }

        @keyframes user-pulse {
            0% {
                transform: translate(-50%, -50%) scale(0.5);
                opacity: 1;
            }
            100% {
                transform: translate(-50%, -50%) scale(1.5);
                opacity: 0;
            }
        }
    </style>
    @endpush
</x-user-layout>

