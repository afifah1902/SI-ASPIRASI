<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_user';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'username', 'email', 'password','lokasi_user','user_level', 'user_ktp', 'user_image', 'updated_at'];

    public function getUserLogin($id)
    {
        $this->select('id, nama, username, password, email, lokasi_user, password, user_image, user_level');
        return $this->getWhere(['id' => $id])->getRowArray();
    }

    public function saveUserProfile($userdata, $namaFile)
    {
        $this->transBegin();

        try {
            if ($namaFile == FALSE) {
                $this->set('nama', $userdata['nama']);
                $this->set('username', $userdata['username']);
                $this->set('email', $userdata['email']);
                $this->set('user_level', $userdata['user_level']);
                $this->where('id', $userdata['id']);
                $this->update();
            } else {
                $this->set('nama', $userdata['nama']);
                $this->set('username', $userdata['username']);
                $this->set('email', $userdata['email']);
                $this->set('user_level', $userdata['user_level']);
                $this->set('user_image', $namaFile);
                $this->where('id', $userdata['id']);
                $this->update();
            }

            $data = [
                'status' => TRUE,
                'msg' => 'Profile berhasil diperbarui.',
            ];
            echo json_encode($data);

            $this->transCommit();
        } catch (\Exception $e) {
            $this->transRollback();

            http_response_code(400);
        }
    }
}
