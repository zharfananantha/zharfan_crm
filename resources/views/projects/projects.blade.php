@extends('layout.app')
@section('title')
Lead List
@endsection

@section('css')
    <style>
        /* Tambahkan CSS khusus di sini jika diperlukan */
    </style>
@endsection

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-700">Projects List</h2>
        <a href="/leads/create" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Add Project</a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Nama Lead</th>
                    <th class="border border-gray-300 px-4 py-2">Nama Produk</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($leads as $lead)
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $lead->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $lead->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $lead->phone }}</td>
                        <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                            <a href="/leads/{{ $lead->id }}/edit" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <form action="/leads/{{ $lead->id }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        // Tambahkan script khusus di sini jika diperlukan
    </script>
@endsection
