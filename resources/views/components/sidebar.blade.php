<div class="border border-red-300 shadow-md rounded-lg overflow-hidden">
    <div class="bg-red-500 px-3 py-2 sm:p-6 sm:text-2xl text-slate-200">MENU</div>
    <div class="p-5">
        <ul class="divide-y-2 sm:text-lg text-slate-600">
            <li>
                <a href="/dashboard"
                    class="block font-semibold px-3 py-2 border-l-4 hover:bg-red-400 @if ($active=='dashboard')
                        bg-red-700 text-white
                    @endif hover:text-white hover:translate-x-1 duration-300 transition uppercase border-red-900">Dashboard</a>
            </li>
            <li>
                <a href="/mobil"
                    class="block font-semibold px-3 py-2 border-l-4 hover:bg-red-400 @if ($active=='mobil')
                        bg-red-700 text-white
                    @endif hover:text-white hover:translate-x-1 duration-300 transition uppercase border-red-900">Mobil</a>
            </li>
            <li>
                <a href="{{ route('kriteria.index') }}"
                    class="block font-semibold px-3 py-2 border-l-4 hover:bg-red-400 @if ($active=='kriteria')
                        bg-red-700 text-white
                    @endif hover:text-white hover:translate-x-1 duration-300 transition uppercase border-red-900">Kriteria</a>
            </li>
            <li>
                <a href="{{ route('pengguna.index') }}"
                    class="block font-semibold px-3 py-2 border-l-4 hover:bg-red-400 @if ($active=='Pengguna')
                        bg-red-700 text-white
                    @endif hover:text-white hover:translate-x-1 duration-300 transition uppercase border-red-900">Pengguna</a>
            </li>
        </ul>
    </div>
</div>
