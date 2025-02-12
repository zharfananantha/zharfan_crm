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
        <h2 class="text-2xl font-bold text-gray-700">Customers List</h2>
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
                    <th class="border border-gray-300 px-4 py-2">Nama Customer</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Phone</th>
                    <th class="border border-gray-300 px-4 py-2">Produk Langganan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $item)
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $item->name }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $item->email }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $item->phone }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $item->product?->name }} - Rp. {{ number_format($item->product?->price, 0, ',', '.') }}</td>
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
