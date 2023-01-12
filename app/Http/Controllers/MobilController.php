<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    public function index()
    {
        $mobil = Mobil::paginate(10);
        return view('pages.mobil_all', compact('mobil'));
    }
    public function add()
    {
        return view('pages.mobil_add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tahun_keluar' => 'required:date_format:Y',
            'harga' => 'required|numeric',
            'model' => 'required',
            'transmisi' => 'required',
            'kapasitas_mesin' => 'required|numeric',
            'kapasitas_penumpang' => 'numeric',
            'konsumsi_bbm' => 'required',
            'ketersediaan_sparepart' => 'required',
            'gambar' => 'required|image'
        ]);
        $extension = $request->file('gambar')->getClientOriginalExtension();
        $newName = $request->nama . '_' . now()->timestamp . '.' . $extension;
        $request->file('gambar')->storeAs('mobil', $newName);

        $data = $request->except('gambar');
        $data['gambar'] = $newName;
        $mobil = Mobil::create($data);

        if ($mobil) {
            Session::flash('status', 'sukses');
            Session::flash('message', 'Berhasil menambahkan data mobil');
        } else {
            Session::flash('status', 'gagal');
            Session::flash('message', 'Gagal menambahkan data mobil');
        }
        return redirect('/tambah-mobil');
    }
    public function edit($id)
    {
        $mobil = Mobil::find($id);
        return view('pages.mobil_edit', compact('mobil'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'tahun_keluar' => 'required:date_format:Y',
            'harga' => 'required|numeric',
            'model' => 'required',
            'transmisi' => 'required',
            'kapasitas_mesin' => 'required|numeric',
            'kapasitas_penumpang' => 'numeric',
            'konsumsi_bbm' => 'required',
            'ketersediaan_sparepart' => 'required',
            'gambar' => 'image'
        ]);
        $mobil = Mobil::findOrFail($id);
        $data = $request->all();
        if ($request->file('gambar')) {
            Storage::delete('/mobil/' . $mobil->gambar);
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $newName = $request->nama . '_' . now()->timestamp . '.' . $extension;
            $request->file('gambar')->storeAs('mobil', $newName);
            $data = $request->except('gambar');
            $data['gambar'] = $newName;
        }
        if ($mobil->update($data)) {
            $data_kriteria = Kriteria::with('sub_kriteria')->get()->toArray();
            if ($alternatif = Alternatif::where('mobil_id', $id)->first()) {
                $hasil_alternatif = app(\App\Http\Controllers\HomeController::class)->hitungAlternatif(Mobil::where('id', $id)->get(), $data_kriteria);
                foreach ($hasil_alternatif as $al) {
                    $alternatif->update($al);
                }
            }
            Session::flash('status', 'sukses');
            Session::flash('message', 'Berhasil memperbarui data mobil');
        } else {
            Session::flash('status', 'gagal');
            Session::flash('message', 'Gagal memperbarui data mobil');
        }
        return redirect('/mobil');
    }
    public function delete(Mobil $mobil)
    {
        $mobil->delete();
        if ($mobil->delete()) {
            Session::flash('status', 'sukses');
            Session::flash('message', 'Berhasil memperbarui data mobil');
        } else {
            Session::flash('status', 'gagal');
            Session::flash('message', 'Gagal memperbarui data mobil');
        }
        return redirect('/mobil');
    }
}
