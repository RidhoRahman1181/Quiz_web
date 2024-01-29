<?php


namespace App\Models;

use CodeIgniter\Model;

class ModelPelanggan extends Model
{
    public function getPelanggan()
    {
        $builder = $this->db->table('pelanggan');
        return $builder->get();
    }
    public function savepelanggan($data)
    {
        $query = $this->db->table('pelanggan')->insert($data);
        return $query;
    }

    public function deletepelanggan($id)
    {
        $query = $this->db->table('pelanggan')->delete(array('id_pelanggan' => $id));
        return $query;
    }
    public function updatepelanggan($data, $id)
    {
        $query = $this->db->table('pelanggan')->update($data, array('id_pelanggan' => $id));
        return $query;
    }
}
