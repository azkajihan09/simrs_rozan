<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kasir extends CI_Model {

    /*
    |--------------------------------------------------------------------------
    | GET ALL
    |--------------------------------------------------------------------------
    */

    public function get_all()
    {
        $this->db->select('
            billing.*,
            pasien.no_rm,
            pasien.nama_pasien
        ');

        $this->db->from('billing');

        $this->db->join(
            'pasien',
            'pasien.id=billing.pasien_id'
        );

        $this->db->order_by(
            'billing.id',
            'DESC'
        );

        return $this->db
            ->get()
            ->result();
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {
        $this->db->select('
            billing.*,
            pasien.no_rm,
            pasien.nama_pasien,
            pasien.telepon,
            pasien.alamat
        ');

        $this->db->from('billing');

        $this->db->join(
            'pasien',
            'pasien.id=billing.pasien_id'
        );

        $this->db->where(
            'billing.id',
            $id
        );

        return $this->db
            ->get()
            ->row();
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN
    |--------------------------------------------------------------------------
    */

    public function simpan($data)
    {
        return $this->db->insert(
            'billing',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update($id,$data)
    {
        $this->db->where(
            'id',
            $id
        );

        return $this->db->update(
            'billing',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS
    |--------------------------------------------------------------------------
    */

    public function hapus($id)
    {
        $this->db->where(
            'id',
            $id
        );

        return $this->db->delete(
            'billing'
        );
    }
}