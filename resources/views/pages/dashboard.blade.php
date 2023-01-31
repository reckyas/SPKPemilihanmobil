@extends('layout.main')
@section('title', 'Dashboard')
@section('content')
    <div class="container mx-auto w-full p-5 sm:p-10">
        <div class="flex sm:gap-2 flex-wrap sm:flex-nowrap">
            <div class="sm:w-3/12 mb-2 w-full">
                <x-sidebar active="dashboard" />
            </div>
            <div class="sm:w-9/12 w-full">
                <div class="px-5 border rounded-lg overflow-auto">
                    <div class="my-2">
                        <h1 class="text-2xl text-slate-700 font-semibold">Selamat datang, {{ auth()->user()->name }}</h1>
                    </div>
                    <div>
                        <h3 class="my-2 text-lg font-semibold">Data Mobil</h3>
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
                                        <td class="border border-slate-600 px-1">@currency($item->harga)</td>
                                        <td class="border border-slate-600 px-1">{{ $item->model }}</td>
                                        <td class="border border-slate-600 px-1">{{ $item->transmisi }}</td>
                                        <td class="border border-slate-600 px-1">{{ $item->kapasitas_mesin }} cc</td>
                                        <td class="border border-slate-600 px-1">{{ $item->kapasitas_penumpang }}</td>
                                        <td class="border border-slate-600 px-1">{{ $item->konsumsi_bbm }}</td>
                                        <td class="border border-slate-600 px-1">{{ $item->ketersediaan_sparepart }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $mobil->links() }}
                    </div>
                    <div>
                        <h3 class="my-2 text-lg font-semibold">Data Kriteria</h3>
                        <table class="table-auto border border-collapse border-slate-500 w-full">
                            <thead>
                                <tr class="bg-slate-300">
                                    <th class="border border-slate-600 px-1">No.</th>
                                    <th class="border border-slate-600 px-1">Nama</th>
                                    <th class="border border-slate-600 px-1">Bobot</th>
                                    <th class="border border-slate-600 px-1">Sub Kriteria</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kriteria as $item)
                                    <tr>
                                        <td class="border border-slate-600 px-1 text-center">{{ $loop->iteration }}</td>
                                        <td class="border border-slate-600 px-1 font-semibold">{{ $item->nama }}</td>
                                        <td class="border border-slate-600 px-1 text-center">{{ $item->bobot }}</td>
                                        <td class="border border-slate-600 px-1">
                                            @foreach ($item->sub_kriteria as $sb)
                                                <ul>
                                                    <li class="flex justify-between px-2 py-1">
                                                        <div>{{ $sb->nama }}</div>
                                                        <div>{{ $sb->bobot }}</div>
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="border border-slate-600 px-1 py-1 font-semibold text-center">
                                        Total Bobot</td>
                                    <td class="border border-slate-600 px-1 py-1 text-center"></td>
                                    <td class="border border-slate-600 px-1 py-1 text-center">{{ $total_bobot }}</td>
                                    <td class="border border-slate-600 px-1 py-1"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
