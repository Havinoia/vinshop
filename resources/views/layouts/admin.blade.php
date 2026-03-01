<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin VinShop - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-indigo-800 text-white flex flex-col fixed h-full">
            {{-- Logo --}}
            <div class="px-6 py-5 border-b border-indigo-700">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">
                    🛍️ VinShop Admin
                </a>
            </div>

            {{-- Menu --}}
            <nav class="flex-1 px-4 py-6 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600' : 'hover:bg-indigo-700' }}">
                    📊 Dashboard
                </a>
                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-600' : 'hover:bg-indigo-700' }}">
                    🗂️ Kategori
                </a>
                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.products.*') ? 'bg-indigo-600' : 'hover:bg-indigo-700' }}">
                    📦 Produk
                </a>
                <a href="{{ route('admin.orders.index') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-600' : 'hover:bg-indigo-700' }}">
                    🧾 Pesanan
                </a>
            </nav>

            {{-- User Info & Logout --}}
            <div class="px-4 py-4 border-t border-indigo-700">
                <p class="text-xs text-indigo-300 mb-3">{{ auth()->user()->name }}</p>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left text-sm text-red-300 hover:text-red-100">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Konten Utama --}}
        <div class="flex-1 ml-64">

            {{-- Header --}}
            <header class="bg-white shadow px-8 py-4 flex items-center justify-between">
                <h1 class="text-lg font-bold text-gray-800">@yield('title', 'Dashboard')</h1>
                <a href="{{ route('home') }}" class="text-sm text-indigo-600 hover:underline">
                    Lihat Toko →
                </a>
            </header>

            {{-- Flash Message --}}
            <div class="px-8 mt-4">
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
            <main class="px-8 py-6">
                @yield('content')
            </main>
        </div>

    </div>

</body>
</html>