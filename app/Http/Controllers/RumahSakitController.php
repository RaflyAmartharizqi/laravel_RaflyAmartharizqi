<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RumahSakitModel;
use Illuminate\Support\Facades\Validator;

class RumahSakitController extends Controller
{
    public function index()
    {
        try {
            $rumah_sakit = RumahSakitModel::all();
            return view('rumah_sakit.index', compact('rumah_sakit'));
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Error fetching data');
        }
    }

    public function show($id)
    {
        try {
            $rumah_sakit = RumahSakitModel::find($id);
            if (!$rumah_sakit) {
                return response()->json(['message' => 'Rumah Sakit tidak ditemukan'], 404);
            }
            return response()->json($rumah_sakit);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Error fetching data');
        }
    }

    public function create()
    {
        return view('rumah_sakit.create');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_rumah_sakit' => 'required|string|max:255',
                'alamat_rumah_sakit' => 'required|string|max:255',
                'no_telp' => 'required|string|max:15',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $rumah_sakit = RumahSakitModel::create($request->all());
            return redirect()->route('rumah-sakit.index')->with('message', 'Tambah Data Rumah Sakit Berhasil');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Error creating data');
        }
    }

    public function edit($id_rumah_sakit)
    {
        try {
            $rumah_sakit = RumahSakitModel::find($id_rumah_sakit);
            if (!$rumah_sakit) {
                return redirect()->back()->with('message', 'Rumah Sakit tidak ditemukan');
            }
            return view('rumah_sakit.edit', compact('rumah_sakit'));
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Error fetching data');
        }
    }

    public function update(Request $request, $id_rumah_sakit)
    {
        // try {
            $validator = Validator::make($request->all(), [
                'nama_rumah_sakit' => 'required|string|max:255',
                'alamat_rumah_sakit' => 'required|string|max:255',
                'no_telp' => 'required|string|max:15',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $rumah_sakit = RumahSakitModel::find($id_rumah_sakit);
            if (!$rumah_sakit) {
                return redirect()->back()->with('message', 'Rumah Sakit tidak ditemukan');
            }

            $rumah_sakit->update($request->all());
            return redirect()->route('rumah-sakit.index')->with('message', 'Update Data Rumah Sakit Berhasil');
        // } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Error updating data');
        // }
    }

    public function destroy($id_rumah_sakit)
    {
        try {
            $rumah_sakit = RumahSakitModel::find($id_rumah_sakit);
            if (!$rumah_sakit) {
                return response()->json(['message' => 'Rumah Sakit tidak ditemukan'], 404);
            }

            if ($rumah_sakit->pasien()->count() > 0) {
                return response()->json(['message' => 'Rumah Sakit masih memiliki pasien yang terdaftar'], 400);
            }
            $rumah_sakit->delete();
            return response()->json(['message'=> 'Sukses Delete Rumah Sakit']);
        } catch (\Exception $e) {
            return response()->json(['message'=>'Error Hapus Data Rumah Sakit']);
        }
    }
}
