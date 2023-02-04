@extends('layout.main')
@section('title', 'Hasil Perbandingan')
@section('content')
    <div class="container mx-auto max-w-6xl p-5">
        <div class="sm:flex">
            <div class="w-full">
                <div class="px-5 py-2">
                    <h1 class="font-semibold text-3xl text-slate-700">
                        Hasil perbandingan
                    </h1>
                </div>
                <div class="sm:p-5">
                    @forelse ($hasil_rangking as $alternatif)
                        <div class="border border-slate-200 rounded-lg overflow-hidden shadow-lg sm:flex mb-3">
                            <div class="sm:w-5/12">
                                <img src="{{ asset('storage/mobil/' . $alternatif['mobil']['gambar']) }}"
                                    alt="{{ $alternatif['mobil']['nama'] }}" class="w-full object-cover h-full" />
                            </div>
                            <div class="sm:w-7/12 py-2 px-4">
                                <div class="right-2 mt-2">
                                    <div
                                        class="rounded-lg p-4 text-center items-center font-semibold sm:text-2xl text-white {{ $warna_rangking[$loop->iteration] ?? 'bg-slate-400' }} text-lg">
                                        {{ $loop->iteration }}
                                    </div>
                                </div>
                                <h3 class="font-semibold text-xl text-red-800 uppercase">
                                    {{ $alternatif['mobil']['nama'] }}
                                </h3>
                                <div>
                                    <div class="flex justify-between">
                                        <div class="w-1/2">Tahun keluar</div>
                                        <div class="w-1/2">: {{ $alternatif['mobil']['tahun_keluar'] }}</div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="w-1/2">Harga</div>
                                        <div class="w-1/2">: @currency($alternatif['mobil']['harga'])</div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="w-1/2">Model</div>
                                        <div class="w-1/2">: {{ $alternatif['mobil']['model'] }}</div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="w-1/2">Transmisi</div>
                                        <div class="w-1/2">: {{ $alternatif['mobil']['transmisi'] }}</div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="w-1/2">Kapasitas mesin</div>
                                        <div class="w-1/2">: {{ $alternatif['mobil']['kapasitas_mesin'] }} cc</div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="w-1/2">Kapsitas penumpang</div>
                                        <div class="w-1/2">: {{ $alternatif['mobil']['kapasitas_penumpang'] }}</div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="w-1/2">Konsumsi BBM</div>
                                        <div class="w-1/2">: {{ $alternatif['mobil']['konsumsi_bbm'] }}</div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="w-1/2">Ketersidiaan sparepart</div>
                                        <div class="w-1/2">: {{ $alternatif['mobil']['ketersediaan_sparepart'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-3 text-slate-700 text-lg border rounded-lg shadow-sm">Maaf belum ada mobil dengan
                            kriteria yang anda pilih. silahkan mengatur ulang kriteria anda <a href="{{ route('home') }}"
                                class="text-blue-500 underline">disini</a>.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
