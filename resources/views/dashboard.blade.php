@extends('layouts.app')

@section('title', 'Control Center - VinShop')

@section('content')

<div class="mb-24">
    <div class="flex flex-col mb-12 px-2">
        <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.4em] mb-4">Command Console</p>
        <h1 class="text-4xl md:text-5xl font-black text-slate-800 tracking-tight flex items-center gap-6">
            Dashboard
            <span class="flex-1 h-[2px] bg-slate-100 rounded-full"></span>
        </h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        {{-- Welcome Card --}}
        <div class="lg:col-span-2 glass-card rounded-[4rem] p-12 lg:p-16 relative overflow-hidden shadow-2xl shadow-indigo-500/5">
            <div class="relative z-10">
                <div class="w-20 h-20 bg-indigo-50 rounded-[2.5rem] flex items-center justify-center mb-10 group/icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600 transition-transform group-hover/icon:scale-110 duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h2 class="text-4xl font-black text-slate-800 mb-6 tracking-tight">Active Session: {{ Auth::user()->name }}</h2>
                <p class="text-slate-400 text-lg font-medium max-w-xl leading-relaxed mb-12">
                    Welcome to your private administration node. From here, you can oversee your acquisitions, manage your identity parameters, and navigate our premium asset registry.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('profile.edit') }}" class="bg-slate-50 hover:bg-slate-100 px-8 py-4 rounded-2xl text-[10px] font-black text-slate-600 uppercase tracking-widest transition-all active:scale-95">
                        Adjust Parameters
                    </a>
                </div>
            </div>
            <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-indigo-50/50 rounded-full blur-[100px]"></div>
        </div>

        {{-- Quick Stats / Links --}}
        <div class="space-y-8">
            <a href="{{ route('orders.index') }}" class="block glass-card rounded-[3rem] p-10 hover:border-indigo-200 transition-all hover:shadow-xl hover:shadow-indigo-500/5 group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-200 group-hover:text-indigo-400 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <h3 class="text-xl font-black text-slate-800 mb-2">Acquisitions</h3>
                <p class="text-sm text-slate-400 font-medium leading-relaxed">
                    Review and track your recent transaction protocols.
                </p>
            </a>

            <a href="{{ route('products.index') }}" class="block glass-card rounded-[3rem] p-10 hover:border-indigo-200 transition-all hover:shadow-xl hover:shadow-indigo-500/5 group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400 group-hover:text-indigo-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-200 group-hover:text-indigo-400 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <h3 class="text-xl font-black text-slate-800 mb-2">Registry</h3>
                <p class="text-sm text-slate-400 font-medium leading-relaxed">
                    Source new premium assets from our curated collection.
                </p>
            </a>
        </div>
    </div>
</div>

@endsection
