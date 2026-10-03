@extends('layouts.admin')
@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('admin.treks.index') }}" class="text-indigo-600 hover:text-indigo-900">&larr; Back to Treks</a>
    <h1 class="text-3xl font-bold text-gray-900">Editing: {{ $trek->title }}</h1>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden max-w-4xl mx-auto">
    <form method="POST" action="{{ route('admin.treks.update', $trek) }}" class="space-y-6 px-4 py-5 sm:p-6">
        @csrf @method('PUT')
        
        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" required value="{{ old('title', $trek->title) }}" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" required value="{{ old('slug', $trek->slug) }}" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                <p class="mt-1 text-xs text-gray-500">The slug is used in the public URL (e.g. /treks/your-slug). Only lowercase letters, numbers, and hyphens are allowed.</p>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price (INR)</label>
                <input type="number" name="price" id="price" required value="{{ old('price', $trek->price) }}" min="0" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
            </div>

            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700">Duration (Days)</label>
                <input type="number" name="duration" id="duration" value="{{ old('duration', $trek->duration) }}" min="1" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
            </div>

            <div>
                <label for="difficulty" class="block text-sm font-medium text-gray-700">Difficulty</label>
                <select name="difficulty" id="difficulty" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="">Select difficulty...</option>
                    <option value="Easy" {{ old('difficulty', $trek->difficulty) === 'Easy' ? 'selected' : '' }}>Easy</option>
                    <option value="Moderate" {{ old('difficulty', $trek->difficulty) === 'Moderate' ? 'selected' : '' }}>Moderate</option>
                    <option value="Hard" {{ old('difficulty', $trek->difficulty) === 'Hard' ? 'selected' : '' }}>Hard</option>
                    <option value="Expert" {{ old('difficulty', $trek->difficulty) === 'Expert' ? 'selected' : '' }}>Expert</option>
                </select>
                <p class="mt-1 text-xs text-gray-500">Required when publishing.</p>
            </div>

            <div>
                <label for="published_status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="published_status" id="published_status" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="draft" {{ old('published_status', $trek->published_status) === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('published_status', $trek->published_status) === 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>
        </div>

        <div>
            <label for="summary" class="block text-sm font-medium text-gray-700">Summary</label>
            <textarea name="summary" id="summary" rows="4" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">{{ old('summary', $trek->summary) }}</textarea>
        </div>

        <div class="pt-5 flex justify-between border-t border-gray-200 mt-6">
            <a href="{{ route('admin.treks.show', $trek) }}" class="text-indigo-600 hover:text-indigo-900 flex items-center">Review Details</a>
            <div class="flex gap-3">
                <a href="{{ route('admin.treks.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Save Changes</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        let isSlugManuallyEdited = false;

        if (slugInput.value.trim() !== '') {
            isSlugManuallyEdited = true;
        }

        slugInput.addEventListener('input', function() {
            isSlugManuallyEdited = true;
        });

        titleInput.addEventListener('input', function() {
            if (!isSlugManuallyEdited) {
                slugInput.value = titleInput.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/[\s-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
            }
        });
    });
</script>
@endsection
