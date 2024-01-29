<?php


namespace App\Controllers;

use App\Models\ModelPelanggan;
use CodeIgniter\Model;

class pelanggan extends BaseController
{
    public function index()
    {
        $model = new ModelPelanggan();
        $data['pelanggan'] = $model->getpelanggan()->getResultArray();
        echo view('pelanggan/vpelanggan', $data);
    }
    public function save()
    {
        $model = new ModelPelanggan();
        $data = array(
            'idpel' => $this->request->getPost('idpel'),
            'nama' => $this->request->getPost('nama'),
            'nohp' => $this->request->getPost('nohp'),
            'alamat' => $this->request->getPost('alamat'),

        );
        if (!$this->validate([
            'id_pelanggan' => [
                'rules' => 'required|is_unique[tbl_pelanggan.id_pelanggan]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'is_unique' => '{field} Sudah Ada'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            print_r($this->request->getVar());
        }
        $model->savepelanggan($data);
        return redirect()->to('/pelanggan');
    }
    public function delete()
    {
        $model = new ModelPelanggan();
        $id = $this->request->getPost('id');
        $model->deletepelanggan($id);
        return redirect()->to('/pelanggan/index');
    }

    public function update()
    {
        $model = new Modelpelanggan();
        $id = $this->request->getPost('id');
        $data = array(
            'nama_pelanggan' => $this->request->getPost('nama'),
            'nohp' => $this->request->getPost('nohp'),
            'alamat' => $this->request->getPost('al'),

        );
        $model->updatepelanggan($data, $id);
        return redirect()->to('/pelanggan/index');
    }
}
