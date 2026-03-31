@extends('layouts.admin')

@section('title', 'Asset Modification')

@section('content')

<div class="max-w-4xl mb-24 px-4">
    <a href="{{ route('admin.products.index') }}" class="group inline-flex items-center gap-3 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-indigo-600 transition-colors mb-12">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Return to Registry
    </a>

    <div class="glass-card rounded-[3rem] p-10 lg:p-16 relative overflow-hidden border border-slate-100 shadow-sm">
        <div class="relative z-10">
            <div class="flex items-center gap-4 mb-12">
                <div class="w-2 h-8 bg-indigo-600 rounded-full"></div>
                <h2 class="text-2xl font-black text-slate-800 tracking-tight">Modify Asset Parameters</h2>
            </div>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    {{-- Nama Produk --}}
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Asset Nomenclature</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                               class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm @error('name') border-rose-200 @enderror">
                        @error('name')
                            <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-4">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Domain Classification</label>
                        <select name="category_id" required
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm appearance-none">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="space-y-4">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Technical Specifications</label>
                    <textarea name="description" rows="4"
                              class="w-full bg-slate-50 border border-slate-100 rounded-[2rem] px-8 py-6 text-slate-800 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    {{-- Harga & Stok --}}
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Asset Valuation (IDR)</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0"
                               class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 font-black focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm">
                    </div>
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Inventory Volume</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0"
                               class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 font-black focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    {{-- Foto Utama --}}
                    <div class="space-y-6">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Primary Visual Node</label>
                        @if($product->image)
                            <div class="relative w-40 h-40 group/img">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-3xl shadow-lg border-4 border-white">
                                <div class="absolute inset-0 bg-slate-900/40 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-[10px] font-black text-white uppercase tracking-widest">Active Node</span>
                                </div>
                            </div>
                            <p class="text-[10px] font-bold text-slate-300 uppercase tracking-widest ml-1">Upload new payload to overwrite existing visual branch</p>
                        @endif
                        <input type="file" name="image" accept="image/*"
                               class="w-full bg-slate-50 border border-slate-100 border-dashed rounded-2xl px-8 py-8 text-slate-400 text-xs cursor-pointer hover:bg-indigo-50 transition-all focus:outline-none">
                    </div>

                    {{-- Foto Tambahan --}}
                    <div class="space-y-6">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Secondary Visual Array</label>
                        @if($product->images->count())
                            <div class="flex gap-3 flex-wrap">
                                @foreach($product->images as $image)
                                    <div class="w-16 h-16 rounded-xl overflow-hidden border-2 border-white shadow-sm">
                                        <img src="{{ $product->image }}" alt="secondary node" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <input type="file" name="images[]" accept="image/*" multiple
                               class="w-full bg-slate-50 border border-slate-100 border-dashed rounded-2xl px-8 py-8 text-slate-400 text-xs cursor-pointer hover:bg-slate-100 transition-all focus:outline-none">
                    </div>
                </div>

                {{-- Status Aktif --}}
                <div class="bg-indigo-50/50 p-6 rounded-2xl flex items-center gap-5 group/check border border-indigo-100 transition-all hover:bg-indigo-50">
                    <div class="relative flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                               {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                               class="w-6 h-6 rounded-lg border-2 border-indigo-200 text-indigo-600 focus:ring-indigo-500 transition-all cursor-pointer">
                    </div>
                    <label for="is_active" class="flex flex-col cursor-pointer">
                        <span class="text-sm font-black text-slate-800 tracking-tight uppercase">Registry Visibility</span>
                        <span class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest">Maintain asset node availability for marketplace participants</span>
                    </label>
                </div>

                <div class="pt-6">
                    <button type="submit"
                            class="w-full bg-slate-900 shadow-2xl shadow-slate-900/10 hover:bg-indigo-600 text-white font-black px-12 py-6 rounded-[2.5rem] transition-all active:scale-95 flex items-center justify-center gap-4 text-xs uppercase tracking-[0.2em]">
                        Execute Parameter Sync
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-slate-50/50 rounded-full blur-[80px]"></div>
    </div>
</div>

@endsection

@endsection