<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_resep extends CI_Model {

    private $table = 'resep';

    /*
    |--------------------------------------------------------------------------
    | GET ALL
    |--------------------------------------------------------------------------
    */

    public function get_all()
    {

        $this->db->select('
            resep.*,

            pasien.nama_pasien,
            pasien.no_rm,

            dokter.nama_dokter
        ');

        $this->db->from($this->table);

        /*
        |--------------------------------------------------------------------------
        | JOIN PASIEN
        |--------------------------------------------------------------------------
        */

        $this->db->join(
            'pasien',
            'pasien.id_pasien = resep.pasien_id',
            'left'
        );

        /*
        |--------------------------------------------------------------------------
        | JOIN DOKTER
        |--------------------------------------------------------------------------
        */

        $this->db->join(
            'dokter',
            'dokter.id = resep.dokter_id',
            'left'
        );

        $this->db->order_by(
            'resep.id',
            'DESC'
        );

        return $this->db
            ->get()
            ->result();
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL RESEP
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {

        $this->db->select('
            resep.*,

            pasien.nama_pasien,
            pasien.no_rm,
            pasien.jenis_kelamin,
            pasien.tanggal_lahir,

            dokter.nama_dokter
        ');

        $this->db->from($this->table);

        $this->db->join(
            'pasien',
            'pasien.id_pasien = resep.pasien_id',
            'left'
        );

        $this->db->join(
            'dokter',
            'dokter.id = resep.dokter_id',
            'left'
        );

        $this->db->where(
            'resep.id',
            $id
        );

        return $this->db
            ->get()
            ->row();
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL OBAT RESEP
    |--------------------------------------------------------------------------
    */

    public function detail_obat($resep_id)
    {

        $this->db->select('
            resep_detail.*,

            obat.nama_obat,
            obat.satuan
        ');

        $this->db->from('resep_detail');

        $this->db->join(
            'obat',
            'obat.id = resep_detail.obat_id',
            'left'
        );

        $this->db->where(
            'resep_detail.resep_id',
            $resep_id
        );

        return $this->db
            ->get()
            ->result();
    }

    /*
    |--------------------------------------------------------------------------
    | GET BY REKAM MEDIS
    |--------------------------------------------------------------------------
    */

    public function get_by_rekam_medis(
        $rekam_medis_id
    )
    {

        return $this->db
            ->where(
                'rekam_medis_id',
                $rekam_medis_id
            )
            ->get($this->table)
            ->result();
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS
    |--------------------------------------------------------------------------
    */

    public function update_status(
        $id,
        $status
    )
    {

        $this->db->where(
            'id',
            $id
        );

        return $this->db->update(
            $this->table,
            [

                'status' => $status

            ]
        );
    }

}