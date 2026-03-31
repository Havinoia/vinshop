@extends('layouts.admin')

@section('title', 'Registry Management')

@section('content')

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-12 px-4">
        <div class="space-y-4">
            <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.4em]">Asset Management</p>
            <h2 class="text-4xl font-black text-slate-800 tracking-tight">Product Registry</h2>
        </div>
        <a href="{{ route('admin.products.create') }}"
           class="bg-slate-900 hover:bg-indigo-600 text-white font-black px-10 py-5 rounded-2xl transition-all shadow-xl active:scale-95 text-[10px] uppercase tracking-widest flex items-center gap-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
            </svg>
            Initialize New Asset
        </a>
    </div>

    <div class="glass-card rounded-[3rem] overflow-hidden border border-slate-100 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em] border-b border-slate-50">
                        <th class="py-8 px-8">Visual Node</th>
                        <th class="py-8 px-8">Asset Parameters</th>
                        <th class="py-8 px-8">Classification</th>
                        <th class="py-8 px-8 text-right">Valuation</th>
                        <th class="py-8 px-8 text-center">Inventory</th>
                        <th class="py-8 px-8 text-center">Status</th>
                        <th class="py-8 px-8"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($products as $product)
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="py-6 px-8">
                                <div class="w-16 h-16 rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 shadow-sm group-hover:scale-105 transition-transform duration-500">
                                    @if($product->image)
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        @php
                                            $icon = match(strtolower($product->category->name ?? '')) {
                                                'electronics', 'gadgets' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
                                                'clothing', 'fashion' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                                                'home', 'furniture' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                                                'food', 'groceries' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z',
                                                default => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'
                                            };
                                        @endphp
                                        <div class="w-full h-full flex items-center justify-center text-slate-200 group-hover:text-indigo-400 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icon }}" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="py-6 px-8">
                                <p class="text-base font-black text-slate-800 tracking-tight group-hover:text-indigo-600 transition-colors">{{ $product->name }}</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Registry Ref: #{{ $product->id }}</p>
                            </td>
                            <td class="py-6 px-8">
                                <span class="px-4 py-2 rounded-xl bg-slate-50 text-slate-400 text-[10px] font-black uppercase tracking-widest group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-all">
                                    {{ $product->category->name }}
                                </span>
                            </td>
                            <td class="py-6 px-8 text-right font-black text-slate-800">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="py-6 px-8 text-center font-black">
                                <span class="{{ $product->stock > 0 ? 'text-slate-800' : 'text-rose-500 animate-pulse' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="py-6 px-8 text-center">
                                <span class="px-5 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm
                                    {{ $product->is_active ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-500' }}">
                                    {{ $product->is_active ? 'Active' : 'Locked' }}
                                </span>
                            </td>
                            <td class="py-6 px-8">
                                <div class="flex items-center justify-end gap-3 translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-500">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="w-10 h-10 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                          onsubmit="return confirm('Initiate asset deletion sequence?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-rose-500 hover:border-rose-100 transition-all shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-24 text-center">
                                <p class="text-3xl font-black text-slate-200 tracking-tighter italic">No Asset Protocols Identified</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
        <div class="px-8 py-8 border-t border-slate-50 bg-slate-50/20">
            {{ $products->links() }}
        </div>
        @endif
    </div>

@endsection