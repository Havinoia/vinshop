@extends('layouts.app')

@section('title', $product->name . ' - VinShop')

@section('content')

<div class="mb-24">
    {{-- Breadcrumbs --}}
    <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-12 px-2">
        <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors">Digital Home</a>
        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
        <a href="{{ route('products.index') }}" class="hover:text-indigo-600 transition-colors">Inventory</a>
        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
        <span class="text-indigo-600">{{ $product->category->name }}</span>
    </nav>

    <div class="flex flex-col lg:flex-row gap-16 xl:gap-24">
        {{-- Foto Produk Section --}}
        <div class="w-full lg:w-1/2">
            <div class="glass-card rounded-[3.5rem] p-4 lg:p-10 relative overflow-hidden group">
                <div class="aspect-square rounded-[2.5rem] overflow-hidden bg-slate-50 flex flex-col items-center justify-center relative border border-slate-100">
                    @if($product->image)
                    <img src="{{ $product->image }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover transition-transform duration-[1.5s] group-hover:scale-110">
                    @else
                    <div class="flex flex-col items-center gap-8 p-12 text-center">
                        <div class="w-40 h-40 bg-white rounded-[3rem] flex items-center justify-center border border-slate-100 shadow-sm group-hover:scale-110 transition-transform duration-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div class="space-y-2">
                            <p class="text-slate-400 font-extrabold text-[10px] tracking-[0.4em] uppercase">Visual Asset Pending</p>
                            <p class="text-slate-300 text-[10px] font-medium tracking-widest px-10">Premium documentation currently in processing.</p>
                        </div>
                    </div>
                    @endif

                    {{-- Floating Glass Badge --}}
                    <div class="absolute top-10 left-10">
                        <div class="bg-white/80 backdrop-blur-md px-6 py-3 rounded-2xl border border-white shadow-sm">
                            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-800">Master Collection</span>
                        </div>
                    </div>
                </div>

                {{-- Foto Tambahan (Gallery) --}}
                @if($product->images && $product->images->count())
                <div class="mt-10 flex gap-6 overflow-x-auto pb-4 no-scrollbar">
                    @foreach($product->images as $image)
                    <button class="w-32 h-32 flex-shrink-0 rounded-[2.5rem] overflow-hidden bg-slate-50 border border-slate-100 hover:border-indigo-400 transition-all p-2 group/thumb shadow-sm">
                        <img src="{{ $image->url }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover rounded-[2rem] group-hover/thumb:scale-110 transition-transform">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        {{-- Info Produk Section --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-center">
            {{-- Category & Stock Badge --}}
            <div class="flex items-center gap-6 mb-10">
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-indigo-600 bg-indigo-50 px-6 py-2 rounded-2xl border border-indigo-100">
                    {{ $product->category->name }}
                </span>
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full {{ $product->stock > 0 ? 'bg-emerald-500' : 'bg-rose-500' }} shadow-[0_0_15px_rgba(16,185,129,0.3)]"></div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        {{ $product->stock > 0 ? $product->stock . ' Units Available' : 'Current Unavailable' }}
                    </span>
                </div>
            </div>

            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-slate-800 leading-[1.1] mb-10 tracking-tighter">
                {{ $product->name }}
            </h1>

            <div class="flex items-baseline gap-4 mb-14 px-2">
                <span class="text-[10px] font-black text-slate-300 uppercase tracking-[0.4em]">Investment Value</span>
                <span class="text-4xl font-black text-slate-800 tracking-tight">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
            </div>

            <div class="glass-card rounded-[2.5rem] p-10 mb-14 relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.4em] text-indigo-600 mb-6">Asset Brief</h3>
                    <p class="text-slate-500 leading-relaxed text-lg font-medium">
                        {{ $product->description }}
                    </p>
                </div>
                <div class="absolute -right-8 -top-8 w-32 h-32 bg-slate-50 rounded-full blur-3xl"></div>
            </div>

            {{-- Checkout Form --}}
            <div class="bg-slate-50 rounded-[3rem] p-12 border border-slate-100 relative overflow-hidden">
                <div class="relative z-10">
                    @auth
                        @if($product->stock > 0)
                        <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col sm:flex-row items-center gap-8">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="flex items-center bg-white rounded-3xl border border-slate-100 p-2 shadow-sm">
                                <button type="button" onclick="this.nextElementSibling.stepDown()" class="w-12 h-12 flex items-center justify-center text-slate-300 hover:text-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4" />
                                    </svg>
                                </button>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                    class="w-16 bg-transparent text-slate-800 font-black text-center focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                <button type="button" onclick="this.previousElementSibling.stepUp()" class="w-12 h-12 flex items-center justify-center text-slate-300 hover:text-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>

                            <button type="submit"
                                class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-black py-6 px-12 rounded-3xl transition-all shadow-2xl shadow-indigo-600/30 active:scale-95 flex items-center justify-center gap-4 group/btn relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-700"></div>
                                Initialize Purchase
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover/btn:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                        </form>
                        @else
                        <div class="w-full bg-slate-200 text-slate-400 font-black py-6 rounded-3xl flex items-center justify-center gap-4 uppercase tracking-[0.2em] cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            Supply Exhausted
                        </div>
                        @endif
                    @else
                        <div class="flex flex-col sm:flex-row items-center gap-6">
                            <a href="{{ route('login') }}"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-6 px-12 rounded-[2.5rem] flex items-center justify-center gap-4 shadow-xl shadow-indigo-600/20 transition-all active:scale-95 text-xs uppercase tracking-widest">
                                Profile Alignment Required
                            </a>
                            <div class="h-[1px] w-12 bg-slate-200 sm:w-[1px] sm:h-12"></div>
                            <a href="{{ route('register') }}" class="w-full bg-white border border-slate-100 text-slate-400 font-black py-6 px-12 rounded-[2.5rem] flex items-center justify-center hover:bg-slate-50 transition-all text-xs uppercase tracking-widest">
                                New Membership
                            </a>
                        </div>
                    @endauth
                </div>
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-indigo-500/5 rounded-full blur-[100px] pointer-events-none"></div>
            </div>
        </div>
    </div>
</div>

{{-- Produk Terkait --}}
@if($related->count())
<div class="mt-40">
    <div class="flex flex-col mb-16 px-2">
        <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.4em] mb-4">Extended Discovery</p>
        <h2 class="text-4xl font-black text-slate-800 tracking-tight flex items-center gap-6">
            Complementary Assets
            <span class="flex-1 h-[2px] bg-slate-100 rounded-full"></span>
        </h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
        @foreach($related as $item)
        <div class="group h-full flex flex-col">
            <a href="{{ route('products.show', $item->slug) }}" class="flex-1 glass-card rounded-[3rem] overflow-hidden flex flex-col relative">
                <div class="aspect-[4/5] relative overflow-hidden bg-slate-50">
                    @if($item->image)
                    <img src="{{ $item->image }}"
                        alt="{{ $item->name }}"
                        class="w-full h-full object-cover transition-all duration-[1s] group-hover:scale-110">
                    @else
                    <div class="w-full h-full flex flex-col items-center justify-center bg-slate-50 border-b border-slate-50">
                        <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center border border-slate-50 shadow-sm transition-all group-hover:bg-indigo-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-200 group-hover:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                    @endif
                    
                    <div class="absolute top-6 right-6">
                        <div class="bg-white/80 backdrop-blur-md px-4 py-2 rounded-2xl border border-white shadow-sm transition-all group-hover:bg-indigo-600 group-hover:text-white group-hover:border-indigo-600">
                            <span class="font-black text-[10px] tracking-widest uppercase">
                                Rp {{ number_format($item->price/1000, 0) }}k
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-10 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                        <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest leading-none">
                            {{ $item->category->name }}
                        </span>
                    </div>
                    <h3 class="text-slate-800 font-extrabold text-sm mb-4 line-clamp-1 group-hover:text-indigo-600 transition-colors">
                        {{ $item->name }}
                    </h3>
                    <div class="mt-auto flex items-center justify-between group/link">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover/link:text-indigo-600 transition-colors">Inspect Now</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-slate-300 group-hover/link:text-indigo-600 group-hover/link:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif

@endsection