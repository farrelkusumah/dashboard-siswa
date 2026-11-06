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
        $searchQuery = trim((string) $this->request->getGet('cari'));
        $searchCategory = trim((string) $this->request->getGet('kategori'));

        if ($searchQuery !== '') {
            if ($searchCategory === 'nama') {
                $this->siswaModel->where('nama', $searchQuery);
            } elseif ($searchCategory === 'asal') {
                $this->siswaModel->where('asal', $searchQuery);
            } elseif ($searchCategory === 'nis') {
                $this->siswaModel->like('nis', $searchQuery);
            } else {
                $this->siswaModel->groupStart()
                    ->where('nama', $searchQuery)
                    ->orWhere('asal', $searchQuery)
                    ->orWhere('nis', $searchQuery)
                    ->groupEnd();
            }
        }

        $data = [
            'daftarSiswa' => $this->siswaModel->orderBy('id', 'ASC')->findAll(),
            'editSiswa' => $id ? $this->siswaModel->find($id) : null,
            'searchQuery' => $searchQuery,
            'searchCategory' => $searchCategory
        ];
        return view('siswa/index', $data);
    }

    //Create

    public function create()
    {
        $this->siswaModel->insert([
            'nama'          => $this->request->getPost('nama'),
            'nis'           => $this->request->getPost('nis'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'asal'          => $this->request->getPost('asal'),
        ]);
        return redirect()->to('/siswa');
    }

    //Edit

    public function update($id)
    {
        $this->siswaModel->update($id, [
            'nama'          => $this->request->getPost('nama'),
            'nis'           => $this->request->getPost('nis'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'asal'          => $this->request->getPost('asal'),
        ]);
        return redirect()->to('/siswa');
    }

    //Delete

    public function delete($id)
    {
        $this->siswaModel->delete($id);
        return redirect()->to('/siswa');
    }
}
