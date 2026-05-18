<?php

class M_farmasi extends CI_Model {

    public function get_all()
    {
        return $this->db

        ->order_by('id','DESC')

        ->get('obat')

        ->result();
    }

    public function simpan($data)
    {
        return $this->db->insert(
            'obat',
            $data
        );
    }

    public function detail($id)
    {
        return $this->db

        ->get_where(
            'obat',
            ['id'=>$id]
        )

        ->row();
    }

    public function update($id,$data)
    {
        $this->db->where('id',$id);

        return $this->db->update(
            'obat',
            $data
        );
    }

    public function delete($id)
    {
        $this->db->where('id',$id);

        return $this->db->delete('obat');
    }
}