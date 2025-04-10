@extends('layout.app')

@section('title', 'Employee Dashboard')

@section('content')
    <div class="container mt-5">
        <h1>Welcome, {{ auth()->user()->name }} 👋</h1>
        <hr>
        <h3>Your Assigned Tasks</h3>

        @if($tasks->isEmpty())
            <p class="text-muted">You have no tasks assigned.</p>
        @else
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                                <span class="badge bg-{{ $task->status === 'completed' ? 'success' : ($task->status === 'in-progress' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td>{{ $task->updated_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
