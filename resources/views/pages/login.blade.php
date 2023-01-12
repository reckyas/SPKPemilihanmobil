@extends('layout.main')
@section('title', 'Login')
@section('content')
    <div class="container mx-auto max-w-md p-5 sm:p-10">
        <div class="border border-red-300 shadow-md rounded-lg overflow-hidden">
            <div class="bg-red-500 p-6 text-2xl text-slate-200">LOGIN</div>
            <div class="p-5">
                @if (session()->has('loginError'))
                    <div class="bg-red-400 p-3 text-base text-red-900 rounded-lg">
                        Login gagal
                    </div>
                @endif
                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label for="email">
                            <span class="text-slate-700 font-semibold">Email</span>
                            <input placeholder="Masukan email" type="email" name="email" id="email" required
                                class="px-3 py-2 border-2 border-slate-500 mt-1 rounded-lg outline-none focus:ring-2 focus:ring-blue-400 text-slate-700 font-semibold w-full" value="{{ old('email') }}" />
                            @error('email')
                                <span class="text-red-500 text-xs">Email salah</span>
                            @enderror
                        </label>
                    </div>
                    <div class="mb-2">
                        <label for="password">
                            <span class="text-slate-700 font-semibold">Password</span>
                            <input placeholder="Masukan password" type="password" name="password" id="password" required
                                class="px-3 py-2 border-2 border-slate-500 mt-1 rounded-lg outline-none focus:ring-2 focus:ring-blue-400 text-slate-700 font-semibold w-full" />
                        </label>
                    </div>
                    <button type="submit"
                        class="w-full tracking-wider px-3 py-2 text-white font-semibold text-lg bg-red-500 hover:bg-red-600 shadow-md rounded-lg">Masuk</button>
                </form>
            </div>
        </div>
    </div>
@endsection
