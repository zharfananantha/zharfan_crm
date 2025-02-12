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
                    <th class="border border-gray-300 px-4 py-2 text-center">#</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Nama Lead</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Kontak Lead</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Nama Produk</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Status</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $item)
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $item->lead?->name ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <div class="flex flex-col text-left">
                                <span class="text-sm font-semibold text-gray-700">Email : {{ $item->lead?->email ?? '-' }}</span>
                                <span class="text-xs font-semibold text-gray-500">Phone : {{ $item->lead?->phone ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $item->product?->name }} - Rp. {{ number_format($item->product?->price, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            @if (strtolower($item->status) == 'a')
                                <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Approved</span>
                            @elseif (strtolower($item->status) == 'r')
                                <span class="bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-full">Rejected</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-700 text-xs font-semibold px-3 py-1 rounded-full">Pending</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            @if (strtolower($item->status) == 'a')
                            <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Project Approved</span>
                            @elseif (strtolower($item->status) == 'r')
                            <span class="bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-full">Project Rejected</span>
                            @else
                                <form action="{{ route('projects.update') }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="id" value="{{ $item->id }}" />
                                    <input type="hidden" name="lead_id" value="{{ $item->lead_id }}" />
                            
                                    <select name="status" onchange="this.form.submit()"
                                        class="border border-gray-300 rounded px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option disabled selected>-- Update Status --</option>
                                        <option value="p">Hold</option>
                                        <option value="a" {{ $item->status == 'a' ? 'selected' : '' }}>Approve</option>
                                        <option value="r" {{ $item->status == 'r' ? 'selected' : '' }}>Reject</option>
                                    </select>
                                </form>
                            @endif
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
