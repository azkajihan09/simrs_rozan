
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengaturan extends CI_Model {

    private $table = 'settings';

    public function get_all()
    {
        return $this->db
        ->order_by('id','DESC')
        ->get($this->table)
        ->result();
    }

    public function detail($id)
    {
        return $this->db
        ->where('id',$id)
        ->get($this->table)
        ->row();
    }

    public function simpan($data)
    {
        return $this->db
        ->insert(
            $this->table,
            $data
        );
    }

    public function update($id,$data)
    {
        $this->db->where(
            'id',
            $id
        );

        return $this->db
        ->update(
            $this->table,
            $data
        );
    }

    public function hapus($id)
    {
        return $this->db
        ->where('id',$id)
        ->delete($this->table);
    }
}