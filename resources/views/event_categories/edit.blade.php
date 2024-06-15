@extends('layouts.navbar')

@section('title', 'Event Categories')

@section('content')
    <div class="container mt-5">
        <h1>Edit Category</h1>

        <form action="{{ route('event-categories.update', $eventCategory->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $eventCategory->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
    </div>
@endsection