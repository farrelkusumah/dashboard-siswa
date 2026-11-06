<?php

namespace App\Controllers;
use App\Models\SiswaModel; 

class Siswa extends BaseController
{
    protected $siswaModel;
    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
    }

    //Read

    public function index()
    {
        $id = $this->request->getGet('id');

        $data = [
            'daftarSiswa' => $this->siswaModel->orderBy('id', 'ASC')->findAll(),
        ];
        return view('siswa/index', $data);
    }

    //Create

    public function create()
    {
        $this -> siswaModel -> insert([
            'nama' => $this->request->getPost('nama'),
            'nis' => $this->request->getPost('nis'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'asal' => $this->request->getPost('asal'),
        ]);
        return redirect()->to('/siswa');
    }
}
