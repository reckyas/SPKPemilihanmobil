@extends('layout.main')
@section('title', 'Mobil')
@section('content')
    <div class="container mx-auto w-full p-5 sm:p-10">
        <div class="flex sm:gap-2 flex-wrap sm:flex-nowrap">
            <div class="sm:w-3/12 mb-2 w-full">
                <x-sidebar active="mobil" />
            </div>
            <div class="sm:w-9/12 w-full">
                <div class="px-5 border rounded-lg">
                    <div class="my-2">
                        <h1 class="text-2xl text-slate-700 font-semibold">List Mobil</h1>
                    </div>
                    <div class="flex justify-end py-5">
                        <a href="/tambah-mobil"
                            class="px-3 py-2 font-semibold text-white bg-green-500 hover:bg-green-700 rounded-lg">Tambah</a>
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
                        <table class="table-auto border border-collapse border-slate-500">
                            <thead>
                                <tr class="bg-slate-300">
                                    <th class="border border-slate-600 px-1">No.</th>
                                    <th class="border border-slate-600 px-1">Gambar</th>
                                    <th class="border border-slate-600 px-1">Nama</th>
                                    <th class="border border-slate-600 px-1">Tahun Keluar</th>
                                    <th class="border border-slate-600 px-1">Harga</th>
                                    <th class="border border-slate-600 px-1">Model</th>
                                    <th class="border border-slate-600 px-1">Transmisi</th>
                                    <th class="border border-slate-600 px-1">Kapasitas Mesin (CC)</th>
                                    <th class="border border-slate-600 px-1">Kapasitas Penumpang</th>
                                    <th class="border border-slate-600 px-1">Konsumsi BBM</th>
                                    <th class="border border-slate-600 px-1">Ketersediaan Sparepart</th>
                                    <th class="border border-slate-600 px-1">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mobil as $item)
                                    <tr>
                                        <td class="border border-slate-600 px-1">{{ $loop->iteration }}</td>
                                        <td class="border border-slate-600 px-1"><img
                                                src="{{ asset('/storage/mobil/' . $item->gambar) }}"
                                                alt="{{ $item->gambar }}"></td>
                                        <td class="border border-slate-600 px-1">{{ $item->nama }}</td>
                                        <td class="border border-slate-600 px-1">{{ $item->tahun_keluar }}</td>
                                        <td class="border border-slate-600 px-1">{{ $item->harga }}</td>
                                        <td class="border border-slate-600 px-1">{{ $item->model }}</td>
                                        <td class="border border-slate-600 px-1">{{ $item->transmisi }}</td>
                                        <td class="border border-slate-600 px-1">{{ $item->kapasitas_mesin }} cc</td>
                                        <td class="border border-slate-600 px-1">{{ $item->kapasitas_penumpang }}</td>
                                        <td class="border border-slate-600 px-1">{{ $item->konsumsi_bbm }}</td>
                                        <td class="border border-slate-600 px-1">{{ $item->ketersediaan_sparepart }}</td>
                                        <td class="border border-slate-600 px-1 py-1">
                                            <a href="/mobil/{{ $item->id }}"
                                                class="px-2 py-1 bg-yellow-500 text-white rounded font-semibold mb-1 inline-block">E</a>
                                            <form action="post"></form>
                                            <form action="{{ route('mobil.delete', $item->id) }}" method="post" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded font-semibold inline-block">X</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $mobil->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
