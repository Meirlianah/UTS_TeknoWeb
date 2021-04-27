<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuruModel;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->GuruModel = new GuruModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'guru'=> $this->GuruModel->allData(),
            'daftar' =>'DAFTAR PENGAJAR',
        ];
        return view('v_guru', $data);
    }

    public function detail($id_guru)
    {
        if (!$this->GuruModel->detailData($id_guru)) {
            abort(404);
        }
        $data = [
            'guru'=> $this->GuruModel->detailData($id_guru),
        ];
        return view('v_detailguru', $data);
    }

    public function add()
    {
        return view('v_addguru');
    }

    public function insert()
    {
        //jika validasi belum terisi
        Request()->validate([
            'nip_guru' =>'required|unique:tbl_guru,nip_guru|min:6|max:7',
            'nama_guru' => 'required',
            'mapel' => 'required',
            'foto_guru' => 'required|mimes:jpg,jpeg,bmp,png|max:1024',
        ], [
            'nip_guru.required' => 'wajib diisi !!',
            'nip_guru.unique' => 'NIP ini sudah ada !!',
            'nip_guru.min' => 'Min 6 Karakter',
            'nip_guru.max' => 'Max 7 Karakter',
            'nama_guru.required' => 'wajib diisi !!',
            'mapel.required' => 'wajib diisi !!',
            'foto_guru.required' => 'wajib diisi !!',
        ]);

        //jika validasi tidak ada, maka lakukan simpan data

        //upload gambar/foto
        $file = Request()->foto_guru;
        $fileName = Request()->nip_guru. '.' . $file->extension();
        $file->move(public_path('foto_guru'), $fileName);

        $data = [
            'nip_guru' => Request()->nip_guru,
            'nama_guru' => Request()->nama_guru,
            'mapel' => Request()->mapel,
            'foto_guru' => $fileName,
        ];

        $this->GuruModel->addData($data);
        return redirect()->route('guru')->with('pesan', 'Data Berhasil di Tambahkan !!!');
    }



    public function edit($id_guru)
    {
        if (!$this->GuruModel->detailData($id_guru)) {
            abort(404);
        }
        $data = [
            'guru'=> $this->GuruModel->detailData($id_guru),
        ];
        return view('v_editguru', $data);
    }

    public function update($id_guru)
    {
        //jika validasi belum terisi
        Request()->validate([
            'nip_guru' =>'required|min:6|max:7',
            'nama_guru' => 'required',
            'mapel' => 'required',
            'foto_guru' => 'mimes:jpg,jpeg,bmp,png|max:1024',
        ], [
            'nip_guru.required' => 'wajib diisi !!',
            'nip_guru.min' => 'Min 6 Karakter',
            'nip_guru.max' => 'Max 7 Karakter',
            'nama_guru.required' => 'wajib diisi !!',
            'mapel.required' => 'wajib diisi !!',
        ]);

        //jika validasi tidak ada, maka lakukan simpan data
        if (Request()->foto_guru <> "") {
            //jika ingin ganti foto
            //upload gambar/foto
            $file = Request()->foto_guru;
            $fileName = Request()->nip_guru. '.' . $file->extension();
            $file->move(public_path('foto_guru'), $fileName);
            $data = [
                'nip_guru' => Request()->nip_guru,
                'nama_guru' => Request()->nama_guru,
                'mapel' => Request()->mapel,
                'foto_guru' => $fileName,
            ];
            $this->GuruModel->editData($id_guru, $data);
        } else {
            //jika tidak ingin ganti foto
            $data = [
                'nip_guru' => Request()->nip_guru,
                'nama_guru' => Request()->nama_guru,
                'mapel' => Request()->mapel,
            ];
            $this->GuruModel->editData($id_guru, $data);
        }
        
        return redirect()->route('guru')->with('pesan', 'Data Berhasil di Update !!!');
    }

    public function delete($id_guru)
    {
        //hapus foto
        $guru = $this->GuruModel->detailData($id_guru);
        if ($guru->foto_guru<>"") {
            unlink(public_path('foto_guru') . '/' .  $guru->foto_guru);
        }
        $this->GuruModel->deleteData($id_guru);
        return redirect()->route('guru')->with('pesan','Data Berhasil di Hapus !!!');
    }
}