<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    /*
    |--------------------------------------------------------------------------
    | TOTAL PASIEN HARI INI
    |--------------------------------------------------------------------------
    */

    public function pasien_hari_ini()
    {

        return $this->db
            ->where(
                'DATE(created_at)',
                date('Y-m-d')
            )
            ->count_all_results(
                'pendaftaran'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | ANTRIAN AKTIF
    |--------------------------------------------------------------------------
    */

    public function antrian_aktif()
    {

        return $this->db
            ->where_in(
                'status',
                ['menunggu','diperiksa']
            )
            ->count_all_results(
                'antrian'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | BILLING HARI INI
    |--------------------------------------------------------------------------
    */

    public function billing_hari_ini()
    {

        $this->db->select_sum(
            'total_bayar'
        );

        $this->db->where(
            'DATE(created_at)',
            date('Y-m-d')
        );

        $query = $this->db
            ->get('billing')
            ->row();

        return isset($query->total_bayar) ? $query->total_bayar : 0;
    }

    /*
    |--------------------------------------------------------------------------
    | TOTAL LUNAS
    |--------------------------------------------------------------------------
    */

    public function total_lunas()
    {

        return $this->db
            ->where(
                'status',
                'LUNAS'
            )
            ->count_all_results(
                'billing'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DOKTER AKTIF
    |--------------------------------------------------------------------------
    */

    public function dokter_aktif()
    {

        return $this->db
            ->count_all(
                'dokter'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | OBAT HAMPIR HABIS
    |--------------------------------------------------------------------------
    */

    public function obat_hampir_habis()
    {

        return $this->db
            ->where(
                'stok <=',
                10
            )
            ->order_by(
                'stok',
                'ASC'
            )
            ->get('obat')
            ->result();
    }

    /*
    |--------------------------------------------------------------------------
    | GRAFIK KUNJUNGAN
    |--------------------------------------------------------------------------
    */

    public function grafik_kunjungan()
    {

        $this->db->select("
            DATE(created_at) as created_at,
            COUNT(*) as total
        ");

        $this->db->from('pendaftaran');

        $this->db->group_by(
            'DATE(created_at)'
        );

        $this->db->order_by(
            'DATE(created_at)',
            'ASC'
        );

        return $this->db
            ->get()
            ->result();
    }

    /*
    |--------------------------------------------------------------------------
    | GRAFIK PENDAPATAN
    |--------------------------------------------------------------------------
    */

    public function grafik_pendapatan()
    {

        $this->db->select("
            DATE(created_at) as created_at,
            SUM(total_bayar) as total
        ");

        $this->db->from('billing');

        $this->db->where(
            'status',
            'LUNAS'
        );

        $this->db->group_by(
            'DATE(created_at)'
        );

        $this->db->order_by(
            'DATE(created_at)',
            'ASC'
        );

        return $this->db
            ->get()
            ->result();
    }

}
