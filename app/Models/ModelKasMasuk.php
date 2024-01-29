<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelkasmasuk extends Model
{
    public function getkasmasuk()
    {
        $builder = $this->db->table('tbl_kas_masjid')
            ->where('status="masuk"');
        return $builder->get();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_kas_masjid')->insert($data);
    }

    public function deletekasmasuk($id)
    {
        $query = $this->db->table('tbl_kas_masjid')->delete(array('tanggal' => $id));
        return $query;
    }

    public function updatekasmasuk($data, $id)
    {
        $query = $this->db->table('tbl_kas_masjid')->update($data, array('tanggal' => $id));
    }
    public function laporankasmasuk()
    {
        $builder = $this->db->table('tbl_kas_masjid');
        return $builder->get();
    }

    public function getLaporanperperiode($tgla, $tglb)
    {
        $b = $this->db->query("select * from tbl_kas_masjid where tanggal >='$tgla' and tanggal <='$tglb' and status='Masuk'");
        return $b;
    }

    public function getLaporanperperiodeperjeniskas($tgla, $tglb, $jenis)
    {
        $b = $this->db->query("select * from tbl_kas_masjid where tanggal >='$tgla' and tanggal <='$tglb' and jenis_kas='$jenis' and status='Masuk'");
        return $b;
    }
}
