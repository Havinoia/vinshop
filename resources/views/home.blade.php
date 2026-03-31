@extends('layouts.app')

@section('title', 'Marketplace - VinShop')

@section('content')

{{-- Hero Section --}}
<div class="glass-card rounded-[4rem] p-16 lg:p-24 relative overflow-hidden mb-20 border border-slate-100/50 shadow-2xl shadow-indigo-500/5">
    {{-- Decorative Mesh --}}
    <div class="absolute -right-40 -top-40 w-[40rem] h-[40rem] bg-indigo-50/50 rounded-full blur-[120px] pointer-events-none animate-pulse-slow"></div>
    <div class="absolute -left-40 -bottom-40 w-[40rem] h-[40rem] bg-slate-50/50 rounded-full blur-[120px] pointer-events-none animate-pulse-slow"></div>

    <div class="relative z-10 max-w-3xl">
        <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.5em] mb-6 animate-fade-in">Established Nexus MMXXIV</p>
        <h1 class="text-5xl lg:text-7xl font-black text-slate-800 tracking-tight leading-[1.1] mb-8 animate-fade-in-up">
            Architecting <span class="text-indigo-600">Digital</span> Elegance.
        </h1>
        <p class="text-lg lg:text-xl text-slate-400 font-medium mb-12 max-w-xl leading-relaxed animate-fade-in-up">
            Navigate through a curated ecosystem of premium assets designed for the modern connoisseur. Quality redefined.
        </p>
        <div class="flex flex-wrap gap-6 animate-fade-in-up">
            <a href="{{ route('products.index') }}"
                class="bg-slate-900 hover:bg-indigo-600 text-white font-black px-12 py-6 rounded-[2.5rem] transition-all shadow-2xl shadow-slate-900/10 active:scale-95 group flex items-center gap-4">
                Explore Registry
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7-7 7" />
                </svg>
            </a>
            <a href="#categories"
                class="bg-white border border-slate-100 hover:border-indigo-200 text-slate-400 hover:text-indigo-600 px-12 py-6 rounded-[2.5rem] font-black transition-all active:scale-95 shadow-sm">
                Catalogs
            </a>
        </div>
    </div>
</div>

{{-- Kategori --}}
@if($categories->count())
<div class="mb-24 px-4" id="categories">
    <div class="flex flex-col mb-12">
        <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.4em] mb-4">Discovery Nodes</p>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight flex items-center gap-6">
            Curated Domains
            <span class="flex-1 h-[1px] bg-slate-100"></span>
        </h2>
    </div>

    <div class="flex flex-wrap gap-4">
        @foreach($categories as $category)
        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
            class="bg-white border border-slate-100 px-8 py-4 rounded-3xl text-[10px] font-black text-slate-400 uppercase tracking-widest hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm active:scale-95">
            {{ $category->name }}
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- Produk Terbaru --}}
<div class="mb-24 px-4">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
        <div class="space-y-4">
            <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.4em]">Asset Feed</p>
            <h2 class="text-4xl font-black text-slate-800 tracking-tight">Recent Acquisitions</h2>
        </div>
        <a href="{{ route('products.index') }}" class="group flex items-center gap-3 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-indigo-600 transition-colors">
            Access Full Registry
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>

    @if($products->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
        @foreach($products as $product)
            @php
                $icon = match(strtolower($product->category->name ?? '')) {
                    'electronics', 'gadgets' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
                    'clothing', 'fashion' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                    'home', 'furniture' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                    'food', 'groceries' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z',
                    default => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'
                };
            @endphp
            <div class="glass-card rounded-[3rem] p-6 group transition-all duration-500 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-2 border border-transparent hover:border-indigo-100 flex flex-col h-full">
                <a href="{{ route('products.show', $product->slug) }}" class="block relative aspect-square rounded-[2.5rem] overflow-hidden mb-8 bg-slate-50 border border-slate-100">
                    @if($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-200 group-hover:text-indigo-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icon }}" />
                                </svg>
                            </div>
                        </div>
                    @endif
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-full text-[10px] font-black text-indigo-600 uppercase tracking-widest shadow-sm">
                        {{ $product->category->name ?? 'Asset' }}
                    </div>
                </a>

                <div class="flex-1 space-y-4">
                    <div class="space-y-1">
                        <h3 class="text-xl font-extrabold text-slate-800 leading-tight line-clamp-1 group-hover:text-indigo-600 transition-colors">{{ $product->name }}</h3>
                        <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">Procurement Available</p>
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <div class="flex flex-col">
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-1">Valuation</p>
                            <p class="text-2xl font-black text-slate-800 tracking-tighter">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                        <a href="{{ route('products.show', $product->slug) }}" class="w-12 h-12 bg-slate-900 group-hover:bg-indigo-600 rounded-2xl flex items-center justify-center text-white transition-all shadow-xl active:scale-90">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
    <div class="glass-card rounded-[4rem] p-32 text-center relative overflow-hidden">
        <h3 class="text-4xl font-black text-slate-300 tracking-tighter italic">No Recent Dispatches</h3>
    </div>
    @endif
</div>

@endsection