<?php

namespace App\Http\Controllers;
use App\Models\SiswaModel;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->SiswaModel = new SiswaModel();
    }

    public function index()
    {
        $data = [
            'siswa'=> $this->SiswaModel->allData(),
        ];
       return view('v_siswa', $data);
    }
}