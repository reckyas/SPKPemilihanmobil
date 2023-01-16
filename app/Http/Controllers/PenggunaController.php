<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::paginate(10);
        return view('pages.pengguna_all', compact('pengguna'));
    }
    public function add()
    {
        return view('pages.pengguna_add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4'
        ]);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $pengguna = User::create($request->all());
        if ($pengguna) {
            Session::flash('status', 'sukses');
            Session::flash('message', 'Berhasil menambahkan data pengguna');
        } else {
            Session::flash('status', 'gagal');
            Session::flash('message', 'Gagal menambahkan data pengguna');
        }
        return redirect()->route('pengguna.index');
    }
    public function edit($id)
    {
        $pengguna = User::findOrFail($id);
        return view('pages.pengguna_edit',compact('pengguna'));
    }
    public function update(Request $request, $id)
    {
        $pengguna = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id
        ]);
        $data = $request->all();
        if ($request->password) {
            $request->validate(['password'=>'required']);
            $data['password'] =bcrypt($request->password);
        } else {
            $data = $request->except('password');
        }
        if ($pengguna->update($data)) {
            Session::flash('status', 'sukses');
            Session::flash('message', 'Berhasil memperbarui data pengguna');
        } else {
            Session::flash('status', 'gagal');
            Session::flash('message', 'Gagal memperbarui data pengguna');
        }
        return redirect()->route('pengguna.index');
    }
    public function destroy($id)
    {
        $pengguna = User::findOrFail($id);
        if ($pengguna->delete()) {
            Session::flash('status', 'sukses');
            Session::flash('message', 'Berhasil menghapus data pengguna');
        } else {
            Session::flash('status', 'gagal');
            Session::flash('message', 'Gagal menghapus data pengguna');
        }
        return redirect()->route('pengguna.index');
    }
}
