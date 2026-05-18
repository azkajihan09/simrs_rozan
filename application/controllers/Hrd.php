<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hrd extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();
    }

    /*
    |--------------------------------------------------------------------------
    | DATA PEGAWAI
    |--------------------------------------------------------------------------
    */

    public function pegawai()
    {
        $data['pegawai'] = $this->db

        ->order_by('id','DESC')

        ->get('pegawai')

        ->result();

        $this->load->view(
            'hrd/pegawai',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH PEGAWAI
    |--------------------------------------------------------------------------
    */

    public function tambah_pegawai()
    {
        if($this->input->post()){

            $insert = [

                'nik' => $this->input->post('nik'),

                'nama_pegawai' =>
                $this->input->post('nama_pegawai'),

                'jabatan' =>
                $this->input->post('jabatan'),

                'jenis_pegawai' =>
                $this->input->post('jenis_pegawai'),

                'telepon' =>
                $this->input->post('telepon'),

                'alamat' =>
                $this->input->post('alamat'),

                'gaji_pokok' =>
                $this->input->post('gaji_pokok')
            ];

            $this->db->insert(
                'pegawai',
                $insert
            );

            redirect('hrd/pegawai');
        }

        $this->load->view(
            'hrd/tambah_pegawai'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PAYROLL
    |--------------------------------------------------------------------------
    */

    public function payroll()
    {
        $data['payroll'] = $this->db

        ->select('
            payroll.*,
            pegawai.nama_pegawai,
            pegawai.jabatan
        ')

        ->from('payroll')

        ->join(
            'pegawai',
            'pegawai.id=payroll.pegawai_id'
        )

        ->order_by(
            'payroll.id',
            'DESC'
        )

        ->get()

        ->result();

        $this->load->view(
            'hrd/payroll',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | GENERATE PAYROLL
    |--------------------------------------------------------------------------
    */

    public function generate_payroll()
    {
        $pegawai = $this->db
            ->get('pegawai')
            ->result();

        foreach($pegawai as $p){

            /*
            |--------------------------------------------------------------------------
            | HITUNG INSENTIF DOKTER
            |--------------------------------------------------------------------------
            */

            $insentif = 0;

            if($p->jenis_pegawai == 'DOKTER'){

                $jumlah_pasien = $this->db

                ->where(
                    'dokter_id',
                    $p->id
                )

                ->from('rekam_medis')

                ->count_all_results();

                $insentif =
                $jumlah_pasien * 10000;
            }

            /*
            |--------------------------------------------------------------------------
            | TOTAL GAJI
            |--------------------------------------------------------------------------
            */

            $bonus = 0;

            $potongan = 0;

            $total =

            $p->gaji_pokok +

            $insentif +

            $bonus -

            $potongan;

            /*
            |--------------------------------------------------------------------------
            | INSERT PAYROLL
            |--------------------------------------------------------------------------
            */

            $insert = [

                'pegawai_id' => $p->id,

                'bulan' => date('F'),

                'tahun' => date('Y'),

                'gaji_pokok' =>
                $p->gaji_pokok,

                'insentif' =>
                $insentif,

                'bonus' =>
                $bonus,

                'potongan' =>
                $potongan,

                'total_gaji' =>
                $total
            ];

            $this->db->insert(
                'payroll',
                $insert
            );
        }

        redirect('hrd/payroll');
    }

    /*
    |--------------------------------------------------------------------------
    | SLIP GAJI
    |--------------------------------------------------------------------------
    */

    public function slip($id)
    {
        $this->load->library('pdf');

        $data['detail'] = $this->db

        ->select('
            payroll.*,
            pegawai.nama_pegawai,
            pegawai.jabatan
        ')

        ->from('payroll')

        ->join(
            'pegawai',
            'pegawai.id=payroll.pegawai_id'
        )

        ->where(
            'payroll.id',
            $id
        )

        ->get()

        ->row();

        $html = $this->load->view(
            'hrd/slip_pdf',
            $data,
            TRUE
        );

        $this->pdf->generate(

            $html,

            'slip-gaji-'.$id
        );
    }
}