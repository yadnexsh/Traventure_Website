@extends('layouts.admin')
@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('admin.treks.index') }}" class="inline-flex items-center text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Treks
    </a>
</div>

<div class="mb-6">
    <h1 class="text-2xl font-bold text-text-primary tracking-tight">Edit Trek: {{ $trek->title }}</h1>
    <p class="text-sm text-text-secondary mt-1">Modify trek details and publishing status.</p>
</div>

<div class="bg-bg-base shadow-sm border border-border-subtle rounded-xl overflow-hidden max-w-4xl">
    <form method="POST" action="{{ route('admin.treks.update', $trek) }}" class="p-6">
        @csrf @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="title" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Title</label>
                <input type="text" name="title" id="title" required value="{{ old('title', $trek->title) }}" class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
            </div>

            <div>
                <label for="slug" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Slug</label>
                <input type="text" name="slug" id="slug" required value="{{ old('slug', $trek->slug) }}" class="block w-full text-sm font-mono border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50 bg-bg-surface">
                <p class="mt-2 text-xs text-text-secondary">Used in the public URL. Only lowercase letters, numbers, and hyphens.</p>
            </div>

            <div>
                <label for="price" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Price (INR)</label>
                <input type="number" name="price" id="price" required value="{{ old('price', $trek->price) }}" min="0" class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
            </div>

            <div>
                <label for="duration" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Duration (Days)</label>
                <input type="number" name="duration" id="duration" value="{{ old('duration', $trek->duration) }}" min="1" class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
            </div>

            <div>
                <label for="difficulty" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Difficulty</label>
                <select name="difficulty" id="difficulty" class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
                    <option value="">Select difficulty...</option>
                    <option value="Easy" {{ old('difficulty', $trek->difficulty) === 'Easy' ? 'selected' : '' }}>Easy</option>
                    <option value="Moderate" {{ old('difficulty', $trek->difficulty) === 'Moderate' ? 'selected' : '' }}>Moderate</option>
                    <option value="Hard" {{ old('difficulty', $trek->difficulty) === 'Hard' ? 'selected' : '' }}>Hard</option>
                    <option value="Expert" {{ old('difficulty', $trek->difficulty) === 'Expert' ? 'selected' : '' }}>Expert</option>
                </select>
                <p class="mt-2 text-xs text-text-secondary">Required when publishing.</p>
            </div>

            <div>
                <label for="published_status" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Status</label>
                <select name="published_status" id="published_status" required class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
                    <option value="draft" {{ old('published_status', $trek->published_status) === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('published_status', $trek->published_status) === 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>
            
            <div class="md:col-span-2">
                <label for="summary" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Summary</label>
                <textarea name="summary" id="summary" rows="4" class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">{{ old('summary', $trek->summary) }}</textarea>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-border-subtle flex flex-col sm:flex-row justify-between items-center gap-4">
            <a href="{{ route('admin.treks.show', $trek) }}" class="text-sm font-medium text-brand-primary hover:text-brand-primary/80 transition-colors">Review Details</a>
            <div class="flex gap-3 w-full sm:w-auto">
                <a href="{{ route('admin.treks.index') }}" class="flex-1 sm:flex-none inline-flex justify-center px-4 py-2 border border-border-subtle shadow-sm text-sm font-medium rounded-lg text-text-primary bg-bg-base hover:bg-bg-subtle focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transition-colors">Cancel</a>
                <button type="submit" class="flex-1 sm:flex-none inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-brand-primary hover:bg-brand-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transition-colors">Save Changes</button>
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
