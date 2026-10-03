@extends('layouts.admin')
@section('content')
<h1>Create Trek</h1>
<form method="POST" action="{{ route('admin.treks.store') }}">
  @csrf
  <input name="title" required>
  <input name="slug" required>
  <input type="number" name="price" value="1000" required>
  <select name="published_status"><option value="draft">Draft</option><option value="published">Published</option></select>
  <button type="submit">Save</button>
</form>
@endsection
