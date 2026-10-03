@extends('layouts.admin')
@section('content')
<h1>Edit Trek</h1>
<form method="POST" action="{{ route('admin.treks.update', $trek) }}">
  @csrf @method('PUT')
  <input name="title" value="{{ $trek->title }}" required>
  <input name="slug" value="{{ $trek->slug }}" required>
  <input type="number" name="price" value="{{ $trek->price }}" required>
  <select name="published_status">
    <option value="draft" @if($trek->published_status == 'draft') selected @endif>Draft</option>
    <option value="published" @if($trek->published_status == 'published') selected @endif>Published</option>
  </select>
  <button type="submit">Save</button>
</form>
@endsection
