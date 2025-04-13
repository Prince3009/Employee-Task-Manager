@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Register New Employee</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.employees.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-medium">Name</label>
                <input type="text" name="name" class="w-full border px-3 py-2 rounded" required>
                @error('name') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
                @error('email') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Password</label>
                <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
                @error('password') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Register</button>
            </div>
        </form>
    </div>
</div>
@endsection
