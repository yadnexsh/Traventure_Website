@extends('layouts.public')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h1 class="text-2xl leading-6 font-bold text-gray-900">Express Interest</h1>
        <p class="mt-1 text-sm text-gray-500">
            {{ $departure->trek->title }} ({{ $departure->start_time->format('M d, Y') }} - {{ $departure->end_time->format('M d, Y') }})
        </p>
    </div>
    
    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
        <p class="mb-6 text-gray-700">This departure is currently fully booked. If you leave your contact details below, we will let you know if any spots become available.</p>
        
        <form action="{{ route('interest.store', $departure) }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <div class="mt-1">
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <div class="mt-1">
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number (Optional)</label>
                <div class="mt-1">
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                @error('phone')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="consent_status" name="consent_status" type="checkbox" value="1" required class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                </div>
                <div class="ml-3 text-sm">
                    <label for="consent_status" class="font-medium text-gray-700">I agree that Traventure may use my contact details to contact me about availability or updates for this trek.</label>
                </div>
            </div>
            @error('consent_status')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <div class="pt-4 flex items-center justify-end">
                <a href="{{ route('treks.show', $departure->trek->slug) }}" class="text-sm text-indigo-600 hover:text-indigo-900 mr-4">Cancel</a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit Interest
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
