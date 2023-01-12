<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KriteriaController extends Controller
{
    public function index()
    {
        $total_bobot = Kriteria::sum('bobot');
        $kriteria = Kriteria::with('sub_kriteria')->get();
        return view('pages.kriteria_all', compact('kriteria', 'total_bobot'));
    }
    public function addSubKriteria()
    {
        $kriteria = Kriteria::all();
        $data_kriteria = [];
        foreach ($kriteria as $item) {
            $data_kriteria[] = [
                'label' => $item->nama,
                'value' => $item->id
            ];
        }
        return view('pages.sub_kriteria_add', compact('data_kriteria'));
    }
    public function storeSubKriteria(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'bobot' => 'numeric',
            'kriteria_id' => 'required|'
        ]);
        if (SubKriteria::create($request->all())) {
            Session::flash('status', 'sukses');
            Session::flash('message', 'Berhasil menambah data sub kriteria');
        } else {
            Session::flash('status', 'gagal');
            Session::flash('message', 'Gagal menambah data sub kriteria');
        }
        return redirect()->route('sub-kriteria.add');
    }
    public function editKriteria($id)
    {
        $kriteria = Kriteria::whereId($id)->with('sub_kriteria')->first();
        return view('pages.kriteria_edit', compact('kriteria'));
    }
    public function updateKriteria(Request $request, Kriteria $kriteria)
    {
        $request->validate([
            'nama' => 'required',
            'bobot' => 'numeric',
        ]);
        $total_bobot = Kriteria::sum('bobot');
        if ($total_bobot > 1 && $request->bobot > 0) {
            Session::flash('status', 'gagal');
            Session::flash('message', 'Tidak dapat memperbarui kriteria karena total bobot sudah lebih dari 1. Nilai total bobot sekarang ' . $total_bobot);
            return redirect()->route('kriteria.edit', $kriteria->id);
        }
        if ($kriteria->update($request->all())) {
            Session::flash('status', 'sukses');
            Session::flash('message', 'Berhasil memperbarui data kriteria');
        } else {
            Session::flash('status', 'gagal');
            Session::flash('message', 'Gagal memperbaarui data kriteria');
        }
        return redirect()->route('kriteria.edit', $kriteria->id);
    }
    public function updateSubKriteria(Request $request, SubKriteria $sub_kriteria)
    {
        $request->validate([
            'nama' => 'required',
            'bobot' => 'numeric',
        ]);
        if ($sub_kriteria->update($request->all())) {
            Session::flash('status', 'sukses');
            Session::flash('message', 'Berhasil memeperbarui data sub kriteria');
        } else {
            Session::flash('status', 'gagal');
            Session::flash('message', 'Gagal memperbarui data sub kriteria');
        }
        return redirect()->route('kriteria.edit', $request->kriteria_id);
    }
}
