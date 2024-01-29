<?php

namespace App\Controllers;

use App\Models\Modelkaskeluar;


class kaskeluar extends BaseController
{
    public function index()
    {
        $model = new Modelkaskeluar();
        $data['kaskeluar'] = $model->getkaskeluar()->getResultArray();
        echo view('kas/view_kaskeluar', $data);
    }
    public function save()
    {
        $model = new Modelkaskeluar();
        $data = array(

            'tanggal' => $this->request->getPost('tanggal'),
            'ket' => $this->request->getPost('ket'),
            'kas_keluar' => $this->request->getPost('kas_keluar'),
            'kas_masuk' => 0,
            'status' => 'Keluar',
            'jenis_kas' => $this->request->getPost('jenis_kas'),
        );



        $model->insertData($data);
        return redirect()->to('/kaskeluar');
    }
    public function delete()
    {
        $model = new Modelkaskeluar();
        $id = $this->request->getPost('id');
        $model->deletekaskeluar($id);
        return redirect()->to('/kaskeluar/index');
    }

    public function update()
    { {
            $model = new Modelkaskeluar();
            $id = $this->request->getPost('tanggal');
            $data = array(
                'tanggal' => $this->request->getPost('tanggal'),
                'ket' => $this->request->getPost('ket'),
                'kas_masuk' => $this->request->getPost('kas_masuk'),
                'jenis_kas' => $this->request->getPost('jenis_kas'),
            );
            $model->updatekaskeluar($data, $id);
            return redirect()->to('/kaskeluar/index');
        }
    }
    public function laporankaskeluar()
    {
        $model = new ModelKasKeluar();
        $data['data'] = $model->laporankaskeluar()->getResultArray();
        echo view('kas/cetak_laporan_keluar', $data);
    }

    public function laporanperperiode()
    {
        echo view('kas/vlaporankaskeluar');
    }
    public function cetaklaporanperperiode()
    {
        $model = new ModelKasKeluar();

        $tgla = $this->request->getPost('tanggal_awal');
        $tglb = $this->request->getPost('tanggal_akhir');
        $query = $model->getLaporanperperiode2($tgla, $tglb)->getResultArray();
        $data = [
            'tgla' => $tgla,
            'tglb' => $tglb,
            'data' => $query
        ];
        echo view('kas/vcetaklaporanperperiode2', $data);
    }

    public function laporanperperiodeperjenis()
    {
        echo view('kas/vlaporanperjeniskas2');
    }

    public function cetaklaporanperperiodeperjeniskas()
    {
        $model = new ModelKasKeluar();
        $tgla = $this->request->getPost('tanggal_awal');
        $tglb = $this->request->getPost('tanggal_akhir');
        $jenis = $this->request->getPost('jeniskas');
        $query = $model->getLaporanperperiodeperjeniskas($tgla, $tglb, $jenis)->getResultArray();
        $data = [
            'tgla' => $tgla,
            'tglb' => $tglb,
            'jenis' => $jenis,
            'data' => $query,
        ];
        echo view('kas/v_cetaklaporanperperiodeperjeniskas2', $data);
    }
}
