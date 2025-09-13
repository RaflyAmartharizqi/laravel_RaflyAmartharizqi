<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasienModel;
use App\Models\RumahSakitModel;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        try {
            $pasien = PasienModel::with('rumah_sakit')->get();
            $rumah_sakit = RumahSakitModel::all();
            return view('pasien.index', compact('pasien', 'rumah_sakit'));
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Error fetching data');
        }
    }

    public function filterByRumahSakit($id_rumah_sakit = null) {
        try {
            if ($id_rumah_sakit == null) {
                $data = PasienModel::with('rumah_sakit')->get();
                return response()->json($data);
            } else {
                $data = PasienModel::with('rumah_sakit')->where('id_rumah_sakit',$id_rumah_sakit)->get();
                return response()->json($data);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Error fetching data');
        }

    }

    public function show($id)
    {
        try {
            $pasien = PasienModel::with('rumah_sakit')->find($id);
            if (!$pasien) {
                return response()->json(['message' => 'Pasien not found'], 404);
            }
            return response()->json($pasien);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Error fetching data');
        }
    }

    public function create()
    {
        try {
            $rumah_sakit = RumahSakitModel::all();
            return view('pasien.create', compact('rumah_sakit'));
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Error fetching data');
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_pasien' => 'required|string|max:255',
                'alamat_pasien' => 'required|string|max:255',
                'no_telp' => 'required|string|max:15',
                'id_rumah_sakit' => 'required|exists:rumah_sakit,id_rumah_sakit',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $pasien = PasienModel::create($request->all());
            return redirect()->route('pasien.index')->with('message', 'Tambah Data Pasien Berhasil');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Error fetching data');
        }
    }

    public function edit($id_pasien)
    {
        try {
            $pasien = PasienModel::find($id_pasien);
            $rumah_sakit = RumahSakitModel::get();

            if (!$pasien) {
                return redirect()->back()->with('message', 'Pasien tidak ditemukan');
            }
            return view('pasien.edit', compact('pasien', 'rumah_sakit'));
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Error fetching data');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pasien = PasienModel::find($id);

            if (!$pasien) {
                return redirect()->back()->with('message', 'Pasien not found');
            }

            $validator = Validator::make($request->all(), [
                'nama_pasien' => 'required|string|max:255',
                'alamat_pasien' => 'required|string|max:255',
                'no_telp' => 'required|string|max:15',
                'id_rumah_sakit' => 'required|exists:rumah_sakit,id_rumah_sakit',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $pasien->update($request->all());
            return redirect()->route('pasien.index')->with('message', 'Update Data Pasien Berhasil');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Error fetching data');
        }
    }

    public function destroy($id)
    {
        try {
            $pasien = PasienModel::find($id);
            if (!$pasien) {
            return redirect()->back()->with('message', 'Pasien Tidak Ditemukan');
            }
            $pasien->delete();
            return response()->json(['message'=> 'Sukses Delete Pasien']);
        } catch (\Exception $e) {
            return response()->json(['message'=> 'Error Hapus Data Pasien'], 500);
        }
    }
}
