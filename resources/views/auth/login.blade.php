@extends('layouts.app')

@section('title', 'Login - VinShop')

@section('content')

<div class="min-h-[70vh] flex items-center justify-center -mt-10">
    <div class="w-full max-w-lg">
        <div class="glass-card rounded-[4rem] p-16 lg:p-20 relative overflow-hidden shadow-2xl shadow-indigo-500/5">
            {{-- Decorative Background --}}
            <div class="absolute -right-32 -top-32 w-80 h-80 bg-indigo-50/50 rounded-full blur-[100px] pointer-events-none group-hover:scale-150 transition-transform duration-1000"></div>
            <div class="absolute -left-32 -bottom-32 w-80 h-80 bg-slate-50/50 rounded-full blur-[100px] pointer-events-none group-hover:scale-150 transition-transform duration-1000"></div>

            <div class="relative z-10">
                <div class="text-center mb-16">
                    <div class="w-20 h-20 bg-indigo-600 rounded-[2.5rem] flex items-center justify-center mx-auto mb-8 shadow-2xl shadow-indigo-600/30 rotate-12 group-hover:rotate-0 transition-transform duration-700">
                        <span class="text-white font-black text-3xl">V</span>
                    </div>
                    <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.4em] mb-4">Secure Authentication</p>
                    <h1 class="text-4xl font-black text-slate-800 tracking-tight">Identity Verification</h1>
                </div>

                <x-auth-session-status class="mb-8" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-8">
                    @csrf

                    {{-- Email --}}
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Credential Identifier</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="user@vinshop.nexus"
                               class="w-full bg-slate-50 border border-slate-100 rounded-[2rem] px-8 py-5 text-slate-800 placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm @error('email') border-rose-200 @enderror">
                        @error('email')
                            <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-4">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="space-y-4">
                        <div class="flex justify-between items-center px-4">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Access Sequence</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[10px] font-black text-indigo-500 hover:text-indigo-700 uppercase tracking-widest transition-colors">
                                    Restore?
                                </a>
                            @endif
                        </div>
                        <input type="password" name="password" required
                               placeholder="••••••••"
                               class="w-full bg-slate-50 border border-slate-100 rounded-[2rem] px-8 py-5 text-slate-800 placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm @error('password') border-rose-200 @enderror">
                        @error('password')
                            <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-4">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4 px-4">
                        <label class="relative flex items-center cursor-pointer group/check">
                            <input type="checkbox" name="remember" class="sr-only peer">
                            <div class="w-12 h-6 bg-slate-100 border border-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-slate-300 after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-indigo-600 peer-checked:after:bg-white"></div>
                            <span class="ms-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] group-hover/check:text-indigo-600 transition-colors">Persistent Session</span>
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full bg-slate-900 hover:bg-indigo-600 text-white font-black py-7 rounded-[2rem] transition-all shadow-2xl active:scale-95 flex items-center justify-center gap-6 group/btn relative overflow-hidden mt-4">
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-1000"></div>
                        Establish Authentication
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover/btn:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>

                    <div class="relative my-12">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-100"></div>
                        </div>
                        <div class="relative flex justify-center text-[10px] font-black uppercase tracking-[0.4em]">
                            <span class="bg-white px-6 text-slate-300">Terminal Node Secure</span>
                        </div>
                    </div>

                    <p class="text-center text-[10px] font-black text-slate-400 uppercase tracking-widest mt-10">
                        New entity registration?
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 transition-colors ml-2 underline underline-offset-4 decoration-indigo-200">Initialize Profile</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@endsection