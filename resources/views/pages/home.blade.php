@extends('layout.main')
@section('title', 'Home')
@section('content')
    <div class="container mx-auto max-w-5xl p-5 sm:p-10">
        <div class="border border-red-300 shadow-md rounded-lg overflow-hidden">
            <div class="bg-red-500 p-3 font-semibold sm:p-6 sm:text-2xl text-slate-200">
                Cari mobil yang anda inginkan sesuai kriteria yang anda mau
            </div>
            <form action="{{ route('hasil-filter') }}" method="get">
                <div class="p-3 sm:p-6 sm:grid sm:grid-cols-2 sm:gap-2">
                    @foreach ($data_filter as $kriteria)
                        <x-input-select name="{{ $kriteria['name'] }}" label="{{ $kriteria['label'] }}" :options="$kriteria['options']"
                            required="{{ false }}" />
                    @endforeach
                </div>
                <div class="w-full px-6 mb-6 pb-4">
                    <button type="submit"
                        class="px-5 py-3 block tracking-wider hover:bg-red-700 shadow-sm shadow-red-900 text-center rounded-lg w-full bg-red-500 font-semibold text-slate-200 text-lg">
                        CARI
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
