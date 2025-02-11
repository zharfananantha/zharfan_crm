<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('css')
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 text-white shadow-md">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="/" class="text-lg font-bold">Zharfan's PT Smart CRM</a>
            <ul class="flex space-x-4">
                <li><a href="{{ route('leads.leads') }}" class="hover:underline">Leads</a></li>
                <li><a href="{{ route('products.products') }}" class="hover:underline">Products</a></li>
                <li><a href="{{ route('projects.projects') }}" class="hover:underline">Projects</a></li>
                <li><a href="{{ route('customers.customers') }}" class="hover:underline">Customers</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        @method('POST')
                        <button type="submit" class="hover:underline">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="max-w-6xl mx-auto mt-6 p-6 bg-white shadow-md rounded-lg">
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
