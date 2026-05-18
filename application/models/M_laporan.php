<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {

    /*
    |--------------------------------------------------------------------------
    | LAPORAN PENDAPATAN
    |--------------------------------------------------------------------------
    */

    public function pendapatan(
        $tanggal_awal,
        $tanggal_akhir
    )
    {

        $this->db->where(
            'DATE(created_at) >=',
            $tanggal_awal
        );

        $this->db->where(
            'DATE(created_at) <=',
            $tanggal_akhir
        );

        $this->db->where(
            'status',
            'LUNAS'
        );

        return $this->db
            ->get('billing')
            ->result();
    }

    /*
    |--------------------------------------------------------------------------
    | TOTAL PENDAPATAN
    |--------------------------------------------------------------------------
    */

    public function total_pendapatan(
        $tanggal_awal,
        $tanggal_akhir
    )
    {

        $this->db->select_sum(
            'total_bayar'
        );

        $this->db->where(
            'DATE(created_at) >=',
            $tanggal_awal
        );

        $this->db->where(
            'DATE(created_at) <=',
            $tanggal_akhir
        );

        $this->db->where(
            'status',
            'LUNAS'
        );

        $query = $this->db
            ->get('billing')
            ->row();

        return isset($query->total_bayar) ? $query->total_bayar : 0;
    }

    /*
    |--------------------------------------------------------------------------
    | LAPORAN DOKTER
    |--------------------------------------------------------------------------
    */

    public function jasa_dokter()
    {

        $this->db->select('
            jasa_dokter.*,

            dokter.nama_dokter
        ');

        $this->db->from(
            'jasa_dokter'
        );

        $this->db->join(
            'dokter',
            'dokter.id = jasa_dokter.dokter_id',
            'left'
        );

        return $this->db
            ->get()
            ->result();
    }

}
