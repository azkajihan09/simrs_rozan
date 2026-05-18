<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_poliklinik extends CI_Model {

    /*
    |--------------------------------------------------------------------------
    | GET ALL
    |--------------------------------------------------------------------------
    */

    public function get_all()
    {
        $this->db->order_by(
            'id',
            'DESC'
        );

        return $this->db
            ->get('poliklinik')
            ->result();
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {
        return $this->db

        ->get_where(
            'poliklinik',
            ['id'=>$id]
        )

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
            'poliklinik',
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
            'poliklinik',
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
            'poliklinik'
        );
    }
}