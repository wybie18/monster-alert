<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <div class="space-y-6">
        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Sightings Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5 flex items-center justify-between">
                    <div>
                        <div class="text-sm font-medium text-gray-500 truncate">
                            Total Sightings
                        </div>
                        <div class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ $totalSightings }}
                        </div>
                    </div>
                    <div class="bg-indigo-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Submissions Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5 flex items-center justify-between">
                    <div>
                        <div class="text-sm font-medium text-gray-500 truncate">
                            Pending Submissions
                        </div>
                        <div class="mt-1 text-3xl font-semibold text-yellow-600">
                            {{ $pendingSubmissions }}
                        </div>
                    </div>
                    <div class="bg-yellow-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Unique Monster Types Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5 flex items-center justify-between">
                    <div>
                        <div class="text-sm font-medium text-gray-500 truncate">
                            Unique Monster Types
                        </div>
                        <div class="mt-1 text-3xl font-semibold text-green-600">
                            {{ $uniqueMonsterTypes }}
                        </div>
                    </div>
                    <div class="bg-green-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h16M3 8h16M3 12h16M3 16h16M3 20h16" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Recent Sightings -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Recent Sightings
                    </h3>
                    <a href="{{ route('monsters.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">
                        View All
                    </a>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($recentSightings as $sighting)
                        <div class="px-4 py-4 sm:px-6 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/'.$sighting->image) }}" alt="{{ $sighting->name }}" class="h-12 w-12 rounded-full object-cover">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $sighting->name }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $sighting->monster_type }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $sighting->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-4 py-4 sm:px-6 text-center text-gray-500">
                            No recent sightings
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Submissions -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Recent Submissions
                    </h3>
                    <a href="{{ route('submissions.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">
                        View All
                    </a>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($recentSubmissions as $submission)
                        <div class="px-4 py-4 sm:px-6 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/'.$submission->image) }}" alt="{{ $submission->name }}" class="h-12 w-12 rounded-full object-cover">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $submission->name }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Submitted by {{ $submission->user->name }}
                                        </p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="px-4 py-4 sm:px-6 text-center text-gray-500">
                            No pending submissions
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>