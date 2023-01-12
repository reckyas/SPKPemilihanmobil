<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Mobil;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::with('sub_kriteria')->get();
        $data_filter = [];
        foreach ($kriteria as $item) {
            $filter = [['label' => '-- Pilih ' . $item->nama . ' --', 'value' => '']];
            foreach ($item->sub_kriteria as $sb) {
                $filter[] = [
                    'label' => $sb->nama,
                    'value' => $sb->nama
                ];
            }
            $name = str_replace(' ', '_', strtolower($item->nama));
            $data_filter[] = ['name' => $name, 'label' => $item->nama, 'options' => $filter];
        }
        // dd($data_filter);
        return view('pages.home', compact('data_filter'));
    }
    public function hasilFilter(Request $request)
    {
        $mobil = Mobil::select('*');
        $filter_range = $request->only(['tahun_keluar', 'harga', 'kapasitas_mesin', 'kapasitas_penumpang']);
        $filter_static = $request->only(['model', 'transmisi', 'konsumsi_bbm', 'ketersediaan_sparepart']);
        foreach ($filter_range as $key => $value) {
            if ($value !== null) {
                if (is_numeric(strpos($value, '-'))) {
                    $rawFilter = explode('-', $value);
                    $mobil->whereBetween($key, $rawFilter);
                } else if (is_numeric(strpos($value, '>'))) {
                    $rawFilter = explode('>', $value);
                    $mobil->where($key, '>', $rawFilter[1]);
                } else if (is_numeric(strpos($value, '<'))) {
                    $rawFilter = explode('<', $value);
                    $mobil->where($key, '<', $rawFilter[1]);
                } else {
                    $mobil->where($key, $value);
                }
            }
        }
        foreach ($filter_static as $key => $value) {
            if ($value !== null) {
                $mobil->where($key, $value);
            }
        }
        return view('pages.hasil_filter', ['data_mobil' => $mobil->get()]);
    }
    public function prosesSPK(Request $request)
    {
        $id_mobil = $request->mobil;
        $alternatif = Alternatif::whereIn('mobil_id', $request->mobil);
        $data_kriteria = Kriteria::with('sub_kriteria')->get()->toArray();
        if ($alternatif->count() > 0) {
            foreach ($alternatif->get() as $al) {
                if (($key = array_search($al->mobil_id, $id_mobil)) !== false) {
                    unset($id_mobil[$key]);
                }
            }
        }
        if (count($id_mobil) !== 0) {
            $data_mobil = Mobil::whereIn('id', $id_mobil)->get();
            $data_alternatif = $this->hitungAlternatif($data_mobil, $data_kriteria);
            foreach ($data_alternatif as $data) {
                Alternatif::create($data);
            }
            $alternatif = Alternatif::whereIn('mobil_id', $request->mobil);
        }
        $hasil_rangking = $this->hitungSPK($data_kriteria,$alternatif);
        $warna_rangking = [1=>'bg-blue-500', 2=>'bg-yellow-500', 3 =>'bg-slate-500'];
        return view('pages.hasil_spk', compact('hasil_rangking','warna_rangking'));
    }
    public function hitungAlternatif($data_mobil, $data_kriteria)
    {
        $data_alternatif = [];
            $filter_static = ['Model', 'Transmisi', 'Konsumsi BBM', 'Ketersediaan Sparepart'];
            foreach ($data_mobil as $mobil) {
                $tahun_keluar = date('Y', strtotime($mobil->tahun_keluar . '-1-1'));
                foreach ($data_kriteria[0]['sub_kriteria'] as $sk) {
                    if (is_numeric(strpos($sk['nama'], '-'))) {
                        $rawFilter = explode('-', $sk['nama']);
                        $tahun_awal = date('Y', strtotime($rawFilter[0] . '-1-1'));
                        $tahun_akhir = date('Y', strtotime($rawFilter[1] . '-1-1'));
                        if ($tahun_keluar >= $tahun_awal && $tahun_keluar <= $tahun_akhir) {
                            $data_alternatif[$mobil->id - 1] = ['mobil_id' => $mobil->id, 'tahun_keluar' => $sk['bobot']];
                            break;
                        }
                    } else if (is_numeric(strpos($sk['nama'], '>'))) {
                        $rawFilter = explode('>', $sk['nama']);
                        $tahun_awal = date('Y', strtotime($rawFilter[1] . '-1-1'));
                        if ($tahun_keluar > $tahun_awal) {
                            $data_alternatif[$mobil->id - 1] = ['mobil_id' => $mobil->id, 'tahun_keluar' => $sk['bobot']];
                            break;
                        }
                    } else if (is_numeric(strpos($sk['nama'], '<'))) {
                        $rawFilter = explode('<', $sk['nama']);
                        $tahun_akhir = date('Y', strtotime($rawFilter[1] . '-1-1'));
                        if ($tahun_keluar < $tahun_akhir) {
                            $data_alternatif[$mobil->id - 1] = ['mobil_id' => $mobil->id, 'tahun_keluar' => $sk['bobot']];
                            break;
                        }
                    } else {
                        if ($tahun_keluar == strtotime('Y', $sk['nama'])) {
                            $data_alternatif[$mobil->id - 1] = ['mobil_id' => $mobil->id, 'tahun_keluar' => $sk['bobot']];
                            break;
                        }
                    }
                }
                foreach ($data_kriteria[1]['sub_kriteria'] as $sk) {
                    if (is_numeric(strpos($sk['nama'], '-'))) {
                        $rawFilter = explode('-', $sk['nama']);
                        if ($mobil->harga >= $rawFilter[0] && $mobil->harga <= $rawFilter[1]) {
                            $data_alternatif[$mobil->id - 1]['harga'] = $sk['bobot'];
                            break;
                        }
                    } else if (is_numeric(strpos($sk['nama'], '>'))) {
                        $rawFilter = explode('>', $sk['nama']);
                        if ($mobil->harga > $rawFilter[1]) {
                            $data_alternatif[$mobil->id - 1]['harga'] = $sk['bobot'];
                            break;
                        }
                    } else if (is_numeric(strpos($sk['nama'], '<'))) {
                        $rawFilter = explode('<', $sk['nama']);
                        if ($mobil->harga < $rawFilter[1]) {
                            $data_alternatif[$mobil->id - 1]['harga'] = $sk['bobot'];
                            break;
                        }
                    } else {
                        if ($mobil->harga == $rawFilter[1]) {
                            $data_alternatif[$mobil->id - 1]['harga'] = $sk['bobot'];
                            break;
                        }
                    }
                }
                foreach ($data_kriteria[4]['sub_kriteria'] as $sk) {
                    if (is_numeric(strpos($sk['nama'], '-'))) {
                        $rawFilter = explode('-', $sk['nama']);
                        if ($mobil->kapasitas_mesin >= $rawFilter[0] && $mobil->kapasitas_mesin <= $rawFilter[1]) {
                            $data_alternatif[$mobil->id - 1]['kapasitas_mesin'] = $sk['bobot'];
                            break;
                        }
                    } else if (is_numeric(strpos($sk['nama'], '>'))) {
                        $rawFilter = explode('>', $sk['nama']);
                        if ($mobil->kapasitas_mesin > $rawFilter[1]) {
                            $data_alternatif[$mobil->id - 1]['kapasitas_mesin'] = $sk['bobot'];
                            break;
                        }
                    } else if (is_numeric(strpos($sk['nama'], '<'))) {
                        $rawFilter = explode('<', $sk['nama']);
                        if ($mobil->kapasitas_mesin < $rawFilter[1]) {
                            $data_alternatif[$mobil->id - 1]['kapasitas_mesin'] = $sk['bobot'];
                            break;
                        }
                    } else {
                        if ($mobil->kapasitas_mesin == $rawFilter[1]) {
                            $data_alternatif[$mobil->id - 1]['kapasitas_mesin'] = $sk['bobot'];
                            break;
                        }
                    }
                }
                foreach ($data_kriteria[5]['sub_kriteria'] as $sk) {
                    if (is_numeric(strpos($sk['nama'], '-'))) {
                        $rawFilter = explode('-', $sk['nama']);
                        if ($mobil->kapasitas_penumpang >= $rawFilter[0] && $mobil->kapasitas_penumpang <= $rawFilter[1]) {
                            $data_alternatif[$mobil->id - 1]['kapasitas_penumpang'] = $sk['bobot'];
                            break;
                        }
                    } else if (is_numeric(strpos($sk['nama'], '>'))) {
                        $rawFilter = explode('>', $sk['nama']);
                        if ($mobil->kapasitas_penumpang > $rawFilter[1]) {
                            $data_alternatif[$mobil->id - 1]['kapasitas_penumpang'] = $sk['bobot'];
                            break;
                        }
                    } else if (is_numeric(strpos($sk['nama'], '<'))) {
                        $rawFilter = explode('<', $sk['nama']);
                        if ($mobil->kapasitas_penumpang < $rawFilter[1]) {
                            $data_alternatif[$mobil->id - 1]['kapasitas_penumpang'] = $sk['bobot'];
                            break;
                        }
                    } else {
                        if ($mobil->kapasitas_penumpang == $sk['nama']) {
                            $data_alternatif[$mobil->id - 1]['kapasitas_penumpang'] = $sk['bobot'];
                            break;
                        }
                    }
                }
                foreach ($data_kriteria as $dk) {
                    if (in_array($dk['nama'], $filter_static)) {
                        $filter = [
                            'Model' => 'model',
                            'Transmisi' => 'transmisi',
                            'Konsumsi BBM' => 'konsumsi_bbm',
                            'Ketersediaan Sparepart' => 'ketersediaan_sparepart'
                        ];
                        foreach ($dk['sub_kriteria'] as $sk) {
                            if ($sk['nama'] == $mobil[$filter[$dk['nama']]]) {
                                $data_alternatif[$mobil->id - 1][$filter[$dk['nama']]] = $sk['bobot'];
                            }
                        }
                    }
                }
            }
            return $data_alternatif;
    }
    public function hitungSPK($data_kriteria,$alternatif)
    {
        $hasil_perhitungan = [];
        $hasil_alternatif = [];
        $filter = [
            'Tahun keluar' => 'tahun_keluar',
            'Harga' => 'harga',
            'Model' => 'model',
            'Transmisi' => 'transmisi',
            'Kapasitas mesin' => 'kapasitas_mesin',
            'Kapasitas penumpang' => 'kapasitas_penumpang',
            'Konsumsi BBM' => 'konsumsi_bbm',
            'Ketersediaan Sparepart' => 'ketersediaan_sparepart'
        ];
        foreach ($data_kriteria as $dk) {
            foreach ($alternatif->get() as $al) {
                $hasil_perhitungan[$al->id][$filter[$dk['nama']]] = ($al[$filter[$dk['nama']]] / $alternatif->max($filter[$dk['nama']])) * $dk['bobot'];
            }
        }
        foreach ($hasil_perhitungan as $key => $value) {
            $hasil_alternatif[$key] = array_sum($value);
        }
        $hasil_rangking = collect($hasil_alternatif)->sortDesc();
        foreach ($alternatif->with('mobil')->get()->toArray() as $al) {
            $hasil_rangking[$al['id']] = $al;
        }
        return $hasil_rangking;
    }
}
