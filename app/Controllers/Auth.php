<?php

namespace App\Controllers;

use App\Models\User_model;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->userModel = new User_model();
        $this->session = session();
        $this->validation = \Config\Services::validation();
    }

    public function login()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        $data = [
            'title' => 'Login',
            'navbar' => 'Dashboard'
        ];
        return view('auth/login', $data);
    }

    public function proses_login()
    {
        $validationRules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/login')->withInput();
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel->getUserByUsername($username);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'id_user' => $user['id_user'],
                    'username' => $user['username'],
                    'level' => $user['level'],
                    'nama_lengkap' => $user['nama_lengkap'],
                    'isLoggedIn' => true
                ];
                $this->session->set($sessionData);
                return redirect()->to('/dashboard');
            } else {
                $this->session->setFlashdata('error', 'Password salah!');
                return redirect()->to('/login')->withInput();
            }
        } else {
            $this->session->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect()->to('/login')->withInput();
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }

    public function dashboard()
    {
        // Proteksi halaman dilakukan secara manual
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        $data = [
            'title' => 'Dashboard',
            'navbar' => 'Dashboard',
            'user' => $this->session->get()
        ];
        return view('auth/dashboard', $data);
    }

    // Contoh method lain yang perlu proteksi
    public function halaman_rahasia()
    {
        // Proteksi halaman dilakukan secara manual
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        $data = ['title' => 'Halaman Rahasia'];
        return view('rahasia', $data);
    }
}
