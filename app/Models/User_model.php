<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username', 'password', 'level', 'nama_lengkap'];

    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    public function insertUser($data)
    {
        return $this->insert($data);
    }

    public function updateUser($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->delete($id);
    }

    public function getAllUsers()
    {
        return $this->findAll();
    }
}
