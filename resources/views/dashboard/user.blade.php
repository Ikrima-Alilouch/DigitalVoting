@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-6">User Dashboard</h1>
    <div class="flex space-x-4">
        <a href="{{ route('votes.index') }}" class="px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700">Vote</a>
        <a href="{{ route('votes.overview') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700">My Votes</a>
    </div>
</div>
@endsection 