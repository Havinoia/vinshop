<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VinShop - @yield('title', 'Premium E-Commerce')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f4ff',
                            100: '#e0e9ff',
                            200: '#c1d3ff',
                            300: '#92b2ff',
                            400: '#5c84ff',
                            500: '#3351ff',
                            600: '#1a29ff',
                            700: '#0000ff',
                            800: '#0000cc',
                            900: '#000099',
                        },
                        glass: {
                            white: 'rgba(255, 255, 255, 0.8)',
                            light: 'rgba(248, 250, 252, 0.5)',
                        }
                    },
                    animation: {
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #fcfcfc;
            color: #1e293b;
        }
        .light-mesh {
            background-color: #fcfcfc;
            background-image: 
                radial-gradient(at 0% 0%, hsla(225,39%,95%,1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(253,16%,95%,1) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(339,49%,95%,1) 0, transparent 50%);
        }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .glass-card {
            background: #ffffff;
            border: 1px solid rgba(241, 245, 249, 1);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card:hover {
            box-shadow: 0 20px 40px -15px rgba(99, 102, 241, 0.15);
            transform: translateY(-4px);
            border-color: rgba(99, 102, 241, 0.2);
        }
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #6366f1;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>

<body class="light-mesh min-h-screen font-sans selection:bg-brand-500 selection:text-white">

    {{-- Decorative Background Elements --}}
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none z-[-1] overflow-hidden">
        <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-indigo-100/50 rounded-full blur-[120px] animate-pulse-slow"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[500px] h-[500px] bg-fuchsia-50/50 rounded-full blur-[120px] animate-pulse-slow"></div>
    </div>

    {{-- Navbar --}}
    <nav class="sticky top-6 z-50 px-4 md:px-8 max-w-7xl mx-auto">
        <div class="glass rounded-3xl px-6 py-4 flex items-center justify-between shadow-xl shadow-indigo-900/5">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-600/20 group-hover:scale-105 transition-transform">
                    <span class="text-white font-black text-xl">V</span>
                </div>
                <span class="text-xl font-black text-slate-800 tracking-tighter">
                    VinShop
                </span>
            </a>

            {{-- Search Bar --}}
            <form action="{{ route('products.index') }}" method="GET" class="hidden lg:flex items-center w-5/12">
                <div class="relative w-full">
                    <input type="text" name="search" placeholder="Search unique products..."
                        value="{{ request('search') }}"
                        class="w-full bg-slate-100/50 border border-slate-200 rounded-2xl px-6 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:bg-white transition-all text-sm placeholder:text-slate-400">
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-indigo-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>

            {{-- Menu --}}
            <div class="flex items-center gap-8">
                <a href="{{ route('products.index') }}" class="nav-link text-sm font-bold text-slate-500 hover:text-indigo-600">Shop</a>

                @auth
                <div class="flex items-center gap-5">
                    <a href="{{ route('cart.index') }}" class="relative text-slate-500 hover:text-indigo-600 transition-colors p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        {{-- Dot notification if items in cart --}}
                    </a>

                    <div class="h-6 w-px bg-slate-200 mx-2"></div>

                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 group">
                        <div class="text-right hidden md:block">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 leading-none mb-1">Account</p>
                            <p class="text-xs font-black text-slate-700 leading-none">{{ explode(' ', auth()->user()->name)[0] }}</p>
                        </div>
                        @if(auth()->user()->avatar)
                            <img src="{{ Storage::url(auth()->user()->avatar) }}" class="w-10 h-10 rounded-2xl object-cover border-2 border-white shadow-md">
                        @else
                            <div class="w-10 h-10 rounded-2xl bg-indigo-50 border-2 border-white shadow-md flex items-center justify-center text-indigo-600 font-black text-xs">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="ml-2">
                        @csrf
                        <button type="submit" class="p-2 text-slate-300 hover:text-red-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
                @else
                <div class="flex items-center gap-5">
                    <a href="{{ route('login') }}" class="text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-black px-6 py-3.5 rounded-2xl transition-all shadow-lg shadow-indigo-600/20 active:scale-95 uppercase tracking-widest">
                        Join
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    <div class="max-w-7xl mx-auto px-4 mt-10">
        @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-3xl mb-8 flex items-center gap-4 shadow-sm">
            <div class="w-8 h-8 bg-emerald-500/20 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <span class="font-bold text-sm">{{ session('success') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div class="bg-red-50 border border-red-100 text-red-600 px-6 py-4 rounded-3xl mb-8 flex items-center gap-4 shadow-sm">
            <div class="w-8 h-8 bg-red-500/20 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <span class="font-bold text-sm">{{ session('error') }}</span>
        </div>
        @endif
    </div>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="mt-32 pb-12 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 pt-12 text-center">
            <div class="flex flex-col items-center gap-6">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-lg border border-slate-50">
                    <span class="text-indigo-600 font-black text-xl">V</span>
                </div>
                <p class="text-slate-400 text-sm font-semibold max-w-sm leading-relaxed">
                    Elevating your digital commerce experience through premium designs and trusted quality.
                </p>
                <div class="flex gap-8 mt-4">
                    <a href="#" class="text-slate-400 hover:text-indigo-600 transition-colors text-xs font-black uppercase tracking-widest">About</a>
                    <a href="#" class="text-slate-400 hover:text-indigo-600 transition-colors text-xs font-black uppercase tracking-widest">Support</a>
                    <a href="#" class="text-slate-400 hover:text-indigo-600 transition-colors text-xs font-black uppercase tracking-widest">Privacy</a>
                </div>
                <p class="text-slate-300 text-[10px] font-black mt-8 uppercase tracking-[0.2em]">
                    © {{ date('Y') }} VinShop Global. Crafted for Perfection.
                </p>
            </div>
        </div>
    </footer>

</body>
</html>