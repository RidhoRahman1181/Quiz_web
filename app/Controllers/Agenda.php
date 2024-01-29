<?php


namespace App\Controllers;

use App\Models\ModelAgenda;
use CodeIgniter\Model;

class Agenda extends BaseController
{
    public function index()
    {
        $model = new ModelAgenda();
        $data['agenda'] = $model->getagenda()->getResultArray();
        echo view('Agenda/view_Agenda', $data);
    }
    public function save()
    {
        $model = new ModelAgenda();
        $data = array(
            'id_agenda' => $this->request->getPost('id_agenda'),
            'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam'),
        );
        if (!$this->validate([
            'id_agenda' => [
                'rules' => 'required|is_unique[tbl_agenda.id_agenda]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'is_unique' => '{field} ini sudah ada, silahkan anda inputkan data yang lain..!'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            print_r($this->request->getVar());
        }
        $model->saveagenda($data);
        return redirect()->to('/agenda');
    }
    public function delete()
    {
        $model = new ModelAgenda();
        $id = $this->request->getPost('id');
        $model->deleteagenda($id);
        return redirect()->to('/agenda/index');
    }

    public function update()
    {
        $model = new ModelAgenda();
        $id = $this->request->getPost('id');
        $data = array(
            'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam'),
        );
        $model->updateagenda($data, $id);
        return redirect()->to('/agenda/index');
    }
}
