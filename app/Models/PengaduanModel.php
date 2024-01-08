<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table = 'tbl_pengaduan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'user_id', 'nama_pengirim', 'judul_aspirasi', 'isi_aspirasi', 'lokasi','keterangan', 'created_at', 'updated_at', 'deleted_at', 'row_status', 'status_aspirasi'];

    public function hitungPengaduan($user_id)
    {
        $this->where('user_id', $user_id);
        return $this->countAllResults();
    }
    // Model Pengaduan


    
}
