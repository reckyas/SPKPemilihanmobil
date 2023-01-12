@extends('layout.main')
@section('title', 'Hasil Pencarian')
@push('head')
    @vite('resources/js/app.js')
@endpush
@section('content')
    <div class="container mx-auto max-w-6xl p-5">
        <div class="sm:flex">
            <div class="w-full sm:w-3/12">
                <div class="border rounded-lg p-5 shadow-md">
                    <h3 class="font-semibold text-2xl mb-3">Kriteria</h3>
                    <div class="divide-y-2">
                        <div class="flex justify-between">
                            <div class="text-slate-700">Tahun Keluar</div>
                            <div class="text-slate-900 font-semibold">{{ app('request')->input('tahun_keluar') ?? '-' }}
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div class="text-slate-700">Harga</div>
                            <div class="text-slate-900 font-semibold">
                                {{ app('request')->input('harga') ?? '-' }}
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div class="text-slate-700">Model mobil</div>
                            <div class="text-slate-900 font-semibold">{{ app('request')->input('model') ?? '-' }}</div>
                        </div>
                        <div class="flex justify-between">
                            <div class="text-slate-700">Transmisi</div>
                            <div class="text-slate-900 font-semibold">{{ app('request')->input('transmisi') ?? '-' }}</div>
                        </div>
                        <div class="flex justify-between">
                            <div class="text-slate-700">Kapasitas mesin</div>
                            <div class="text-slate-900 font-semibold">{{ app('request')->input('kapasitas_mesin') ?? '-' }}
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div class="text-slate-700">Kapasitas penumpang</div>
                            <div class="text-slate-900 font-semibold">
                                {{ app('request')->input('kapasitas_penumpang') ?? '-' }}</div>
                        </div>
                        <div class="flex justify-between">
                            <div class="text-slate-700">Konsumsi BBM</div>
                            <div class="text-slate-900 font-semibold">{{ app('request')->input('konsumsi_bbm') ?? '-' }}
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div class="text-slate-700">Ketersidiaan sparepart</div>
                            <div class="text-slate-900 font-semibold">
                                {{ app('request')->input('ketersediaan_sparetpart') ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full sm:w-9/12">
                <div class="px-5 py-2">
                    <h1 class="font-semibold text-3xl text-slate-700">
                        Hasil pencarian
                    </h1>
                </div>
                <div class="sm:p-5">
                    <form action="{{ route('proses-spk') }}" method="POST" id="form_pilihan_mobil">
                        @csrf
                        @forelse ($data_mobil as $mobil)
                            <div class="border border-slate-200 rounded-lg overflow-hidden shadow-lg lg:flex w-full mb-3">
                                <div class="lg:w-4/12">
                                    <img src="{{ asset('storage/mobil/' . $mobil->gambar) }}" alt="{{ $mobil->nama }}"
                                        class="w-full object-cover h-full" />
                                </div>
                                <div class="lg:w-8/12 py-2 px-4 relative">
                                    <h3 class="font-semibold text-xl text-red-800 uppercase">
                                        {{ $mobil->nama }}
                                    </h3>
                                    <div>
                                        <div class="flex justify-between">
                                            <div class="w-1/2">Tahun keluar</div>
                                            <div class="w-1/2">: {{ $mobil->tahun_keluar }}</div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div class="w-1/2">Harga</div>
                                            <div class="w-1/2">: {{ $mobil->harga }}</div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div class="w-1/2">Model</div>
                                            <div class="w-1/2">: {{ $mobil->model }}</div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div class="w-1/2">Transmisi</div>
                                            <div class="w-1/2">: {{ $mobil->transmisi }}</div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div class="w-1/2">Kapasitas mesin</div>
                                            <div class="w-1/2">: {{ $mobil->kapasitas_mesin }} cc</div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div class="w-1/2">Kapsitas penumpang</div>
                                            <div class="w-1/2">: {{ $mobil->kapasitas_penumpang }}</div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div class="w-1/2">Konsumsi BBM</div>
                                            <div class="w-1/2">: {{ $mobil->konsumsi_bbm }}</div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div class="w-1/2">Ketersidiaan sparepart</div>
                                            <div class="w-1/2">: {{ $mobil->ketersediaan_sparepart }}</div>
                                        </div>
                                    </div>
                                    <div class="xl:absolute right-2 top-2 max-xl:my-3  xl:mt-2">

                                        <label for="{{ 'mobil_' . $mobil->id }}"
                                            class="select-none px-3 py-2 max-sm:block max-xl:font-semibold max-sm:text-center bg-red-400 hover:bg-red-500 cursor-pointer text-white rounded-lg">
                                            <input type="checkbox" name="mobil[]" id="{{ 'mobil_' . $mobil->id }}"
                                                value="{{ $mobil->id }}" /><span>Pilih</span></label>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-3 text-slate-700 text-lg border rounded-lg shadow-sm">Maaf belum ada mobil dengan
                                kriteria yang anda pilih. silahkan mengatur ulang kriteria anda <a
                                    href="{{ route('home') }}" class="text-blue-500 underline">disini</a>.</div>
                        @endforelse
                        <button type="submit" id="button_submit_badingkan"
                            class="fixed px-4 py-3 bg-green-500 text-white bottom-5 right-6 text-xl rounded-lg shadow-xl uppercase tracking-widest">
                            Bandingkan </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
