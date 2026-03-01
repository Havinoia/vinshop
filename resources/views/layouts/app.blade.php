<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VinShop - @yield('title', 'Toko Online Terpercaya')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600">
                VinShop
            </a>

            {{-- Search --}}
            <form action="{{ route('products.index') }}" method="GET" class="hidden md:flex items-center w-1/3">
                <input type="text" name="search" placeholder="Cari produk..."
                    value="{{ request('search') }}"
                    class="w-full border border-gray-300 rounded-l-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-lg hover:bg-indigo-700">
                    Cari
                </button>
            </form>

            {{-- Menu --}}
            <div class="flex items-center gap-4">
                <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-indigo-600">Produk</a>

                @auth
                <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-indigo-600">
                    🛒 Keranjang
                </a>
                <a href="{{ route('orders.index') }}" class="text-gray-600 hover:text-indigo-600">
                    Pesanan
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 text-gray-600 hover:text-indigo-600">
                    @if(auth()->user()->avatar)
                    <img src="{{ Storage::url(auth()->user()->avatar) }}"
                        class="w-8 h-8 rounded-full object-cover">
                    @else
                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-sm font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    @endif
                    {{ auth()->user()->name }}
                </a>

                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 font-semibold hover:underline">
                    Admin
                </a>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700">Logout</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600">Login</a>
                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                    Daftar
                </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Flash Message --}}
    <div class="max-w-7xl mx-auto px-4 mt-4">
        @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-4">
            {{ session('error') }}
        </div>
        @endif
    </div>

    {{-- Konten Halaman --}}
    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white shadow-inner mt-12 py-6 text-center text-gray-500 text-sm">
        © {{ date('Y') }} VinShop. All rights reserved.
    </footer>

</body>

</html>