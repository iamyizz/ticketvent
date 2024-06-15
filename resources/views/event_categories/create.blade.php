@extends('layouts.navbar')

@section('title', 'Event Categories')

@section('content')
    <div class="container mt-5">
        <h1>Create New Category</h1>

        <form action="{{ route('event-categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    </div>
@endsection