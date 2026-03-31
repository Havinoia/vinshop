<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VinShop Admin - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fcfcfc;
            color: #1e293b;
        }

        .glass-sidebar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(241, 245, 249, 1);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.02);
        }

        .nav-link-active {
            background: #4f46e5;
            color: white;
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.3);
        }

        .light-mesh {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
            background:
                radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.03) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(168, 85, 247, 0.03) 0px, transparent 50%);
        }

        @keyframes pulse-slow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }
        .animate-pulse-slow {
            animation: pulse-slow 8s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="light-mesh"></div>

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-72 glass-sidebar flex flex-col fixed h-full z-20">
            {{-- Logo --}}
            <div class="px-10 py-10">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 group">
                    <div class="w-10 h-10 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-600/20 rotate-12 group-hover:rotate-0 transition-transform duration-500">
                        <span class="text-white font-black text-xl">V</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs font-black text-indigo-500 uppercase tracking-[0.3em]">Command Center</span>
                        <span class="text-xl font-black text-slate-800 tracking-tighter">VinShop </span>
                    </div>
                </a>
            </div>

            {{-- Menu --}}
            <nav class="flex-1 px-6 space-y-2">
                <p class="px-4 text-[10px] font-black text-slate-300 uppercase tracking-[0.3em] mb-4">Master Terminal</p>

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-4 px-6 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest transition-all
                   {{ request()->routeIs('admin.dashboard') ? 'nav-link-active' : 'text-slate-400 hover:bg-slate-50 hover:text-slate-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-16zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-16z" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center gap-4 px-6 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest transition-all
                   {{ request()->routeIs('admin.categories.*') ? 'nav-link-active' : 'text-slate-400 hover:bg-slate-50 hover:text-slate-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Domains
                </a>

                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center gap-4 px-6 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest transition-all
                   {{ request()->routeIs('admin.products.*') ? 'nav-link-active' : 'text-slate-400 hover:bg-slate-50 hover:text-slate-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Registry
                </a>

                <a href="{{ route('admin.orders.index') }}"
                   class="flex items-center gap-4 px-6 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest transition-all
                   {{ request()->routeIs('admin.orders.*') ? 'nav-link-active' : 'text-slate-400 hover:bg-slate-50 hover:text-slate-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Transactions
                </a>
            </nav>

            {{-- User Info & Logout --}}
            <div class="p-8">
                <div class="bg-slate-50 rounded-[2rem] p-6 border border-slate-100 group/user">
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-1">Authenticated</p>
                    <p class="text-sm font-black text-slate-800 mb-4 truncate">{{ auth()->user()->name }}</p>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-slate-900 hover:bg-indigo-600 text-white text-[10px] font-black uppercase tracking-widest py-3 rounded-xl transition-all shadow-lg active:scale-95">
                            Deauthorize
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Konten Utama --}}
        <div class="flex-1 ml-72">

            {{-- Header --}}
            <header class="sticky top-0 bg-white/80 backdrop-blur-md z-10 px-12 py-6 border-b border-slate-100 flex items-center justify-between">
                <h1 class="text-xl font-black text-slate-800 tracking-tight flex items-center gap-4">
                    @yield('title', 'Dashboard')
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                </h1>
                <a href="{{ route('home') }}" class="bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-[10px] font-black px-6 py-3 rounded-xl transition-all active:scale-95 flex items-center gap-3 decoration-none">
                    Marketplace Portal
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            </header>

            {{-- Flash Message --}}
            <div class="px-12 mt-8">
                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest flex items-center gap-3 shadow-sm animate-fade-in">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-rose-50 border border-rose-100 text-rose-500 px-6 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest flex items-center gap-3 shadow-sm animate-fade-in">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            {{-- Konten Halaman --}}
            <main class="px-12 py-10">
                @yield('content')
            </main>
        </div>

    </div>

</body>
</html>