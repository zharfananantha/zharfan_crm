@extends('layout.app')
@section('title')
Create Products
@endsection

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Add Product</h2>
    
    @if ($errors->any())
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        @method('POST')
        @if ($product)
            <input type="hidden" name="id" value="{{ $product->id }}" />
        @endif
        <div class="mb-4">
            <label class="block text-gray-700">Product Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') ? old('name') : ($product ? $product->name : '') }}" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Description</label>
            <textarea name="description" value="{{ old('description') ? old('description') : ($product ? $product->description : '') }}" class="w-full p-2 border rounded">{{ old('description') ? old('description') : ($product ? $product->description : '') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Price <span class="text-red-500">*</span></label>
            <input type="number" name="price" value="{{ old('price') ? old('price') : ($product ? $product->price : '') }}" step="0.01" class="w-full p-2 border rounded" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Save Product</button>
    </form>
</div>
@endsection
