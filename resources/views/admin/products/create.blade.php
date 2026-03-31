@extends('layouts.admin')

@section('title', 'Asset Initialization')

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
                <h2 class="text-2xl font-black text-slate-800 tracking-tight">Initialize New Product Asset</h2>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    {{-- Nama Produk --}}
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Asset Nomenclature</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               placeholder="e.g. Premium Tech Variant X"
                               class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm @error('name') border-rose-200 @enderror">
                        @error('name')
                            <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-4">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Domain Classification</label>
                        <select name="category_id" required
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm appearance-none @error('category_id') border-rose-200 @enderror">
                            <option value="" class="text-slate-300">Select Domain Registry</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-4">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="space-y-4">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Technical Specifications</label>
                    <textarea name="description" rows="4"
                              placeholder="Describe the asset's unique parameters..."
                              class="w-full bg-slate-50 border border-slate-100 rounded-[2rem] px-8 py-6 text-slate-800 placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    {{-- Harga & Stok --}}
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Asset Valuation (IDR)</label>
                        <input type="number" name="price" value="{{ old('price') }}" required min="0"
                               placeholder="150000"
                               class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 font-black placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm @error('price') border-rose-200 @enderror">
                        @error('price')
                            <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-4">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Inventory Volume</label>
                        <input type="number" name="stock" value="{{ old('stock') }}" required min="0"
                               placeholder="10"
                               class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 font-black placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm @error('stock') border-rose-200 @enderror">
                        @error('stock')
                            <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-4">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    {{-- Foto Utama --}}
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Primary Visual Node</label>
                        <div class="relative group/file">
                            <input type="file" name="image" accept="image/*"
                                   class="w-full bg-slate-50 border border-slate-100 border-dashed rounded-2xl px-8 py-10 text-slate-400 text-xs text-center cursor-pointer hover:bg-indigo-50 transition-all focus:outline-none @error('image') border-rose-200 @enderror">
                            @error('image')
                                <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-4">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Foto Tambahan --}}
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Secondary Assets (Multiple)</label>
                        <div class="relative group/file">
                            <input type="file" name="images[]" accept="image/*" multiple
                                   class="w-full bg-slate-50 border border-slate-100 border-dashed rounded-2xl px-8 py-10 text-slate-400 text-xs text-center cursor-pointer hover:bg-slate-100 transition-all focus:outline-none">
                        </div>
                    </div>
                </div>

                {{-- Status Aktif --}}
                <div class="bg-indigo-50/50 p-6 rounded-2xl flex items-center gap-5 group/check border border-indigo-100 transition-all hover:bg-indigo-50">
                    <div class="relative flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="w-6 h-6 rounded-lg border-2 border-indigo-200 text-indigo-600 focus:ring-indigo-500 transition-all cursor-pointer">
                    </div>
                    <label for="is_active" class="flex flex-col cursor-pointer">
                        <span class="text-sm font-black text-slate-800 tracking-tight uppercase">Registry Visibility</span>
                        <span class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest">Enable asset node for marketplace participants</span>
                    </label>
                </div>

                <div class="pt-6">
                    <button type="submit"
                            class="w-full bg-slate-900 shadow-2xl shadow-slate-900/10 hover:bg-indigo-600 text-white font-black px-12 py-6 rounded-[2.5rem] transition-all active:scale-95 flex items-center justify-center gap-4 text-xs uppercase tracking-[0.2em]">
                        Initialize Asset
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7-7 7" />
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