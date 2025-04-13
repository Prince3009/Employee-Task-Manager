@extends('layout.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-6">Task Details</h2>

        <div class="space-y-3 text-gray-700">
            <p><strong>Title:</strong> {{ $task->title }}</p>
            <p><strong>Description:</strong> {{ $task->description }}</p>
            <p><strong>Assigned To:</strong> {{ $task->employee->name ?? 'Unassigned' }}</p>
            <p>
                <strong>Status:</strong> 
                <span class="inline-block px-2 py-1 text-sm rounded
                    @if($task->status == 'pending') bg-gray-200 text-gray-800
                    @elseif($task->status == 'in_progress') bg-yellow-200 text-yellow-800
                    @elseif($task->status == 'completed') bg-green-200 text-green-800
                    @endif">
                    {{ ucfirst($task->status) }}
                </span>
            </p>
            <p><strong>Deadline:</strong> {{ $task->deadline }}</p>
        </div>

        @if(auth()->user()->role === 'employee' && auth()->user()->id === $task->assigned_to)
            <form method="POST" action="{{ route('tasks.updateStatus', $task->id) }}" class="mt-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Update Status:</label>
                    <select name="status" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-blue-500">
                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div>
                    <button 
                        type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition"
                    >
                        Update
                    </button>
                </div>
            </form>
        @endif
    </div>
@endsection
