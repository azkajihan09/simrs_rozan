<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelayanan extends CI_Model {

    /*
    |--------------------------------------------------------------------------
    | GET ALL
    |--------------------------------------------------------------------------
    */

    public function get_all()
    {
        $this->db->select('
            antrian.*,
            pasien.nama_pasien,
            pasien.no_rm,
            pasien.telepon,
            dokter.nama_dokter,
            poliklinik.nama_poli
        ');

        $this->db->from('antrian');

        $this->db->join(
            'pasien',
            'pasien.id=antrian.pasien_id'
        );

        $this->db->join(
            'dokter',
            'dokter.id=antrian.dokter_id'
        );

        $this->db->join(
            'poliklinik',
            'poliklinik.id=antrian.poliklinik_id'
        );

        $this->db->order_by(
            'antrian.id',
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
            antrian.*,
            pasien.nama_pasien,
            dokter.nama_dokter,
            poliklinik.nama_poli
        ');

        $this->db->from('antrian');

        //$this->db->join(
          //  'pasien',
            //'pasien.id=antrian.pasien_id'
        //);
        $this->db->join('pasien', 'pasien.id_pasien = antrian.pasien_id', 'left');

        //$this->db->join(
            //'dokter',
          //  'dokter.id=antrian.dokter_id'
        //);
        $this->db->join('dokter', 'dokter.id_dokter = antrian.dokter_id', 'left');

 //       $this->db->join(
   //         'poliklinik',
     //       'poliklinik.id=antrian.poliklinik_id'
       // );
       $this->db->join('poliklinik', 'poliklinik.id_poli = antrian.poli_id', 'left');

        $this->db->where(
            'antrian.id',
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
        return $this->db
        ->insert(
            'antrian',
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

        return $this->db
        ->update(
            'antrian',
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

        return $this->db
        ->delete('antrian');
    }
}