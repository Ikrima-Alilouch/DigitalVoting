@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Voting Overview</h1>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- User's Votes Section -->
            <div class="bg-white shadow rounded-lg mb-8">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-900">Your Votes</h2>
                        @if($userVotes->isNotEmpty())
                            <form action="{{ route('votes.destroy') }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to remove your votes?')"
                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-300">
                                    Remove My Votes
                                </button>
                            </form>
                        @endif
                    </div>

                    @if($userVotes->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($userVotes as $vote)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center space-x-4">
                                        @if($vote->party)
                                            @if($vote->party->logo)
                                                <img class="h-16 w-16 rounded-full object-cover" 
                                                     src="{{ asset('storage/' . $vote->party->logo) }}" 
                                                     alt="{{ $vote->party->name }}">
                                            @endif
                                            <div>
                                                <h3 class="text-lg font-medium text-gray-900">{{ $vote->party->name }}</h3>
                                                <p class="text-sm text-gray-500">
                                                    Leader: {{ $vote->party->leader_firstname }}
                                                    {{ $vote->party->leader_infix ? $vote->party->leader_infix . ' ' : '' }}
                                                    {{ $vote->party->leader_lastname }}
                                                </p>
                                            </div>
                                        @else
                                            <div>
                                                <h3 class="text-lg font-medium text-gray-900 text-red-500">[Party deleted]</h3>
                                                <p class="text-sm text-gray-500">This party no longer exists.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">You haven't cast your votes yet.</p>
                        <a href="{{ route('votes.index') }}" 
                           class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            Cast Your Votes
                        </a>
                    @endif
                </div>
            </div>

            <!-- All Parties Section -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">All Parties</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($parties as $party)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center space-x-4">
                                    @if($party->logo)
                                        <img class="h-12 w-12 rounded-full object-cover" 
                                             src="{{ asset('storage/' . $party->logo) }}" 
                                             alt="{{ $party->name }}">
                                    @endif
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">{{ $party->name }}</h3>
                                        <p class="text-sm text-gray-500">Votes: {{ $party->votes_count }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 