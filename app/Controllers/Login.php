<?php


namespace App\Controllers;

use App\Models\ModelUser;


class Login extends BaseController
{
    public function index()
    {
        echo view('registrasi/login');
    }

    public function ceklogin()
    {
        $session = session();
        $model = new ModelUser();
        $username = $this->request->getPost('nama_user');
        $password = $this->request->getVar('password');
        $cek = $model->cek_login($username);
        if ($cek) {
            $pass = $cek['password'];
            $verify_pass = password_verify($password, $pass);
            if ($pass == $verify_pass) {
                session()->set('nama_user', $cek['nama_user']);
                session()->set('level', $cek['level']);
                return redirect()->to('/layout');
            } else {
                $session->setFlashdata('msg', 'Password Salah');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Username Tidak Ditemukan');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
