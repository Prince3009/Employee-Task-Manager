@extends('layout.app')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Edit Task</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="bg-white p-6 rounded shadow-md space-y-6 max-w-2xl">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Title:</label>
            <input 
                type="text" 
                name="title" 
                value="{{ $task->title }}" 
                required 
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <!-- Description -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Description:</label>
            <textarea 
                name="description" 
                rows="4" 
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >{{ $task->description }}</textarea>
        </div>

        <!-- Assign To -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Assign To:</label>
            <select 
                name="assigned_to" 
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $task->assigned_to == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Deadline -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Deadline:</label>
            <input 
                type="date" 
                name="deadline" 
                value="{{ $task->deadline }}" 
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <!-- Status -->
        <
