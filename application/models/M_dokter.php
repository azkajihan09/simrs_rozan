<?php

class M_dokter extends CI_Model {

    public function get_all()
    {
        return $this->db

        ->select('dokter.*, poliklinik.nama_poli')

        ->from('dokter')

        ->join(
            'poliklinik',
            'poliklinik.id=dokter.poli_id',
            'left'
        )

        ->order_by('dokter.id','DESC')

        ->get()

        ->result();
    }

    public function simpan($data)
    {
        return $this->db->insert('dokter',$data);
    }

    public function detail($id)
    {
        return $this->db

        ->get_where('dokter',['id'=>$id])

        ->row();
    }

    public function update($id,$data)
    {
        $this->db->where('id',$id);

        return $this->db->update('dokter',$data);
    }

    public function delete($id)
    {
        $this->db->where('id',$id);

        return $this->db->delete('dokter');
    }
}