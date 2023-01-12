@extends('layout.main')
@section('title', 'Tambah Sub Kriteria')
@section('content')
    <div class="container mx-auto w-full p-5 sm:p-10">
        <div class="flex sm:gap-2 flex-wrap sm:flex-nowrap">
            <div class="sm:w-3/12 mb-2 w-full">
                <x-sidebar active="kriteria" />
            </div>
            <div class="sm:w-9/12 w-full">
                <div class="px-5 border rounded-lg">
                    <div class="my-2">
                        <h1 class="text-2xl text-slate-700 font-semibold">Tambah Sub Kriteria</h1>
                    </div>
                    <div class="flex justify-end py-5">
                        <a href="{{ route('kriteria.index') }}"
                            class="px-3 py-2 font-semibold text-white bg-slate-500 hover:bg-slate-700 rounded-lg">Batal</a>
                    </div>
                    <div class="py-5">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-600">{{ $error }}</li>
                            @endforeach
                        </ul>
                        @if (session()->has('status'))
                            @if (session()->get('status') == 'sukses')
                                <div class="p-3 rounded-lg bg-green-500 text-white">{{ session()->get('message') }}</div>
                            @else
                                <div class="p-3 rounded-lg bg-red-500 text-white">{{ session()->get('message') }}</div>
                            @endif
                        @endif
                        <form action="{{ route('sub-kriteria.store') }}" method="post">
                            @csrf
                            <x-input-select name="kriteria_id" label="Kriteria" :options="$data_kriteria" />
                            <x-input-text name="nama" label="Nama Sub Kriteria" />
                            <x-input-text name="bobot" label="Bobot Sub Kriteria" placeholder="Contoh : 2" />
                            <button class="bg-green-500 text-white font-semibold px-3 py-2 rounded-lg"
                                type="submit">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
