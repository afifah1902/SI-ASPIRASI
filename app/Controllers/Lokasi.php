<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;
use App\Models\LokasiModel;

class Lokasi extends BaseController
{
    public function __construct()
    {
        $this->lokasi = new LokasiModel();
        $this->pengaduan = new PengaduanModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'user' => $this->user,
            'title' => 'Daftar Lokasi',
            'data' => $this->lokasi->where(['row_status'=> 1])->findAll()
        ];
        return view('admin/manage-lokasi/index', $data);
    }
   
    public function soft_delete($id)
    {   
        $this->lokasi->save([
            'id' => $id,
            'deleted_at' => date('Y-m-d H:i:s'),
            'row_status' => 0
        ]);

        session()->setFlashdata('msg', 'Data berhasil dihapus.');
        return redirect()->to('/admin/manage-lokasi');
    }
    public function tambah()
    {
        $data = [
            'user' => $this->user,
            'lokasi' => $this->lokasi->getLokasi(),
            'title' => 'Tambah Lokasi Baru',
            'validation' => $this->validation
        ];
        return view('admin/manage-lokasi/tambah_lokasi', $data);
    }
   
    public function tambah_lokasi()
    {
        
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama RT wajib diisi.'
                ]
            
            ],
            'nama_ketua_rt' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Ketua RT wajib diisi.'
                ]
            ],
            
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/lokasi/tambah')->withInput();
        }

        $this->db->transBegin(); // Begin DB Transaction

        try {
            $this->lokasi->save([
                'nama' => $this->request->getPost('nama'),
                'nama_ketua_rt' => $this->request->getPost('nama_ketua_rt'),
            ]);

            

            $this->db->transCommit();
        } catch (\Exception $e) {
            $this->db->transRollback();

            // session()->setFlashdata('error-msg', $e->getMessage());
            session()->setFlashdata('error-msg', 'Terjadi kesalahan, data gagal ditambah.');
            return redirect()->to('/admin/manage-lokasi/index');
        }

        session()->setFlashdata('msg', 'Lokasi berhasil ditambah.');
        return redirect()->to('/admin/manage-lokasi');
    }
    public function ubah($id)
    {
        $data = [
            'user' => $this->user,
            'title' => 'Ubah Data Lokasi',
            'data' => $this->lokasi->find($id),
            'validation' => $this->validation
        ];

        // cegah id yang tidak jelas
        if (empty($data['data'])) {
            // Data tidak ditemukan, lempar pesan kesalahan.
            echo 'Data tidak ditemukan'; // Atau gunakan die() atau header() untuk memberikan respons HTTP sesuai.
        }

        return view('admin/manage-lokasi/ubah_lokasi', $data);
    }

    public function ubah_lokasi()
    {
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama RT wajib diisi.'
                ]
            ],
            'nama_ketua_rt' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Ketua RT wajib diisi.'
                ]
            ],
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->to('/lokasi/ubah'. $this->request->getPost('id'))->withInput();
        }
        // if (!$this->validate($rules)) {
        //     return redirect()->to('/admin/manage-lokasi' . $this->request->getPost('id'))->withInput();
        // }

        $id = $this->request->getPost('id');

        $this->db->transBegin(); // Begin DB Transaction

        try {
            $this->lokasi->save([
                'id' => $id,
                'nama' => $this->request->getPost('nama'),
                'nama_ketua_rt' => $this->request->getPost('nama_ketua_rt'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            // karena upload file tetap mengembalikan string "" (kosong), jadi kita cek apakah file nya ada yg diupload
           
            $this->db->transCommit(); // Commit
        } catch (\Exception $e) {
            $this->db->transRollback(); // Rollback

            session()->setFlashdata('error-msg',  $e->getMessage());
            return redirect()->to('/admin/manage-lokasi');
        }

        session()->setFlashdata('msg', 'Lokasi berhasil diubah.');
        return redirect()->to('/admin/manage-lokasi');
    }
    public function delete($id)
    {
        $lokasi = new LokasiModel(); // Gantilah YourModel dengan model yang sesuai

        // Lakukan validasi apakah data dengan ID yang diberikan ada
        $data = $lokasi->find($id);

        if (!$data) {
            return redirect()->to('/admin/manage-lokasi')->with('error-msg', 'Data tidak ditemukan.'); // Redirect jika data tidak ditemukan
        }

        // Lakukan penghapusan data
        $lokasi->delete($data);

        return redirect()->to('/lokasi')->with('msg', 'Data berhasil dihapus.');
    }
    }
