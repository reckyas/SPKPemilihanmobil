@extends('layout.main')
@section('title', 'Pengguna')
@section('content')
    <div class="container mx-auto w-full p-5 sm:p-10">
        <div class="flex sm:gap-2 flex-wrap sm:flex-nowrap">
            <div class="sm:w-3/12 mb-2 w-full">
                <x-sidebar active="Pengguna" />
            </div>
            <div class="sm:w-9/12 w-full">
                <div class="px-5 border rounded-lg">
                    <div class="my-2">
                        <h1 class="text-2xl text-slate-700 font-semibold">Daftar Pengguna</h1>
                    </div>
                    <div class="flex justify-end py-5 gap-2">
                        {{-- <a href="/tambah-kriteria"
                            class="px-3 py-2 font-semibold text-white bg-green-500 hover:bg-green-700 rounded-lg">Tambah Kriteria</a> --}}
                        <a href="{{ route('pengguna.add') }}"
                            class="px-3 py-2 font-semibold text-white bg-blue-500 hover:bg-blue-700 rounded-lg">Tambah Pengguna</a>
                    </div>
                    <div class="py-5 overflow-auto">
                        @if (session()->has('status'))
                            @if (session()->get('status') == 'sukses')
                                <div class="p-3 mb-3 rounded-lg bg-green-500 text-white">{{ session()->get('message') }}
                                </div>
                            @else
                                <div class="p-3 mb-3 rounded-lg bg-red-500 text-white">{{ session()->get('message') }}</div>
                            @endif
                        @endif
                        <table class="table-auto border border-collapse border-slate-500 w-full">
                            <thead>
                                <tr class="bg-slate-300">
                                    <th class="border border-slate-600 px-1">No.</th>
                                    <th class="border border-slate-600 px-1">Nama</th>
                                    <th class="border border-slate-600 px-1">Email</th>
                                    <th class="border border-slate-600 px-1">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengguna as $p)
                                    <tr>
                                        <td class="border border-slate-600 px-1 text-center">{{ $loop->iteration }}</td>
                                        <td class="border border-slate-600 px-1">{{ $p->name }}</td>
                                        <td class="border border-slate-600 px-1">{{ $p->email }}</td>
                                        <td class="border border-slate-600 px-1 py-1">
                                            <a href="{{ route('pengguna.edit', $p->id) }}"
                                                class="px-2 py-1 bg-yellow-500 text-white rounded font-semibold mb-1 inline-block">E</a>
                                            <form action="{{ route('pengguna.delete', $p->id) }}" method="post"
                                                onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-2 py-1 bg-red-500 text-white rounded font-semibold inline-block">X</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $pengguna->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
