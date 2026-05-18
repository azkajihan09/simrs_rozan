<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelayanan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
cek_login();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');

        // Optional login check
        // cek_login();
    }

    public function index()
    {

        /*
        |--------------------------------------------------------------------------
        | PASIEN POLI
        |--------------------------------------------------------------------------
        */

        $data['pasien_poli'] =

        $this->db
        ->select('
            antrian.*,
            pasien.nama_pasien,
            pasien.no_rm,
            pasien.telepon,
            dokter.nama_dokter,
            poliklinik.nama_poli
        ')
        ->from('antrian')

        ->join(
            'pasien',
            'pasien.id_pasien = antrian.pasien_id',
            'left'
        )

        ->join(
            'dokter',
            'dokter.id = antrian.dokter_id',
            'left'
        )

        ->join(
            'poliklinik',
            'poliklinik.id = antrian.poli_id',
            'left'
        )

        ->where('antrian.jenis_layanan', 'POLI')

        ->order_by('antrian.id', 'DESC')

        ->get()

        ->result();

        /*
        |--------------------------------------------------------------------------
        | PASIEN IGD
        |--------------------------------------------------------------------------
        */

        $data['pasien_igd'] =

        $this->db
        ->select('
            antrian.*,
            pasien.nama_pasien,
            pasien.no_rm,
            pasien.telepon,
            dokter.nama_dokter
        ')
        ->from('antrian')

        ->join(
            'pasien',
            'pasien.id_pasien = antrian.pasien_id',
            'left'
        )

        ->join(
            'dokter',
            'dokter.id = antrian.dokter_id',
            'left'
        )

        ->where('antrian.jenis_layanan', 'IGD')

        ->order_by('antrian.id', 'DESC')

        ->get()

        ->result();

        /*
        |--------------------------------------------------------------------------
        | RUJUKAN INTERNAL
        |--------------------------------------------------------------------------
        */

        $data['rujukan_internal'] =

        $this->db
        ->select('
            rujukan_internal.*,
            pasien.nama_pasien,
            dokter.nama_dokter
        ')
        ->from('rujukan_internal')

        ->join(
            'pasien',
            'pasien.id_pasien = rujukan_internal.pasien_id',
            'left'
        )

        ->join(
            'dokter',
            'dokter.id = rujukan_internal.dokter_id',
            'left'
        )

        ->order_by(
            'rujukan_internal.id',
            'DESC'
        )

        ->get()

        ->result();

        /*
        |--------------------------------------------------------------------------
        | TITLE
        |--------------------------------------------------------------------------
        */

        $data['title'] = 'Pelayanan Klinik';

        /*
        |--------------------------------------------------------------------------
        | LOAD VIEW
        |--------------------------------------------------------------------------
        */

        $this->load->view(
            'pelayanan/index',
            $data
        );
    }

}