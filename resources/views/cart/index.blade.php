@extends('layouts.app')

@section('title', 'Your Cart - VinShop')

@section('content')

<div class="mb-24">
    <div class="flex flex-col mb-12 px-2">
        <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.4em] mb-4">Strategic Selection</p>
        <h1 class="text-4xl md:text-5xl font-black text-slate-800 tracking-tight flex items-center gap-6">
            Shopping Cart
            <span class="flex-1 h-[2px] bg-slate-100 rounded-full"></span>
        </h1>
    </div>

    @if($carts->count())
        <div class="flex flex-col lg:flex-row gap-16">

            {{-- List Item Keranjang --}}
            <div class="w-full lg:w-2/3 space-y-8">
                @foreach($carts as $cart)
                    <div class="glass-card rounded-[3rem] p-8 flex flex-col sm:flex-row items-center gap-10 group relative overflow-hidden active:scale-[0.99] transition-transform">
                        {{-- Background Accent --}}
                        <div class="absolute -right-20 -top-20 w-48 h-48 bg-indigo-50/50 rounded-full blur-[80px] pointer-events-none group-hover:scale-150 transition-transform duration-1000"></div>

                        {{-- Foto Produk --}}
                        <div class="w-full sm:w-40 h-40 rounded-[2.5rem] overflow-hidden bg-slate-50 border border-slate-100 relative group/img">
                            @if($cart->product->image)
                                <img src="{{ $cart->product->image }}"
                                     alt="{{ $cart->product->name }}"
                                     class="w-full h-full object-cover transition-transform duration-1000 group-hover/img:scale-110">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center p-8 bg-slate-50 text-center">
                                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-2 shadow-sm border border-slate-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                    <span class="text-[8px] font-black uppercase text-slate-300 tracking-widest">Iconic Asset</span>
                                </div>
                            @endif
                        </div>

                        {{-- Info Produk --}}
                        <div class="flex-1 text-center sm:text-left space-y-2">
                            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-indigo-500 bg-indigo-50 px-3 py-1 rounded-lg">
                                {{ $cart->product->category->name }}
                            </span>
                            <h3 class="font-extrabold text-2xl text-slate-800 tracking-tight group-hover:text-indigo-600 transition-colors">
                                {{ $cart->product->name }}
                            </h3>
                            <div class="flex items-baseline gap-2 justify-center sm:justify-start">
                                <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest leading-none">Unit Price</span>
                                <p class="text-slate-500 font-bold text-lg">
                                    Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center gap-8 w-full sm:w-auto mt-4 sm:mt-0">
                            {{-- Update Quantity --}}
                            <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="flex items-center bg-white rounded-2xl border border-slate-100 p-2 shadow-sm focus-within:border-indigo-200 transition-all">
                                @csrf
                                @method('PATCH')
                                <button type="button" onclick="this.nextElementSibling.stepDown(); this.closest('form').submit()" class="w-10 h-10 flex items-center justify-center text-slate-300 hover:text-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M20 12H4" />
                                    </svg>
                                </button>
                                <input type="number" name="quantity" value="{{ $cart->quantity }}"
                                       min="1" max="{{ $cart->product->stock }}"
                                       class="w-14 bg-transparent text-slate-800 font-black text-center focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                <button type="button" onclick="this.previousElementSibling.stepUp(); this.closest('form').submit()" class="w-10 h-10 flex items-center justify-center text-slate-300 hover:text-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </form>

                            {{-- Hapus Item --}}
                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-4 bg-slate-50 hover:bg-rose-50 text-slate-300 hover:text-rose-500 rounded-2xl transition-all group/del">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover/del:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Summary --}}
            <aside class="w-full lg:w-1/3">
                <div class="glass-card rounded-[3.5rem] p-12 sticky top-32 border border-slate-100 relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.4em] mb-10">Order Architecture</h3>

                        <div class="space-y-6 mb-12">
                            @foreach($carts as $cart)
                                <div class="flex justify-between items-start gap-4">
                                    <div class="flex flex-col">
                                        <span class="text-slate-800 font-extrabold text-sm line-clamp-1 flex-1">{{ $cart->product->name }}</span>
                                        <span class="text-[10px] text-slate-400 font-black uppercase tracking-widest mt-1">Quantity: {{ $cart->quantity }}</span>
                                    </div>
                                    <span class="text-slate-800 font-black text-sm whitespace-nowrap">Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="h-[2px] bg-slate-50 rounded-full mb-10"></div>

                        <div class="flex flex-col gap-2 mb-12">
                            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Total Investment</span>
                            <span class="text-4xl font-black text-slate-800 tracking-tighter">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        {{-- Form Checkout --}}
                        <form action="{{ route('orders.store') }}" method="POST" class="space-y-10">
                            @csrf
                            <div class="space-y-4">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Logistics Destination</label>
                                <textarea name="shipping_address" rows="3" required
                                          class="w-full bg-slate-50 border border-slate-100 rounded-[2rem] p-6 text-slate-800 placeholder:text-slate-300 text-sm font-medium focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all resize-none shadow-sm"
                                          placeholder="Enter precise delivery coordinates...">{{ old('shipping_address') }}</textarea>
                            </div>

                            <div class="space-y-4">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Settlement Protocol</label>
                                <div class="relative group/select">
                                    <select name="payment_method" required
                                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl p-5 text-slate-800 text-sm font-bold appearance-none focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm">
                                        <option value="transfer">Secure Bank Transfer</option>
                                        <option value="cod">Settlement on Delivery</option>
                                        <option value="ewallet">Integrated Digital Wallet</option>
                                    </select>
                                    <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-300 group-hover/select:text-indigo-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <button type="submit"
                                    class="w-full bg-slate-900 hover:bg-indigo-600 text-white font-black py-7 rounded-[2rem] transition-all shadow-2xl active:scale-95 flex items-center justify-center gap-4 group/btn relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-1000"></div>
                                Finalize Order
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover/btn:translate-x-2 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-indigo-50/50 rounded-full blur-[100px] pointer-events-none"></div>
                </div>
            </aside>

        </div>
    @else
        <div class="glass-card rounded-[5rem] p-32 text-center relative overflow-hidden">
            <div class="relative z-10">
                <div class="w-40 h-40 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-12 relative group/empty">
                    <div class="absolute inset-0 bg-indigo-50 rounded-full scale-0 group-hover/empty:scale-[1.5] transition-transform duration-1000"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-slate-200 relative z-10 transition-colors group-hover/empty:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-4xl md:text-5xl font-black text-slate-800 mb-6 tracking-tight">Curation is Empty</h3>
                <p class="text-slate-400 mb-16 text-xl max-w-md mx-auto font-medium leading-relaxed">Your current selection process has not identified any assets for acquisition yet.</p>
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center gap-6 bg-indigo-600 hover:bg-slate-900 text-white font-black px-16 py-7 rounded-[2.5rem] transition-all shadow-2xl shadow-indigo-200 active:scale-95 group/explore">
                    Discover Assets
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover/explore:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="absolute -right-40 -bottom-40 w-[30rem] h-[30rem] bg-indigo-50/50 rounded-full blur-[150px]"></div>
        </div>
    @endif
</div>

@endsection