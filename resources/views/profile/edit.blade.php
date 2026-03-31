@extends('layouts.app')

@section('title', 'Identity Parameters - VinShop')

@section('content')

<div class="max-w-4xl mx-auto mb-24 px-4">
    <div class="flex flex-col mb-12 px-2">
        <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.4em] mb-4">Identity Management</p>
        <h1 class="text-4xl md:text-5xl font-black text-slate-800 tracking-tight flex items-center gap-6">
            Profile Settings
            <span class="flex-1 h-[2px] bg-slate-100 rounded-full"></span>
        </h1>
    </div>

    <div class="space-y-12">
        {{-- Update Profile Info --}}
        <div class="glass-card rounded-[3rem] p-10 lg:p-16 relative overflow-hidden border border-slate-100 shadow-sm">
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-12">
                    <div class="w-2 h-8 bg-indigo-600 rounded-full"></div>
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight">Core Information</h2>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PATCH')

                    {{-- Foto Profil --}}
                    <div class="flex flex-col md:flex-row items-center gap-10 p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100 group">
                        <div class="relative">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}"
                                     alt="{{ $user->name }}"
                                     class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-2xl group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-32 h-32 rounded-full bg-white flex items-center justify-center text-indigo-600 text-4xl font-black border-4 border-indigo-50 shadow-2xl group-hover:scale-105 transition-transform duration-500">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white shadow-xl border-2 border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                </svg>
                            </div>
                        </div>

                        <div class="flex-1 space-y-4 text-center md:text-left">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Identity Visualizer</label>
                            <input type="file" name="avatar" accept="image/*"
                                   class="text-xs text-slate-400 file:mr-6 file:py-3 file:px-8 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:bg-slate-900 file:text-white hover:file:bg-indigo-600 transition-all cursor-pointer">
                            <p class="text-[10px] font-bold text-slate-300 uppercase tracking-widest mt-2">JPG, PNG, WEBP • Max Volume 1MB</p>
                            @error('avatar')
                                <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Nama --}}
                        <div class="space-y-4">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Full Identity</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                   class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm @error('name') border-rose-200 @enderror">
                            @error('name')
                                <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-4">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="space-y-4">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Communication Node</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                   class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm @error('email') border-rose-200 @enderror">
                            @error('email')
                                <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-4">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Phone --}}
                        <div class="space-y-4">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Voice Interface</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                   placeholder="+62 800 0000 0000"
                                   class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm">
                        </div>

                        {{-- Address --}}
                        <div class="space-y-4">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Dispatch Coordinates</label>
                            <textarea name="address" rows="1"
                                      placeholder="Full physical address..."
                                      class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm">{{ old('address', $user->address) }}</textarea>
                        </div>
                    </div>

                    <div class="flex items-center gap-6 pt-4">
                        <button type="submit"
                                class="bg-indigo-600 hover:bg-slate-900 text-white font-black px-10 py-5 rounded-2xl transition-all shadow-2xl shadow-indigo-200 active:scale-95 text-xs uppercase tracking-widest">
                            Update Registry
                        </button>

                        @if(session('status') === 'profile-updated')
                            <p class="text-emerald-500 text-[10px] font-black uppercase tracking-widest flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                                Synchronization Successful
                            </p>
                        @endif
                    </div>
                </form>
            </div>
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-slate-50/50 rounded-full blur-[80px]"></div>
        </div>

        {{-- Ganti Password --}}
        <div class="glass-card rounded-[3rem] p-10 lg:p-16 relative overflow-hidden border border-slate-100 shadow-sm">
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-12">
                    <div class="w-2 h-8 bg-slate-900 rounded-full"></div>
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight">Access Control</h2>
                </div>

                <form method="POST" action="{{ route('password.update') }}" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Legacy Access Key</label>
                        <input type="password" name="current_password" required
                               placeholder="••••••••"
                               class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm @error('current_password') border-rose-200 @enderror">
                        @error('current_password')
                            <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-4">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">New Access Sequence</label>
                            <input type="password" name="password" required
                                   placeholder="••••••••"
                                   class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm @error('password') border-rose-200 @enderror">
                            @error('password')
                                <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-4">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-4">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-4">Sequence Integrity Check</label>
                            <input type="password" name="password_confirmation" required
                                   placeholder="••••••••"
                                   class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-8 py-5 text-slate-800 placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all shadow-sm">
                        </div>
                    </div>

                    <div class="flex items-center gap-6 pt-4">
                        <button type="submit"
                                class="bg-slate-900 hover:bg-indigo-600 text-white font-black px-10 py-5 rounded-2xl transition-all shadow-2xl active:scale-95 text-xs uppercase tracking-widest">
                            Update Security Protocol
                        </button>

                        @if(session('status') === 'password-updated')
                            <p class="text-emerald-500 text-[10px] font-black uppercase tracking-widest flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                                Security Mesh Restructured
                            </p>
                        @endif
                    </div>
                </form>
            </div>
            <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-slate-50/50 rounded-full blur-[80px]"></div>
        </div>
    </div>
</div>

@endsection

@endsection