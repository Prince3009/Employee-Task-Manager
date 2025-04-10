@extends('layout.app')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Task List</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-wrap gap-4 items-center mb-6">
        <input 
            type="text" 
            name="keyword" 
            placeholder="Search by title"
            value="{{ request('keyword') }}"
            class="border border-gray-300 rounded px-3 py-2 w-full sm:w-1/3"
        >

        <select name="status" class="border border-gray-300 rounded px-3 py-2">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filter</button>
    </form>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tasks Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow rounded">
            <thead>
                <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    <th class="px-4 py-2 border-b">Title</th>
                    <th class="px-4 py-2 border-b">Assigned To</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Deadline</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                    <tr class="text-sm text-gray-800 hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $task->title }}</td>
                        <td class="px-4 py-2 border-b">{{ $task->employee->name ?? 'Unassigned' }}</td>
                        <td class="px-4 py-2 border-b">
                            <span class="px-2 py-1 rounded text-white 
                                {{ 
                                    $task->status == 'completed' ? 'bg-green-600' : 
                                    ($task->status == 'in_progress' ? 'bg-yellow-500' : 'bg-gray-600') 
                                }}">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}</td>
                        <td class="px-4 py-2 border-b space-x-2">
                            <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Delete this task?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
