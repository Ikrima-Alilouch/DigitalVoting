@extends('layouts.app')

@section('content')
    <div id="mainContent" class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 transition-all duration-300 ease-in-out">
        <div class="px-4 py-6 sm:px-0">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Political Parties</h1>
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if($parties->isEmpty())
                <p>There are no parties.</p>
            @else
                <form action="{{ route('votes.store') }}" method="POST" id="votingForm">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($parties as $party)
                            <div class="bg-white overflow-hidden shadow rounded-lg cursor-pointer hover:shadow-lg transition-shadow duration-300 party-card" 
                                 data-party-id="{{ $party->partyID }}">
                                <div class="p-6">
                                    <div class="flex items-center space-x-4">
                                        @if($party->logo)
                                            <img class="h-16 w-16 rounded-full object-cover" src="{{ asset('storage/' . $party->logo) }}" alt="{{ $party->name }}">
                                        @endif
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">{{ $party->name }}</h3>
                                            <p class="text-sm text-gray-500">
                                                Leader: {{ $party->leader_firstname }}
                                                {{ $party->leader_infix ? $party->leader_infix . ' ' : '' }}
                                                {{ $party->leader_lastname }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <p class="text-sm text-gray-600">{{ Str::limit($party->description, 100) }}</p>
                                    </div>

                                    <div class="mt-4">
                                        <input type="checkbox" name="selected_parties[]" value="{{ $party->partyID }}" 
                                               class="party-checkbox hidden">
                                        <button type="button" class="select-party-btn w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors duration-300">
                                            Select Party
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 text-center">
                        <p class="text-gray-600 mb-4">You must select exactly 3 parties</p>
                        <button type="submit" id="submitVote" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300" disabled>
                            Submit Vote
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full mx-4">
            <h2 class="text-2xl font-bold mb-4">Confirm Your Vote</h2>
            <p class="mb-4">You have selected the following parties:</p>
            <ul id="selectedPartiesList" class="mb-6 space-y-2"></ul>
            <div class="flex justify-end space-x-4">
                <button type="button" id="cancelVote" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    Cancel
                </button>
                <button type="button" id="confirmVote" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Confirm Vote
                </button>
            </div>
        </div>
    </div>

    <!-- Thank You Modal -->
    <div id="thankYouModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full mx-4 text-center">
            <h2 class="text-2xl font-bold mb-4">Thank You for Voting!</h2>
            <p class="mb-6">Your vote has been successfully recorded.</p>
            <button type="button" id="closeThankYou" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Close
            </button>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const partyCards = document.querySelectorAll('.party-card');
            const submitButton = document.getElementById('submitVote');
            const confirmationModal = document.getElementById('confirmationModal');
            const thankYouModal = document.getElementById('thankYouModal');
            const selectedPartiesList = document.getElementById('selectedPartiesList');
            const form = document.getElementById('votingForm');
            let selectedParties = new Set();

            // Handle party selection
            partyCards.forEach(card => {
                const checkbox = card.querySelector('.party-checkbox');
                const button = card.querySelector('.select-party-btn');
                const partyId = card.dataset.partyId;
                const partyName = card.querySelector('h3').textContent;

                button.addEventListener('click', () => {
                    if (checkbox.checked) {
                        // Deselect
                        checkbox.checked = false;
                        button.textContent = 'Select Party';
                        button.classList.remove('bg-blue-600', 'text-white');
                        button.classList.add('bg-gray-100', 'text-gray-700');
                        selectedParties.delete(partyId);
                    } else {
                        // Check if we already have 3 parties selected
                        if (selectedParties.size >= 3) {
                            alert('You can only select 3 parties. Please deselect one first.');
                            return;
                        }
                        // Select
                        checkbox.checked = true;
                        button.textContent = 'Selected';
                        button.classList.remove('bg-gray-100', 'text-gray-700');
                        button.classList.add('bg-blue-600', 'text-white');
                        selectedParties.add(partyId);
                    }
                    updateSubmitButton();
                });
            });

            // Update submit button state
            function updateSubmitButton() {
                submitButton.disabled = selectedParties.size !== 3;
            }

            // Handle form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (selectedParties.size !== 3) {
                    alert('Please select exactly 3 parties.');
                    return;
                }

                // Update confirmation modal content
                selectedPartiesList.innerHTML = '';
                selectedParties.forEach(partyId => {
                    const card = document.querySelector(`[data-party-id="${partyId}"]`);
                    const partyName = card.querySelector('h3').textContent;
                    selectedPartiesList.innerHTML += `<li>${partyName}</li>`;
                });

                // Show confirmation modal
                confirmationModal.classList.remove('hidden');
                confirmationModal.classList.add('flex');
            });

            // Handle confirmation
            document.getElementById('confirmVote').addEventListener('click', () => {
                form.submit();
            });

            // Handle cancellation
            document.getElementById('cancelVote').addEventListener('click', () => {
                confirmationModal.classList.add('hidden');
                confirmationModal.classList.remove('flex');
            });

            // Handle thank you modal
            document.getElementById('closeThankYou').addEventListener('click', () => {
                thankYouModal.classList.add('hidden');
                thankYouModal.classList.remove('flex');
                window.location.href = '/';
            });
        });
    </script>
    @endpush
@endsection

