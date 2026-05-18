<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resep extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {

        $data['resep'] = $this->db

        ->select('

            resep.*,

            pasien.nama_pasien,

            dokter.nama_dokter

        ')

        ->from('resep')

        ->join(
            'rekam_medis',
            'rekam_medis.id = resep.rekam_medis_id',
            'left'
        )

        ->join(
            'pasien',
            'pasien.id_pasien = rekam_medis.pasien_id',
            'left'
        )

        ->join(
            'dokter',
            'dokter.id = rekam_medis.dokter_id',
            'left'
        )

        ->order_by('resep.id','DESC')

        ->get()

        ->result();

        $this->load->view(
            'resep/index',
            $data
        );

    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH RESEP
    |--------------------------------------------------------------------------
    */

    public function tambah($rekam_medis_id)
    {

        $data['rm'] = $this->db

        ->select('

            rekam_medis.*,

            pasien.nama_pasien,

            dokter.nama_dokter

        ')

        ->from('rekam_medis')

        ->join(
            'pasien',
            'pasien.id_pasien = rekam_medis.pasien_id',
            'left'
        )

        ->join(
            'dokter',
            'dokter.id = rekam_medis.dokter_id',
            'left'
        )

        ->where(
            'rekam_medis.id',
            $rekam_medis_id
        )

        ->get()

        ->row();

        $data['obat'] = $this->db

        ->order_by('nama_obat','ASC')

        ->get('obat')

        ->result();

        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        if($this->input->post()){

            $resep = [

                'rekam_medis_id' =>
                    $rekam_medis_id,

                'tanggal' =>
                    date('Y-m-d'),

                'catatan' =>
                    $this->input->post('catatan'),

                'created_at' =>
                    date('Y-m-d H:i:s')

            ];

            $this->db->insert(
                'resep',
                $resep
            );

            $resep_id =
                $this->db->insert_id();

            /*
            |--------------------------------------------------------------------------
            | DETAIL RESEP
            |--------------------------------------------------------------------------
            */

            $obat_id =
                $this->input->post('obat_id');

            $qty =
                $this->input->post('qty');

            $aturan =
                $this->input->post('aturan_pakai');

            foreach($obat_id as $key => $o){

                $obat = $this->db

                ->where('id_obat', $o)

                ->get('obat')

                ->row();

                $subtotal =
                    $obat->harga_jual *
                    $qty[$key];

                /*
                |--------------------------------------------------------------------------
                | RESEP DETAIL
                |--------------------------------------------------------------------------
                */

                $detail = [

                    'resep_id' =>
                        $resep_id,

                    'obat_id' =>
                        $o,

                    'qty' =>
                        $qty[$key],

                    'aturan_pakai' =>
                        $aturan[$key],

                    'harga' =>
                        $obat->harga_jual,

                    'subtotal' =>
                        $subtotal

                ];

                $this->db->insert(
                    'resep_detail',
                    $detail
                );

                /*
                |--------------------------------------------------------------------------
                | UPDATE STOK
                |--------------------------------------------------------------------------
                */

                $stok_baru =
                    $obat->stok -
                    $qty[$key];

                $this->db

                ->where('id_obat', $o)

                ->update('obat',[

                    'stok' => $stok_baru

                ]);

            }

            $this->session->set_flashdata(
                'success',
                'Resep berhasil dibuat'
            );

            redirect('resep');

        }

        $this->load->view(
            'resep/tambah',
            $data
        );

    }

}