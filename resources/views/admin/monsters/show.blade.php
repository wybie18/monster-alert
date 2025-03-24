<x-app-layout>
    <x-slot name="header">Monster Sighting Details</x-slot>

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <img src="{{ asset('storage/'.$monster->image) }}" alt="{{ $monster->name }}" class="w-full h-96 object-cover rounded-lg shadow-md">
            </div>
            
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $monster->name }}</h2>
                
                <div class="space-y-4">
                    <div>
                        <span class="text-sm font-medium text-gray-500">Monster Type</span>
                        <p class="text-lg text-gray-900">{{ $monster->monster_type }}</p>
                    </div>

                    <div>
                        <span class="text-sm font-medium text-gray-500">Description</span>
                        <p class="text-gray-700">{{ $monster->description }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Latitude</span>
                            <p class="text-gray-900">{{ $monster->latitude }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Longitude</span>
                            <p class="text-gray-900">{{ $monster->longitude }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('monsters.edit', $monster->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600">
                        Edit Sighting
                    </a>
                    <form action="{{ route('monsters.destroy', $monster->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this sighting?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>