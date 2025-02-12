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
        <h2 class="text-2xl font-bold text-gray-700">Leads List</h2>
        <a href="{{ route('leads.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Add Lead</a>
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
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Phone</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Product</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leads as $lead)
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $lead->name }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $lead->email }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $lead->phone }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            @if (strtolower($lead->status) == 'a')
                                <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Approved</span>
                            @elseif (strtolower($lead->status) == 'r')
                                <span class="bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-full">Rejected</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-700 text-xs font-semibold px-3 py-1 rounded-full">Pending</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $lead->product?->name }} - Rp. {{ number_format($lead->product?->price, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 px-4 py-2 flex items-center justify-center gap-2">
                            <a href="{{ route('leads.create', ['id' => $lead->id]) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <form method="POST" action="{{ route('leads.delete') }}" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="id" value="{{ $lead->id }}"/>
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        // Tambahkan script khusus di sini jika diperlukan
    </script>
@endsection
