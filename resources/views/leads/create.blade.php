@extends('layout.app')
@section('title')
Create Lead
@endsection

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Create Lead</h2>
    
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('leads.store') }}" method="POST" class="bg-white px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('POST')
        @if ($lead)
            <input type="hidden" name="id" value="{{ $lead->id }}" />
        @endif
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') ? old('name') : ($lead ? $lead->name : '')  }}" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="{{ old('email') ? old('email') : ($lead ? $lead->email : '') }}" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Phone <span class="text-red-500">*</span></label>
            <input type="text" name="phone" value="{{ old('phone') ? old('phone') : ($lead ? $lead->phone : '') }}" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Address</label>
            <textarea name="address" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('address') ? old('address') : ($lead ? $lead->address : '') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Product <span class="text-red-500">*</span></label>
            <select required name="product_id" class="w-full mb-4 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option disabled selected>-- Select Product --</option>
                @foreach ($products as $item)
                    <option value="{{ $item->id }}" {{ old('product_id') && old('product_id') == $item->id ? 'selected' : '' }} {{ $lead && $lead->product_id == $item->id ? 'selected' : '' }}>
                        {{ $item->name }} - Rp. {{ number_format($item->price, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
    </form>
</div>
@endsection
