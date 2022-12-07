<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // public function getMahasiswaById(Request $request)
    // {
    //     $mahasiswa = Mahasiswa::find($request->id);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'All mahasiswa grabbed',
    //         'data' => [
    //             'mahasiswa' => [
    //                 'nim' => $mahasiswa->nim,
    //                 'nama' => $mahasiswa->nama,
    //                 'angkatan' => $mahasiswa->angkatan
    //             ]
    //         ]
    //     ]);
    // }

    public function getMatakuliahMahasiswa(Request $request)
    {
        $mahasiswa = $request->mahasiswa;
        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa grabbed',
            'matakuliah' => $mahasiswa->matakuliahs,
        ]);
    }

    public function nimprofile(Request $request)
    {
        $mahasiswa = Mahasiswa::find($request->nim);
        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa grabbed',
            'mahasiswa' => $mahasiswa,
            'matakuliah' => $mahasiswa->matakuliahs,
        ]);
    }


    public function addMatakuliah(Request $request)
    {
        $mahasiswa = Mahasiswa::find($request->nim);
        $mahasiswa->matakuliahs()->syncWithoutDetaching($request->mkId);

        return response()->json([
            'success' => true,
            'message' => 'Matakuliah added to Mahasiswa',
        ]);
    }

    public function getAllMahasiswa()
    {
        $mahasiswa = Mahasiswa::get();
        return response()->json([
            'success' => true,
            'message' => 'All Mahasiswa grabbed',
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function allMatakuliah()
    {
        $matakuliah = Matakuliah::get();
        return response()->json([
            'success' => true,
            'message' => 'All Mahasiswa grabbed',
            'matakuliah' => $matakuliah,
        ]);
    }

    public function profile(Request $request)
    {
        $mahasiswa = $request->mahasiswa;

        return response()->json([
            'status' => 'Success',
            'message' => 'selamat datang ' . $mahasiswa->nama,
            'mahasiswa' => $mahasiswa,
        ], 200);
    }

    public function delMatakuliah(Request $request)
    {
        $mahasiswa = Mahasiswa::with('matakuliahs')->find($request->nim);
        $mahasiswa->matakuliahs()->detach($request->mkId);

        return response()->json([
            'success' => true,
            'message' => 'Mata Kuliah Deleted',
        ]);
    }
}
