<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();

        $this->load->model('M_billing');
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {

        $data['title'] = 'Billing Pasien';

        $data['billing'] = $this->db

            ->select('

                billing.*,

                pasien.nama_pasien,
                pasien.no_rm,

                dokter.nama_dokter

            ')

            ->from('billing')

            ->join(
                'pasien',
                'pasien.id_pasien = billing.pasien_id',
                'left'
            )

            ->join(
                'rekam_medis',
                'rekam_medis.id = billing.rekam_medis_id',
                'left'
            )

            ->join(
                'dokter',
                'dokter.id = rekam_medis.dokter_id',
                'left'
            )

            ->order_by('billing.id','DESC')

            ->get()

            ->result();

        $this->load->view(
            'billing/index',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL BILLING
    |--------------------------------------------------------------------------
    */

    public function pasien($id)
    {

        $data['billing'] = $this->db

            ->select('

                billing.*,

                pasien.nama_pasien,
                pasien.no_rm,
                pasien.telepon,
                pasien.alamat,

                dokter.nama_dokter,

                poliklinik.nama_poli

            ')

            ->from('billing')

            ->join(
                'pasien',
                'pasien.id_pasien = billing.pasien_id',
                'left'
            )

            ->join(
                'rekam_medis',
                'rekam_medis.id = billing.rekam_medis_id',
                'left'
            )

            ->join(
                'dokter',
                'dokter.id = rekam_medis.dokter_id',
                'left'
            )

            ->join(
                'poliklinik',
                'poliklinik.id = rekam_medis.poli_id',
                'left'
            )

            ->where(
                'billing.id',
                $id
            )

            ->get()

            ->row();

        /*
        |--------------------------------------------------------------------------
        | DETAIL ITEM
        |--------------------------------------------------------------------------
        */

        $data['detail'] = $this->db

            ->where(
                'billing_id',
                $id
            )

            ->get('billing_detail')

            ->result();

        /*
        |--------------------------------------------------------------------------
        | BAYAR
        |--------------------------------------------------------------------------
        */

        if($this->input->post()){

            $bayar =
                $this->input->post('bayar');

            $kembalian =
                $bayar -
                $data['billing']->total_bayar;

            $update = [

                'dibayar' =>
                    $bayar,

                'kembalian' =>
                    $kembalian,

                'status' =>
                    'LUNAS',

                'tanggal_bayar' =>
                    date('Y-m-d H:i:s')

            ];

            $this->db
                ->where('id',$id)
                ->update(
                    'billing',
                    $update
                );

            $this->session->set_flashdata(
                'success',
                'Pembayaran berhasil'
            );

            redirect('billing/pasien/'.$id);

        }

        $this->load->view(
            'billing/detail',
            $data
        );
    }

}