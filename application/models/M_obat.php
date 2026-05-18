<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_obat extends CI_Model {

    public function get_all()
    {
        return $this->db
        ->order_by('id','DESC')
        ->get('obat')
        ->result();
    }

    public function detail($id)
    {
        return $this->db
        ->get_where('obat',['id'=>$id])
        ->row();
    }

    public function simpan($data)
    {
        return $this->db
        ->insert('obat',$data);
    }

    public function update($id,$data)
    {
        $this->db->where('id',$id);

        return $this->db
        ->update('obat',$data);
    }

    public function hapus($id)
    {
        $this->db->where('id',$id);

        return $this->db
        ->delete('obat');
    }

    public function stok_minimal()
    {
        $this->db->where(
            'stok <= stok_minimal'
        );

        return $this->db
        ->get('obat')
        ->result();
    }
}