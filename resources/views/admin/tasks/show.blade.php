@extends('layout.app')

@section('content')
    <h2>Task Details</h2>

    <p><strong>Title:</strong> {{ $task->title }}</p>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>Assigned To:</strong> {{ $task->employee->name ?? 'Unassigned' }}</p>
    <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
    <p><strong>Deadline:</strong> {{ $task->deadline }}</p>

    @if(auth()->user()->role === 'employee' && auth()->user()->id === $task->assigned_to)
        <form method="POST" action="{{ route('tasks.updateStatus', $task->id) }}">
            @csrf
            @method('PUT')

            <label>Update Status:</label>
            <select name="status">
                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>

            <button type="submit">Update</button>
        </form>
    @endif
@endsection
