<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_rekam_medis extends CI_Model {

    private $table = 'rekam_medis';

    /*
    |--------------------------------------------------------------------------
    | GET ALL
    |--------------------------------------------------------------------------
    */

    public function get_all()
    {

        $this->db->select('
            rekam_medis.*,

            pasien.no_rm,
            pasien.nama_pasien,

            dokter.nama_dokter
        ');

        /*
        |--------------------------------------------------------------------------
        | JIKA FIELD POLI ADA
        |--------------------------------------------------------------------------
        */

        if(
            $this->db->field_exists(
                'poli_id',
                'rekam_medis'
            )
        ){

            $this->db->select(
                'poliklinik.nama_poli'
            );
        }

        $this->db->from($this->table);

        /*
        |--------------------------------------------------------------------------
        | JOIN PASIEN
        |--------------------------------------------------------------------------
        */

        $this->db->join(
            'pasien',
            'pasien.id_pasien = rekam_medis.pasien_id',
            'left'
        );

        /*
        |--------------------------------------------------------------------------
        | JOIN DOKTER
        |--------------------------------------------------------------------------
        */

        $this->db->join(
            'dokter',
            'dokter.id = rekam_medis.dokter_id',
            'left'
        );

        /*
        |--------------------------------------------------------------------------
        | JOIN POLIKLINIK
        |--------------------------------------------------------------------------
        */

        if(
            $this->db->field_exists(
                'poli_id',
                'rekam_medis'
            )
        ){

            $this->db->join(
                'poliklinik',
                'poliklinik.id = rekam_medis.poli_id',
                'left'
            );
        }

        $this->db->order_by(
            'rekam_medis.id',
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
            rekam_medis.*,

            pasien.no_rm,
            pasien.nama_pasien,
            pasien.jenis_kelamin,
            pasien.tanggal_lahir,
            pasien.alamat,
            pasien.telepon,

            dokter.nama_dokter
        ');

        if(
            $this->db->field_exists(
                'poli_id',
                'rekam_medis'
            )
        ){

            $this->db->select(
                'poliklinik.nama_poli'
            );
        }

        $this->db->from($this->table);

        $this->db->join(
            'pasien',
            'pasien.id_pasien = rekam_medis.pasien_id',
            'left'
        );

        $this->db->join(
            'dokter',
            'dokter.id = rekam_medis.dokter_id',
            'left'
        );

        if(
            $this->db->field_exists(
                'poli_id',
                'rekam_medis'
            )
        ){

            $this->db->join(
                'poliklinik',
                'poliklinik.id = rekam_medis.poli_id',
                'left'
            );
        }

        $this->db->where(
            'rekam_medis.id',
            $id
        );

        return $this->db
            ->get()
            ->row();
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update($id, $data)
    {

        $this->db->where(
            'id',
            $id
        );

        return $this->db->update(
            $this->table,
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
            $this->table
        );
    }

}