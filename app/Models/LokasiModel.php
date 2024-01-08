<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiModel extends Model
{
    // public function AllLokasi()
    // {
    //     return $this->db->table('tbl_lokasi')
    //     ->Get()->GetResultArray();
    // }

    protected $table = 'tbl_lokasi';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','nama','nama_ketua_rt', 'created_at', 'updated_at', 'deleted_at', 'row_status'];

    public function getLokasi()
    {
        return $this->findAll();
    }

    public function soft_delete($id)
    {
        $builder = $this->table('tbl_lokasi');
        $builder->set('row_status', 0);
        $builder->set('deleted_at', date('Y-m-d H:i:s'));
        $builder->update();
    }
    
}
