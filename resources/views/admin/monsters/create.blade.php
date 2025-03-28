<x-app-layout>
    <x-slot name="header">Create New Monster Record</x-slot>

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 flex flex-col gap-2"></div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        Add New Monster Record
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Create a new monster sighting record in the database.
                    </p>

                    <form method="POST" action="{{ route('monsters.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Monster Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name') }}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="monster_type" :value="__('Monster Type')" />
                            <select id="monster_type" name="monster_type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="dangerous" {{ old('monster_type') == 'dangerous' ? 'selected' : '' }}>Dangerous</option>
                                <option value="caution" {{ old('monster_type') == 'caution' ? 'selected' : '' }}>Caution</option>
                                <option value="friendly" {{ old('monster_type') == 'friendly' ? 'selected' : '' }}>Friendly</option>
                                <option value="unknown" {{ old('monster_type') == 'unknown' ? 'selected' : '' }}>Unknown</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('monster_type')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            <p class="mt-1 text-sm text-gray-500">Describe the monster, including size, color, behavior, and any other notable features.</p>
                        </div>

                        <div>
                            <x-input-label for="image" :value="__('Monster Image')" />
                            <div class="mt-2 flex flex-col items-center">
                                <div class="w-full">
                                    <label class="flex justify-center w-full h-32 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-indigo-500 focus:outline-none">
                                        <span class="flex flex-col items-center space-y-2 pt-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <span class="font-medium text-gray-600">
                                                Drop files to upload, or
                                                <span class="text-indigo-600 underline">browse</span>
                                            </span>
                                            <span id="file-chosen" class="text-xs text-gray-500">No file chosen</span>
                                        </span>
                                        <input type="file" name="image" id="image" accept="image/*" class="hidden" required />
                                    </label>
                                </div>
                            </div>
                            <div id="preview-container" class="mt-4 hidden">
                                <p class="text-sm font-medium text-gray-700">Preview:</p>
                                <img id="image-preview" class="mt-1 w-full h-auto max-h-48 object-contain rounded-md" src="#" alt="Preview">
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div>
                            <x-input-label :value="__('Location')" />
                            <p class="text-sm text-gray-500 mb-2">Select the location on the map</p>
                            <div id="map" class="h-64 w-full rounded-md mb-2"></div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="latitude" :value="__('Latitude')" />
                                    <x-text-input id="latitude" name="latitude" type="text" class="mt-1 block w-full" value="{{ old('latitude') }}" required readonly/>
                                    <x-input-error class="mt-2" :messages="$errors->get('latitude')" />
                                </div>
                                <div>
                                    <x-input-label for="longitude" :value="__('Longitude')" />
                                    <x-text-input id="longitude" name="longitude" type="text" class="mt-1 block w-full" value="{{ old('longitude') }}" required readonly/>
                                    <x-input-error class="mt-2" :messages="$errors->get('longitude')" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Create Record') }}</x-primary-button>
                            <a href="{{ route('monsters.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 transition">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <!-- MapTiler and Mapbox GL JS -->
        <link href="https://cdn.maptiler.com/maplibre-gl-js/v2.4.0/maplibre-gl.css" rel="stylesheet" />
        <script src="https://cdn.maptiler.com/maplibre-gl-js/v2.4.0/maplibre-gl.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Check for flash messages and display toast
                @if (session('success'))
                    showToast("{{ session('success') }}", 'success');
                @endif

                @if (session('error'))
                    showToast("{{ session('error') }}", 'error');
                @endif

                @if ($errors->any())
                    showToast("Please check the form for errors.", 'error');
                @endif

                // Toast notification function
                function showToast(message, type = 'success') {
                    const toastContainer = document.getElementById('toast-container');

                    // Create toast element
                    const toast = document.createElement('div');
                    toast.className = `flex items-center p-4 mb-4 rounded-lg shadow-lg transition-all transform translate-x-0 ${
                    type === 'success' 
                        ? 'bg-green-50 text-green-800 border-l-4 border-green-500' 
                        : 'bg-red-50 text-red-800 border-l-4 border-red-500'
                }`;

                    // Toast icon
                    const iconSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                    iconSvg.setAttribute('class', 'w-5 h-5 mr-2');
                    iconSvg.setAttribute('fill', 'currentColor');
                    iconSvg.setAttribute('viewBox', '0 0 20 20');

                    const iconPath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                    if (type === 'success') {
                        iconPath.setAttribute('fill-rule', 'evenodd');
                        iconPath.setAttribute('d',
                            'M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z'
                            );
                        iconPath.setAttribute('clip-rule', 'evenodd');
                    } else {
                        iconPath.setAttribute('fill-rule', 'evenodd');
                        iconPath.setAttribute('d',
                            'M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z'
                            );
                        iconPath.setAttribute('clip-rule', 'evenodd');
                    }

                    iconSvg.appendChild(iconPath);
                    toast.appendChild(iconSvg);

                    // Toast message
                    const messageSpan = document.createElement('span');
                    messageSpan.className = 'text-sm font-medium flex-grow';
                    messageSpan.textContent = message;
                    toast.appendChild(messageSpan);

                    // Close button
                    const closeButton = document.createElement('button');
                    closeButton.className =
                        'ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex h-8 w-8 text-gray-500 hover:text-gray-700';
                    closeButton.setAttribute('aria-label', 'Close');

                    const closeSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                    closeSvg.setAttribute('class', 'w-5 h-5');
                    closeSvg.setAttribute('fill', 'currentColor');
                    closeSvg.setAttribute('viewBox', '0 0 20 20');

                    const closePath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                    closePath.setAttribute('fill-rule', 'evenodd');
                    closePath.setAttribute('d',
                        'M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z'
                        );
                    closePath.setAttribute('clip-rule', 'evenodd');

                    closeSvg.appendChild(closePath);
                    closeButton.appendChild(closeSvg);

                    closeButton.addEventListener('click', function() {
                        toast.classList.add('opacity-0', 'translate-x-full');
                        setTimeout(() => {
                            toast.remove();
                        }, 300);
                    });

                    toast.appendChild(closeButton);

                    // Add toast to container
                    toastContainer.appendChild(toast);

                    // Animate in
                    setTimeout(() => {
                        toast.classList.add('opacity-100');
                    }, 10);

                    // Auto remove after 5 seconds
                    setTimeout(() => {
                        toast.classList.add('opacity-0', 'translate-x-full');
                        setTimeout(() => {
                            toast.remove();
                        }, 300);
                    }, 5000);
                }

                // File upload preview
                const fileInput = document.getElementById('image');
                const fileChosen = document.getElementById('file-chosen');
                const imagePreview = document.getElementById('image-preview');
                const previewContainer = document.getElementById('preview-container');

                fileInput.addEventListener('change', function(e) {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.setAttribute('src', e.target.result);
                            previewContainer.classList.remove('hidden');
                        }
                        fileChosen.textContent = this.files[0].name;
                        reader.readAsDataURL(this.files[0]);
                    }
                });

                initMap();
            });

            let map, marker;

            function initMap() {
                const mapTilerKey = '{{ config('app.maptiler_api_key') }}';

                const defaultLocation = [125.9764127, 8.5037750];

                maplibregl.setRTLTextPlugin(
                    'https://cdn.maptiler.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.3/mapbox-gl-rtl-text.js',
                    null,
                    true
                );

                map = new maplibregl.Map({
                    container: 'map',
                    style: `https://api.maptiler.com/maps/streets/style.json?key=${mapTilerKey}`,
                    center: defaultLocation,
                    zoom: 2
                });

                map.addControl(new maplibregl.NavigationControl());

                const geolocate = new maplibregl.GeolocateControl({
                    positionOptions: {
                        enableHighAccuracy: true
                    },
                    trackUserLocation: true
                });
                map.addControl(geolocate);

                marker = new maplibregl.Marker({
                        draggable: true
                    })
                    .setLngLat(defaultLocation)
                    .addTo(map);

                // Update coordinates when marker is dragged
                marker.on('dragend', function() {
                    const lngLat = marker.getLngLat();
                    updateCoordinates(lngLat);
                });

                map.on('click', function(e) {
                    marker.setLngLat(e.lngLat);
                    updateCoordinates(e.lngLat);
                });

                const lat = document.getElementById('latitude').value;
                const lng = document.getElementById('longitude').value;
                
                if (lat && lng && !isNaN(lat) && !isNaN(lng)) {
                    marker.setLngLat([lng, lat]);
                    map.flyTo({
                        center: [lng, lat],
                        zoom: 10
                    });
                }
            }

            function updateCoordinates(lngLat) {
                document.getElementById('latitude').value = lngLat.lat.toFixed(7);
                document.getElementById('longitude').value = lngLat.lng.toFixed(7);
            }
        </script>
    @endpush
</x-app-layout>
