@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[60vh]">
    <div class="bg-white p-8 rounded-lg shadow-md text-center">
        <h1 class="text-3xl font-bold text-green-600 mb-4">Thank You for Voting!</h1>
        <p class="text-lg text-gray-700 mb-6">Your vote has been successfully submitted.</p>
        <a href="{{ route('homepage') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Back to Homepage</a>
    </div>
</div>
@endsection 