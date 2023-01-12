@extends('layout.main')
@section('title', 'Tambah Data Mobil')
@section('content')
    <div class="container mx-auto w-full p-5 sm:p-10">
        <div class="flex sm:gap-2 flex-wrap sm:flex-nowrap">
            <div class="sm:w-3/12 mb-2 w-full">
                <x-sidebar active="mobil" />
            </div>
            <div class="sm:w-9/12 w-full">
                <div class="px-5 border rounded-lg">
                    <div class="my-2">
                        <h1 class="text-2xl text-slate-700 font-semibold">Tambah Mobil</h1>
                    </div>
                    <div class="flex justify-end py-5">
                        <a href="/mobil"
                            class="px-3 py-2 font-semibold text-white bg-slate-500 hover:bg-green-700 rounded-lg">Batal</a>
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
                        <form action="/mobil/add" method="post" enctype="multipart/form-data">
                            @csrf
                            <x-input-text name="nama" label="Nama Mobil" />
                            <x-input-text name="tahun_keluar" label="Tahun Keluar" placeholder="Contoh : 2022" />
                            <x-input-text name="harga" label="Harga"
                                placeholder="Masukan harga asli, contoh : 150000000" />
                            <x-input-select name="model" label="Model" :options="[
                                [
                                    'label' => '-- Pilih model mobil --',
                                    'value' => '',
                                ],
                                [
                                    'label' => 'Pick-up',
                                    'value' => 'Pick-up',
                                ],
                                [
                                    'label' => 'Sedan',
                                    'value' => 'Sedan',
                                ],
                                [
                                    'label' => 'City car',
                                    'value' => 'City car',
                                ],
                                [
                                    'label' => 'SUV',
                                    'value' => 'SUV',
                                ],
                                [
                                    'label' => 'MVP',
                                    'value' => 'MVP',
                                ],
                            ]" />
                            <x-input-select name="transmisi" label="Transmisi" :options="[
                                [
                                    'label' => '-- Pilih transmisi mobil --',
                                    'value' => '',
                                ],
                                [
                                    'label' => 'Manual',
                                    'value' => 'Manual',
                                ],
                                [
                                    'label' => 'Automatic',
                                    'value' => 'Automatic',
                                ],
                            ]" />
                            <x-input-text name="kapasitas_mesin" label="Kapasitas Mesin" placeholder="Contoh : 1200" />
                            <x-input-text name="kapasitas_penumpang" label="Kapasitas Penumpang" placeholder="Contoh : 5" />
                            <x-input-select name="konsumsi_bbm" label="Konsumsi BBM" :options="[
                                [
                                    'label' => '-- Pilih konsumsi BBM --',
                                    'value' => '',
                                ],
                                [
                                    'label' => 'Boros',
                                    'value' => 'Boros',
                                ],
                                [
                                    'label' => 'Sedang',
                                    'value' => 'Sedang',
                                ],
                                [
                                    'label' => 'Irit',
                                    'value' => 'Irit',
                                ],
                            ]" />
                            <x-input-select name="ketersediaan_sparepart" label="Ketersediaan Sparepart"
                                :options="[
                                    [
                                        'label' => '-- Pilih ketersediaan sparepart --',
                                        'value' => '',
                                    ],
                                    [
                                        'label' => 'Langka',
                                        'value' => 'Langka',
                                    ],
                                    [
                                        'label' => 'Mahal',
                                        'value' => 'Mahal',
                                    ],
                                    [
                                        'label' => 'Murah',
                                        'value' => 'Murah',
                                    ],
                                    [
                                        'label' => 'Banyak Tersedia',
                                        'value' => 'Banyak Tersedia',
                                    ],
                                ]" />
                            <div class="mb-2">
                                <label for="gambar">
                                    <span class="text-slate-700 font-semibold">Gambar</span>
                                    <input type="file"
                                        class="px-3 py-2 border-2 border-slate-500 mt-1 rounded-lg outline-none focus:ring-2 focus:ring-blue-400 text-slate-700 font-semibold w-full"
                                        name="gambar" id="gambar" placeholder="Pilih gambar mobil" required>
                                </label>
                            </div>
                            <button class="bg-green-500 text-white font-semibold px-3 py-2 rounded-lg"
                                type="submit">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
