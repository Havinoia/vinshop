@extends('layouts.admin')

@section('title', 'Taxonomy Control')

@section('content')

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-12 px-4">
        <div class="space-y-4">
            <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.4em]">Domain Management</p>
            <h2 class="text-4xl font-black text-slate-800 tracking-tight">Taxonomy Nodes</h2>
        </div>
        <a href="{{ route('admin.categories.create') }}"
           class="bg-slate-900 hover:bg-indigo-600 text-white font-black px-10 py-5 rounded-2xl transition-all shadow-xl active:scale-95 text-[10px] uppercase tracking-widest flex items-center gap-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
            </svg>
            Initialize Domain
        </a>
    </div>

    <div class="glass-card rounded-[3rem] overflow-hidden border border-slate-100 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em] border-b border-slate-50">
                        <th class="py-8 px-8">Domain Identification</th>
                        <th class="py-8 px-8">Access Slug</th>
                        <th class="py-8 px-8">Hierarchy Node</th>
                        <th class="py-8 px-8">Registration Date</th>
                        <th class="py-8 px-8"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($categories as $category)
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="py-6 px-8">
                                <p class="text-base font-black text-slate-800 tracking-tight group-hover:text-indigo-600 transition-colors">{{ $category->name }}</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Status: Active Domain</p>
                            </td>
                            <td class="py-6 px-8">
                                <code class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-lg text-[10px] font-black text-slate-400 tracking-wider">
                                    {{ $category->slug }}
                                </code>
                            </td>
                            <td class="py-6 px-8">
                                <span class="px-4 py-2 rounded-xl bg-slate-50 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                                    {{ $category->parent ? $category->parent->name : 'Root Node' }}
                                </span>
                            </td>
                            <td class="py-6 px-8 text-[10px] font-black text-slate-300 uppercase tracking-widest">
                                {{ $category->created_at->format('d M Y') }}
                            </td>
                            <td class="py-6 px-8">
                                <div class="flex items-center justify-end gap-3 translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-500">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                       class="w-10 h-10 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                          onsubmit="return confirm('Initiate domain deletion sequence?')">
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
                            <td colspan="5" class="py-24 text-center">
                                <p class="text-3xl font-black text-slate-200 tracking-tighter italic">No Taxonomy Domains Defined</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($categories->hasPages())
        <div class="px-8 py-8 border-t border-slate-50 bg-slate-50/20">
            {{ $categories->links() }}
        </div>
        @endif
    </div>

@endsection