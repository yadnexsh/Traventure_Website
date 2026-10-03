@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.treks.index') }}" class="text-indigo-600 hover:text-indigo-900">&larr; Back to Treks</a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden max-w-4xl mx-auto">
    <div class="px-4 py-5 sm:px-6 flex justify-between items-center border-b border-gray-200">
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Trek Details
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                {{ $trek->title }}
            </p>
        </div>
        <div>
            <a href="{{ route('admin.treks.edit', $trek) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">Edit Trek</a>
        </div>
    </div>
    <div class="px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Title</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $trek->title }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Slug</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $trek->slug }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Price (INR)</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">₹{{ number_format($trek->price) }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Status</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $trek->published_status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($trek->published_status) }}
                    </span>
                </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Difficulty</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $trek->difficulty ?? 'N/A' }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Duration (Days)</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $trek->duration ?? 'N/A' }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Summary</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-wrap">{{ $trek->summary ?? 'N/A' }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection
