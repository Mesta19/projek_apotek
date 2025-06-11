<?php

namespace App\Controllers;

use App\Models\User_model;

class User extends BaseController
{
    protected $userModel;
    protected $validation;

    public function __construct()
    {
        $this->userModel = new User_model();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar User',
            'navbar'=>'User',
            'users' => $this->userModel->getAllUsers()
        ];
        return view('user/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User',
            'navbar'=>'User',
            'validation' => $this->validation
        ];
        return view('user/create', $data);
    }

    public function save()
    {
        $validationRules = [
            'username' => 'required|is_unique[users.username]',
            'password' => 'required|min_length[5]',
            'level' => 'required',
            'nama_lengkap' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/user/create')->withInput();
        }

        $password = $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $hashedPassword,
            'level' => $this->request->getPost('level'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap')
        ];

        $this->userModel->insertUser($data);
        session()->setFlashdata('pesan', 'Data user berhasil ditambahkan.');
        return redirect()->to('/user');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit User',
            'user' => $this->userModel->find($id),
            'validation' => $this->validation
        ];
        return view('user/edit', $data);
    }

    public function update($id)
    {
        $validationRules = [
            'username' => 'required|is_unique[users.username,id_user,{id_user}]',
            'level' => 'required',
            'nama_lengkap' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/user/edit/' . $id)->withInput();
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'level' => $this->request->getPost('level'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap')
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $data['password'] = $hashedPassword;
        }

        $this->userModel->updateUser($id, $data);
        session()->setFlashdata('pesan', 'Data user berhasil diubah.');
        return redirect()->to('/user');
    }

    public function delete($id)
    {
        $this->userModel->deleteUser($id);
        session()->setFlashdata('pesan', 'Data user berhasil dihapus.');
        return redirect()->to('/user');
    }
}
