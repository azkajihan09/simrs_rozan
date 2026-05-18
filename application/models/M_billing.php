<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_billing extends CI_Model {

    /*
    |--------------------------------------------------------------------------
    | GET ALL
    |--------------------------------------------------------------------------
    */

    public function get_all()
    {

        $this->db->select('
            billing.*,

            pasien.nama_pasien,
            pasien.no_rm
        ');

        $this->db->from('billing');

        $this->db->join(
            'pasien',
            'pasien.id_pasien = billing.pasien_id',
            'left'
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

    public function detail($billing_id)
    {

        $this->db->select('
            billing.*,

            pasien.nama_pasien,
            pasien.no_rm,
            pasien.alamat,
            pasien.telepon
        ');

        $this->db->from('billing');

        $this->db->join(
            'pasien',
            'pasien.id_pasien = billing.pasien_id',
            'left'
        );

        $this->db->where(
            'billing.id',
            $billing_id
        );

        return $this->db
            ->get()
            ->row();
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL ITEM
    |--------------------------------------------------------------------------
    */

    public function detail_item($billing_id)
    {

        if(
            !$this->db->table_exists(
                'billing_detail'
            )
        ){

            return [];
        }

        return $this->db
            ->where(
                'billing_id',
                $billing_id
            )
            ->get('billing_detail')
            ->result();
    }

}