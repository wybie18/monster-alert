<x-user-layout>
    <x-slot name="header">Report Monster Sighting</x-slot>

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 flex flex-col gap-2"></div>

    <div class="space-y-6">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h2 class="text-lg font-medium text-gray-900">
                            Report a Monster Sighting
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Spotted something unusual? Fill out this form to report a monster sighting.
                        </p>

                        <form method="POST" action="{{ route('user.report.store') }}" class="mt-6 space-y-6"
                            enctype="multipart/form-data">
                            @csrf

                            <div>
                                <x-input-label for="name" :value="__('Monster Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="monster_type" :value="__('Monster Type')" />
                                <select id="monster_type" name="monster_type"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="aquatic">Aquatic</option>
                                    <option value="aerial">Aerial</option>
                                    <option value="terrestrial">Terrestrial</option>
                                    <option value="subterranean">Subterranean</option>
                                    <option value="ethereal">Ethereal</option>
                                    <option value="unknown">Unknown</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('monster_type')" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" rows="4"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                <p class="mt-1 text-sm text-gray-500">Describe what you saw, including size, color,
                                    behavior, and any other notable features.</p>
                            </div>

                            <div>
                                <x-input-label for="image" :value="__('Image Evidence')" />
                                <div class="mt-2 flex flex-col items-center">
                                    <div class="w-full">
                                        <label
                                            class="flex justify-center w-full h-32 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-indigo-500 focus:outline-none">
                                            <span class="flex flex-col items-center space-y-2 pt-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <span class="font-medium text-gray-600">
                                                    Drop files to upload, or
                                                    <span class="text-indigo-600 underline">browse</span>
                                                </span>
                                                <span id="file-chosen" class="text-xs text-gray-500">No file
                                                    chosen</span>
                                            </span>
                                            <input type="file" name="image" id="image" accept="image/*"
                                                class="hidden" />
                                        </label>
                                    </div>
                                    <div class="mt-4 w-full">
                                        <button type="button" id="camera-button"
                                            class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            Take Photo
                                        </button>
                                    </div>
                                </div>
                                <div id="camera-container" class="mt-4 hidden">
                                    <div id="camera-status" class="mb-2 text-sm text-indigo-600 hidden">
                                        Requesting camera access...
                                    </div>
                                    <video id="camera-preview" class="w-full rounded-md" autoplay playsinline></video>
                                    <div class="mt-2 flex justify-center">
                                        <button type="button" id="capture-button"
                                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Capture Photo
                                        </button>
                                        <button type="button" id="cancel-camera"
                                            class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                                <div id="preview-container" class="mt-4 hidden">
                                    <p class="text-sm font-medium text-gray-700">Preview:</p>
                                    <img id="image-preview" class="mt-1 w-full h-auto rounded-md" src="#"
                                        alt="Preview">
                                    <button type="button" id="retake-button"
                                        class="mt-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Retake
                                    </button>
                                </div>
                                <canvas id="canvas" class="hidden"></canvas>
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>

                            <div>
                                <x-input-label :value="__('Location')" />
                                <p class="text-sm text-gray-500 mb-2">We'll use your current location or you can select
                                    on the map</p>
                                <div id="map" class="h-64 w-full rounded-md mb-2"></div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="latitude" :value="__('Latitude')" />
                                        <x-text-input id="latitude" name="latitude" type="text"
                                            class="mt-1 block w-full" required readonly />
                                    </div>
                                    <div>
                                        <x-input-label for="longitude" :value="__('Longitude')" />
                                        <x-text-input id="longitude" name="longitude" type="text"
                                            class="mt-1 block w-full" required readonly />
                                    </div>
                                </div>
                                <button type="button" id="get-location"
                                    class="mt-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Use My Current Location
                                </button>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Submit Report') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
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
                            if (cameraContainer) {
                                cameraContainer.classList.add('hidden');
                            }
                        }
                        fileChosen.textContent = this.files[0].name;
                        reader.readAsDataURL(this.files[0]);
                    }
                });

                // Camera functionality
                const cameraButton = document.getElementById('camera-button');
                const cameraContainer = document.getElementById('camera-container');
                const cameraPreview = document.getElementById('camera-preview');
                const cameraStatus = document.getElementById('camera-status');
                const captureButton = document.getElementById('capture-button');
                const cancelCamera = document.getElementById('cancel-camera');
                const retakeButton = document.getElementById('retake-button');
                const canvas = document.getElementById('canvas');
                let stream = null;

                // Check if camera is available
                function checkCameraAvailability() {
                    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                        showToast(
                            "Your browser doesn't support camera access. Please use a modern browser or upload an image instead.",
                            'error');
                        cameraButton.disabled = true;
                        cameraButton.classList.add('opacity-50', 'cursor-not-allowed');
                        return false;
                    }
                    return true;
                }

                // Initialize camera check
                checkCameraAvailability();

                cameraButton.addEventListener('click', async function() {
                    if (!checkCameraAvailability()) return;

                    // Show status while requesting camera
                    cameraStatus.classList.remove('hidden');
                    cameraContainer.classList.remove('hidden');
                    previewContainer.classList.add('hidden');

                    try {
                        // First try with ideal facing mode (for mobile)
                        try {
                            stream = await navigator.mediaDevices.getUserMedia({
                                video: {
                                    facingMode: {
                                        ideal: "environment"
                                    },
                                    width: {
                                        ideal: 1280
                                    },
                                    height: {
                                        ideal: 720
                                    }
                                }
                            });
                        } catch (err) {
                            // Fallback to any camera
                            stream = await navigator.mediaDevices.getUserMedia({
                                video: true
                            });
                        }

                        cameraPreview.srcObject = stream;
                        cameraStatus.classList.add('hidden');

                        // Make sure video is ready before allowing capture
                        cameraPreview.onloadedmetadata = function() {
                            captureButton.disabled = false;
                        };

                    } catch (err) {
                        console.error("Error accessing camera: ", err);
                        cameraContainer.classList.add('hidden');
                        showToast(
                            "Could not access camera. Please check permissions or use file upload instead.",
                            'error');

                        // Log more detailed error for debugging
                        if (err.name === 'NotAllowedError') {
                            console.log("Camera permission denied by user or system");
                        } else if (err.name === 'NotFoundError') {
                            console.log("No camera found on this device");
                        } else if (err.name === 'NotReadableError') {
                            console.log("Camera is already in use by another application");
                        } else if (err.name === 'OverconstrainedError') {
                            console.log("Camera constraints cannot be satisfied");
                        } else if (err.name === 'SecurityError') {
                            console.log("Camera use blocked by browser security");
                        } else if (err.name === 'TypeError') {
                            console.log("Invalid constraints or parameters");
                        }
                    }
                });

                captureButton.addEventListener('click', function() {
                    if (!stream) return;

                    const context = canvas.getContext('2d');

                    // Set canvas dimensions to match video
                    canvas.width = cameraPreview.videoWidth;
                    canvas.height = cameraPreview.videoHeight;

                    // Draw the video frame to the canvas
                    context.drawImage(cameraPreview, 0, 0, canvas.width, canvas.height);

                    // Convert canvas to image data URL
                    const imageDataUrl = canvas.toDataURL('image/png');

                    // Display the captured image
                    imagePreview.setAttribute('src', imageDataUrl);

                    // Create a file from the data URL
                    fetch(imageDataUrl)
                        .then(res => res.blob())
                        .then(blob => {
                            const file = new File([blob], "camera-capture.png", {
                                type: "image/png"
                            });

                            // Create a DataTransfer object to set the file input
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);
                            fileInput.files = dataTransfer.files;
                            fileChosen.textContent = "camera-capture.png";

                            showToast("Photo captured successfully!", 'success');
                        })
                        .catch(err => {
                            console.error("Error creating file from capture:", err);
                            showToast("Error saving captured photo", 'error');
                        });

                    // Stop the camera and show preview
                    stopCamera();
                    previewContainer.classList.remove('hidden');
                    cameraContainer.classList.add('hidden');
                });

                cancelCamera.addEventListener('click', function() {
                    stopCamera();
                    cameraContainer.classList.add('hidden');
                });

                retakeButton.addEventListener('click', function() {
                    previewContainer.classList.add('hidden');
                    cameraButton.click();
                });

                function stopCamera() {
                    if (stream) {
                        stream.getTracks().forEach(track => track.stop());
                        stream = null;
                    }
                }

                // Clean up when leaving the page
                window.addEventListener('beforeunload', function() {
                    stopCamera();
                });

                initMap();
            });

            let map, marker;

            function initMap() {
                const mapTilerKey = '{{ config('app.maptiler_api_key') }}';

                const defaultLocation = [0, 0]; // [longitude, latitude] - MapLibre uses this order

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

                // Add navigation controls
                map.addControl(new maplibregl.NavigationControl());

                // Add geolocate control
                const geolocate = new maplibregl.GeolocateControl({
                    positionOptions: {
                        enableHighAccuracy: true
                    },
                    trackUserLocation: true
                });
                map.addControl(geolocate);

                // Create a marker that can be moved
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

                // Allow clicking on map to move marker
                map.on('click', function(e) {
                    marker.setLngLat(e.lngLat);
                    updateCoordinates(e.lngLat);
                });

                // When map loads, try to get user location
                map.on('load', function() {
                    // Try to trigger the geolocate control after the map loads
                    setTimeout(() => {
                        geolocate.trigger();
                    }, 1000);
                });

                geolocate.on('geolocate', function(e) {
                    const lng = e.coords.longitude;
                    const lat = e.coords.latitude;
                    marker.setLngLat([lng, lat]);
                    updateCoordinates({
                        lng,
                        lat
                    });

                    if (window.showToast) {
                        window.showToast("Location found!", 'success');
                    }
                });

                document.getElementById('get-location').addEventListener('click', function() {
                    geolocate.trigger();
                });
            }

            function updateCoordinates(lngLat) {
                document.getElementById('latitude').value = lngLat.lat.toFixed(7);
                document.getElementById('longitude').value = lngLat.lng.toFixed(7);
            }
        </script>
    @endpush
</x-user-layout>
