@extends('layouts.navbar')

@section('title', 'Events')

@section('content')
    <div class="container mt-5">
        <h1>Event Details</h1>
        <table class="table table-bordered">
            <tr>
                <th>Name:</th>
                <td>{{ $event->name }}</td>
            </tr>
            <tr>
                <th>Category:</th>
                <td>{{ $event->category->name }}</td>
            </tr>
            <tr>
                <th>Description:</th>
                <td>{{ $event->description }}</td>
            </tr>
            <tr>
                <th>Start Time:</th>
                <td>{{ $event->start_time }}</td>
            </tr>
            <tr>
                <th>End Time:</th>
                <td>{{ $event->end_time }}</td>
            </tr>
        </table>
        <a href="{{ route('events.index') }}" class="btn btn-primary">Back to List</a>
    </div>
@endsection