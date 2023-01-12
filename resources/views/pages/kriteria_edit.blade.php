@extends('layout.main')
@section('title', 'Edit Kriteria')
@section('content')
    <div class="container mx-auto w-full p-5 sm:p-10">
        <div class="flex sm:gap-2 flex-wrap sm:flex-nowrap">
            <div class="sm:w-3/12 mb-2 w-full">
                <x-sidebar active="kriteria" />
            </div>
            <div class="sm:w-9/12 w-full">
                <div class="px-5 border rounded-lg">
                    <div class="my-2">
                        <h1 class="text-2xl text-slate-700 font-semibold">Edit Kriteria</h1>
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
                        <form action="{{ route('kriteria.update',$kriteria->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <x-input-text name="nama" label="Nama kriteria" value="{{ $kriteria->nama }}" disable="{{ true }}" />
                            <x-input-text name="bobot" label="Bobot Kriteria" value="{{ $kriteria->bobot }}"
                                placeholder="Contoh : 2" />
                            <button class="bg-green-500 text-white font-semibold px-3 py-2 rounded-lg"
                                type="submit">Update</button>
                        </form>
                        <div class="my-4 p-3 border border-slate-300 shadow-md rounded-lg">
                            <h1 class="text-lg font-semibold text-slate-700 mb-3">Sub Kriteria</h1>
                            @foreach ($kriteria->sub_kriteria as $sb)
                                <form action="{{ route('sub-kriteria.update',$sb->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="kriteria_id" value="{{ $kriteria->id }}">
                                    <div class="py-2 sm:flex sm:gap-1 w-full items-center border px-3 mb-2 rounded-lg bg-slate-100 shadow-md">
                                        <x-input-text name="nama" label="Nama kriteria"
                                            value="{!! $sb->nama !!}" />
                                        <x-input-text name="bobot" label="Bobot Kriteria"
                                            value="{!! $sb->bobot !!}" />
                                        <div class="sm:pt-5">
                                            <button type="submit"
                                                class="px-3 py-2 bg-blue-500 text-white rounded-lg">Ubah</button>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
