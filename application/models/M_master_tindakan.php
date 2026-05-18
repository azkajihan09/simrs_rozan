<?php

class M_master_tindakan extends CI_Model {

    public function get_all()
    {
        return $this->db
            ->order_by('id','DESC')
            ->get('master_tindakan')
            ->result();
    }

    public function insert($data)
    {
        return $this->db->insert('master_tindakan',$data);
    }

    public function detail($id)
    {
        return $this->db
            ->where('id',$id)
            ->get('master_tindakan')
            ->row();
    }

    public function update($id,$data)
    {
        return $this->db
            ->where('id',$id)
            ->update('master_tindakan',$data);
    }

    public function delete($id)
    {
        return $this->db
            ->where('id',$id)
            ->delete('master_tindakan');
    }
}