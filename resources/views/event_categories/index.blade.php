@extends('layouts.navbar')

@section('title', 'Event Categories')

@section('content')
    <h1>Event Categories</h1>
    <a href="{{ route('event-categories.create') }}" class="btn btn-success mb-3">Create New Category</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($categories->isEmpty())
        <p>Tidak ada kategori yang tersedia</p>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('event-categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('event-categories.destroy', $category->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
@endsection