@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">
                About Our Digital Voting System
            </h1>
            <p class="mt-5 max-w-xl mx-auto text-xl text-gray-500">
                Empowering democracy through secure and accessible digital voting solutions.
            </p>
        </div>

        <!-- Main Content -->
        <div class="mt-16">
            <!-- Mission Section -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h2>
                <p class="text-lg text-gray-600">
                    We are dedicated to revolutionizing the voting process by providing a secure, transparent, and accessible digital voting platform. Our goal is to make voting more convenient while maintaining the highest standards of security and integrity.
                </p>
            </div>

            <!-- Key Features Section -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Key Features</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Secure Voting</h3>
                        <p class="text-gray-600">
                            Our platform employs state-of-the-art encryption and security measures to ensure that every vote is protected and remains confidential.
                        </p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Real-time Results</h3>
                        <p class="text-gray-600">
                            Experience instant vote counting and result updates, providing transparency and immediate feedback to all participants.
                        </p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">User-Friendly Interface</h3>
                        <p class="text-gray-600">
                            Designed with accessibility in mind, our platform is easy to use for voters of all technical abilities.
                        </p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Verification System</h3>
                        <p class="text-gray-600">
                            Robust identity verification ensures that only eligible voters can participate, maintaining the integrity of the voting process.
                        </p>
                    </div>
                </div>
            </div>

            <!-- How It Works Section -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">How It Works</h2>
                <div class="space-y-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                1
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold text-gray-900">Register</h3>
                            <p class="mt-2 text-gray-600">
                                Create your account and verify your identity to ensure secure access to the voting platform.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                2
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold text-gray-900">Access Active Elections</h3>
                            <p class="mt-2 text-gray-600">
                                Browse and participate in current elections that you're eligible to vote in.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                3
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold text-gray-900">Cast Your Vote</h3>
                            <p class="mt-2 text-gray-600">
                                Submit your vote securely and receive confirmation of your participation.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 