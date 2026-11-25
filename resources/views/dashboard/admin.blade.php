@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>
    <div class="flex space-x-4">
        <a href="{{ route('admin.parties.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">Create Party</a>
        <a href="{{ route('votes.overview') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700">Vote Overview</a>
    </div>
</div>
@endsection 