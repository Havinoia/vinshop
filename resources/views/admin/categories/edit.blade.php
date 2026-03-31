@extends('layouts.admin')

@section('title', 'Domain Modification')

@section('content')

<div class="max-w-3xl mb-24 px-4">
    <a href="{{ route('admin.categories.index') }}" class="group inline-flex items-center gap-3 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-indigo-600 transition-colors mb-12">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Return to Taxonomy Registry
    </a>

    <div class="glass-card rounded-[3rem] p-10 lg:p-16 relative overflow-hidden border border-slate-100 shadow-sm">
        <div class="relative z-10">
            <div class="flex items-center gap-4 mb-12">
                <div class="w-2 h-8 bg-indigo-600 rounded-full"></div>
                <h2 class="text-2xl font-black text-slate-800 tracking-tight">Modify Category Domain Parameters</h2>
            </div>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-10">
                @csrf
                @method('PUT')

                {{-- Nama Kategori --}}
                <div class="space-y-4">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Domain Nomenclature</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                           class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm @error('name') border-rose-200 @enderror">
                    @error('name')
                        <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-4">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Parent Kategori --}}
                <div class="space-y-4">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Hierarchy Positioning <span class="text-slate-200 font-normal ml-2">(Branch Reassignment)</span></label>
                    <select name="parent_id"
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm appearance-none">
                        <option value="" class="text-slate-300">Root Node (No Parent)</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}"
                                {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-6">
                    <button type="submit"
                            class="w-full bg-slate-900 shadow-2xl shadow-slate-900/10 hover:bg-indigo-600 text-white font-black px-12 py-6 rounded-[2.5rem] transition-all active:scale-95 flex items-center justify-center gap-4 text-xs uppercase tracking-[0.2em]">
                        Execute Domain Sync
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