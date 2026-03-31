@extends('layouts.app')

@section('title', 'Shop - VinShop')

@section('content')

<div class="flex flex-col lg:flex-row gap-12">

    {{-- Sidebar Kategori --}}
    <aside class="w-full lg:w-1/4">
        <div class="glass-card rounded-[2.5rem] p-10 sticky top-32">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-1.5 h-8 bg-indigo-600 rounded-full"></div>
                <h3 class="font-black text-2xl tracking-tight text-slate-800">Categories</h3>
            </div>
            
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('products.index') }}"
                        class="flex items-center justify-between px-6 py-4 rounded-2xl transition-all duration-300 group {{ !request('category') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/20' : 'text-slate-500 hover:bg-slate-50 hover:text-indigo-600' }}">
                        <span class="font-bold text-sm tracking-tight uppercase">All Materials</span>
                        @if(!request('category'))
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        @endif
                    </a>
                </li>
                @foreach($categories as $category)
                <li>
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                        class="flex items-center justify-between px-6 py-4 rounded-2xl transition-all duration-300 group {{ request('category') === $category->slug ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/20' : 'text-slate-500 hover:bg-slate-50 hover:text-indigo-600' }}">
                        <span class="font-bold text-sm tracking-tight uppercase">{{ $category->name }}</span>
                        @if(request('category') === $category->slug)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        @endif
                    </a>
                </li>
                @endforeach
            </ul>

            <div class="mt-12 p-8 rounded-[2rem] bg-indigo-50/50 border border-indigo-100 relative overflow-hidden group">
                <div class="relative z-10">
                    <h4 class="text-indigo-900 font-black text-sm uppercase tracking-widest mb-2">Concierge</h4>
                    <p class="text-indigo-700/60 text-xs font-medium mb-6 leading-relaxed">Need expert assistance with your selection?</p>
                    <a href="#" class="inline-flex items-center gap-2 text-xs font-black text-indigo-600 hover:gap-4 transition-all uppercase tracking-widest">
                        Talk to us 
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-indigo-200/20 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-700"></div>
            </div>
        </div>
    </aside>

    {{-- Konten Produk --}}
    <div class="w-full lg:w-3/4">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.3em] mb-3">Professional Collection</p>
                <h2 class="text-4xl font-black text-slate-800 tracking-tight">
                    {{ request('search') ? 'Search results for "' . request('search') . '"' : 'Handpicked Excellence' }}
                </h2>
                <div class="flex items-center gap-3 mt-4">
                    <span class="w-8 h-[2px] bg-indigo-200"></span>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">{{ $products->total() }} unique items</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <button class="bg-white border border-slate-200 px-6 py-3 rounded-2xl text-xs font-black text-slate-500 uppercase tracking-widest hover:border-indigo-300 hover:text-indigo-600 transition-all shadow-sm">
                    Filter: Default
                </button>
            </div>
        </div>

        {{-- Grid Produk --}}
        @if($products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-10">
            @foreach($products as $product)
            <div class="group h-full flex flex-col">
                <a href="{{ route('products.show', $product->slug) }}" class="flex-1 glass-card rounded-[2.5rem] overflow-hidden flex flex-col relative">
                    {{-- Image Container --}}
                    <div class="aspect-[4/5] relative overflow-hidden bg-slate-50">
                        @if($product->image)
                        <img src="{{ $product->image }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-all duration-1000 group-hover:scale-110">
                        @else
                        <div class="w-full h-full flex flex-col items-center justify-center p-12 text-center bg-slate-50">
                            <div class="w-24 h-24 bg-white rounded-[2rem] flex items-center justify-center mb-6 shadow-sm border border-slate-100 group-hover:scale-110 group-hover:bg-indigo-50 transition-all duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300 group-hover:text-indigo-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <span class="text-slate-300 font-black text-[10px] uppercase tracking-[0.3em]">Iconic Asset</span>
                        </div>
                        @endif
                        
                        {{-- Price Badge Overlay --}}
                        <div class="absolute top-8 left-8">
                            <div class="bg-white/80 backdrop-blur-md px-4 py-2.5 rounded-2xl border border-white font-black text-xs text-slate-800 shadow-sm">
                                Rp {{ number_format($product->price / 1000, 0) }}k
                            </div>
                        </div>

                        {{-- Action Layer --}}
                        <div class="absolute inset-0 bg-indigo-600/0 group-hover:bg-indigo-600/5 transition-colors duration-500"></div>
                        
                        <div class="absolute bottom-6 left-6 right-6 translate-y-12 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                            <div class="bg-slate-900 text-white font-black py-4 rounded-2xl text-[10px] uppercase tracking-[0.2em] text-center shadow-2xl">
                                Detailed Preview
                            </div>
                        </div>
                    </div>

                    {{-- Product Info --}}
                    <div class="p-10 flex-1 flex flex-col">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="w-2 h-2 rounded-full {{ $product->stock > 0 ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                                {{ $product->stock > 0 ? 'Verified Availability' : 'Reservation Only' }}
                            </span>
                        </div>
                        <h3 class="text-slate-800 font-extrabold text-xl mb-2 line-clamp-1 group-hover:text-indigo-600 transition-colors">
                            {{ $product->name }}
                        </h3>
                        <p class="text-slate-400 text-sm font-medium mb-8">
                            Uncompromising quality in every detail.
                        </p>
                        
                        <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest leading-tight">Investment</span>
                                <span class="text-lg font-black text-slate-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-20 flex justify-center">
            <div class="bg-white px-6 py-4 rounded-3xl border border-slate-100 shadow-sm">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
        @else
        <div class="glass-card rounded-[4rem] p-32 text-center">
            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h3 class="text-3xl font-black text-slate-800 mb-4 tracking-tight">No Results Found</h3>
            <p class="text-slate-400 font-medium mb-12 max-w-sm mx-auto tracking-wide">The criteria you specified didn't return any assets from our primary collection.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black px-12 py-5 rounded-2xl transition-all shadow-2xl shadow-indigo-600/30 active:scale-95">
                Refresh Collection
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        @endif

    </div>
</div>

@endsection