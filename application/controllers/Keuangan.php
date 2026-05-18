<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();
        
    }

    /*
    |--------------------------------------------------------------------------
    | JURNAL UMUM
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['jurnal'] = $this->db

        ->order_by('id','DESC')

        ->get('jurnal')

        ->result();

        $this->load->view(
            'keuangan/index',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL JURNAL
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {
        $data['jurnal'] = $this->db

        ->get_where(
            'jurnal',
            ['id'=>$id]
        )

        ->row();

        $data['detail'] = $this->db

        ->select('
            jurnal_detail.*,
            coa.kode_akun,
            coa.nama_akun
        ')

        ->from('jurnal_detail')

        ->join(
            'coa',
            'coa.id=jurnal_detail.coa_id'
        )

        ->where(
            'jurnal_detail.jurnal_id',
            $id
        )

        ->get()

        ->result();

        $this->load->view(
            'keuangan/detail',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CASHFLOW
    |--------------------------------------------------------------------------
    */

    public function cashflow()
    {
        $data['pemasukan'] = $this->db

        ->select_sum('debit')

        ->from('jurnal_detail')

        ->join(
            'coa',
            'coa.id=jurnal_detail.coa_id'
        )

        ->where(
            'coa.tipe',
            'PENDAPATAN'
        )

        ->get()

        ->row();

        $data['pengeluaran'] = $this->db

        ->select_sum('kredit')

        ->from('jurnal_detail')

        ->join(
            'coa',
            'coa.id=jurnal_detail.coa_id'
        )

        ->where(
            'coa.tipe',
            'BEBAN'
        )

        ->get()

        ->row();

        $this->load->view(
            'keuangan/cashflow',
            $data
        );
    }
}