<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();
       
        $this->load->model('M_kasir');
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX BILLING
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['billing'] =
        $this->M_kasir->get_all();

        $this->load->view(
            'kasir/index',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH BILLING
    |--------------------------------------------------------------------------
    */

    public function tambah()
    {
        $data['pasien'] = $this->db
            ->get('pasien')
            ->result();

        if($this->input->post()){

            $simpan = [

                'kode_billing' =>

                'BILL'.date('YmdHis'),

                'pasien_id' =>
                $this->input->post('pasien_id'),

                'tanggal_billing' =>
                date('Y-m-d H:i:s'),

                'jenis_pembayaran' =>
                $this->input->post('jenis_pembayaran'),

                'subtotal' =>
                $this->input->post('subtotal'),

                'diskon' =>
                $this->input->post('diskon'),

                'total_bayar' =>
                $this->input->post('total_bayar'),

                'status' => 'BELUM_LUNAS',

                'created_at' =>
                date('Y-m-d H:i:s')
            ];

            $this->M_kasir->simpan(
                $simpan
            );

            $this->session->set_flashdata(
                'success',
                'Billing berhasil dibuat'
            );

            redirect('kasir');
        }

        $this->load->view(
            'kasir/tambah',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL BILLING
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {
        $data['detail'] =
        $this->M_kasir->detail($id);

        $this->load->view(
            'kasir/detail',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function bayar($id)
    {

        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS BILLING
        |--------------------------------------------------------------------------
        */

        $update = [

            'status' => 'LUNAS'
        ];

        $this->db->where(
            'id',
            $id
        );

        $this->db->update(
            'billing',
            $update
        );

        /*
        |--------------------------------------------------------------------------
        | AMBIL BILLING
        |--------------------------------------------------------------------------
        */

        $billing = $this->db

        ->get_where(
            'billing',
            ['id'=>$id]
        )

        ->row();

        /*
        |--------------------------------------------------------------------------
        | INSERT JURNAL
        |--------------------------------------------------------------------------
        */

        $jurnal = [

            'tanggal' =>
            date('Y-m-d H:i:s'),

            'keterangan' =>

            'Pembayaran Billing #'.$id
        ];

        $this->db->insert(
            'jurnal',
            $jurnal
        );

        $jurnal_id =
        $this->db->insert_id();

        /*
        |--------------------------------------------------------------------------
        | KAS MASUK
        |--------------------------------------------------------------------------
        */

        $this->db->insert(
            'jurnal_detail',
            [

                'jurnal_id' =>
                $jurnal_id,

                'coa_id' => 1,

                'debit' =>
                $billing->total_bayar,

                'kredit' => 0
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | PENDAPATAN
        |--------------------------------------------------------------------------
        */

        $this->db->insert(
            'jurnal_detail',
            [

                'jurnal_id' =>
                $jurnal_id,

                'coa_id' => 2,

                'debit' => 0,

                'kredit' =>
                $billing->total_bayar
            ]
        );

        $this->session->set_flashdata(
            'success',
            'Pembayaran berhasil'
        );

        redirect('kasir');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS BILLING
    |--------------------------------------------------------------------------
    */

    public function hapus($id)
    {
        $this->M_kasir->hapus($id);

        $this->session->set_flashdata(
            'success',
            'Billing berhasil dihapus'
        );

        redirect('kasir');
    }
}