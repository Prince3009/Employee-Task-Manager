@extends('layout.app')

@section('content')
    <h2>Edit Task</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
        @csrf
        @method('PUT')

        <label>Title:</label>
        <input type="text" name="title" value="{{ $task->title }}" required><br>

        <label>Description:</label>
        <textarea name="description">{{ $task->description }}</textarea><br>

        <label>Assign To:</label>
        <select name="assigned_to">
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" {{ $task->assigned_to == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
            @endforeach
        </select><br>

        <label>Deadline:</label>
        <input type="date" name="deadline" value="{{ $task->deadline }}"><br>

        <label>Status:</label>
        <select name="status">
            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
        </select><br><br>

        <button type="submit">Update Task</button>
    </form>
@endsection
