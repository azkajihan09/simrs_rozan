<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        cek_login();

        $this->load->model('M_pendaftaran');
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['pendaftaran'] = $this->M_pendaftaran->get_all();

        $this->load->view('pendaftaran/index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH
    |--------------------------------------------------------------------------
    */

    public function tambah()
    {
        $data['pasien'] = $this->db
            ->order_by('nama_pasien', 'ASC')
            ->get('pasien')
            ->result();

        $data['poli'] = $this->db
            ->order_by('nama_poli', 'ASC')
            ->get('poliklinik')
            ->result();

        $data['dokter'] = $this->db
            ->order_by('nama_dokter', 'ASC')
            ->get('dokter')
            ->result();

        if ($this->input->post()) {

            $poli_id = $this->input->post('poli_id');

            $no_antrian = $this->M_pendaftaran
                ->generate_nomor_antrian($poli_id);

            $simpan = [

                'tanggal' => date('Y-m-d'),

                'pasien_id' => $this->input->post('pasien_id'),

                'dokter_id' => $this->input->post('dokter_id'),

                'poli_id' => $poli_id,

                'jenis_pasien' => $this->input->post('jenis_pasien'),

                'status' => 'MENUNGGU',

                'no_antrian' => $no_antrian

            ];

            $save = $this->M_pendaftaran->simpan($simpan);

            if ($save) {

                $this->session->set_flashdata(
                    'success',
                    'Pendaftaran berhasil'
                );
            } else {

                $this->session->set_flashdata(
                    'error',
                    'Pendaftaran gagal'
                );
            }

            redirect('pendaftaran');
        }

        $this->load->view('pendaftaran/tambah', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {

        $data['detail'] = $this->db

            ->select('

            pendaftaran.*,

            pasien.nama_pasien,
            pasien.no_rm,
            pasien.jenis_kelamin,
            pasien.telepon,
            pasien.alamat,

            dokter.nama_dokter,

            poliklinik.nama_poli

        ')

            ->from('pendaftaran')

            ->join(
                'pasien',
                'pasien.id_pasien = pendaftaran.pasien_id',
                'left'
            )

            ->join(
                'dokter',
                'dokter.id = pendaftaran.dokter_id',
                'left'
            )

            ->join(
                'poliklinik',
                'poliklinik.id = pendaftaran.poli_id',
                'left'
            )

            ->where(
                'pendaftaran.id',
                $id
            )

            ->get()

            ->row();

        $this->load->view(
            'pendaftaran/detail',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data['row'] = $this->M_pendaftaran->detail($id);

        $data['pasien'] = $this->db->get('pasien')->result();

        $data['poli'] = $this->db->get('poliklinik')->result();

        $data['dokter'] = $this->db
            ->order_by('nama_dokter', 'ASC')
            ->get('dokter')
            ->result();

        if ($this->input->post()) {

            $update = [

                'pasien_id' => $this->input->post('pasien_id'),

                'dokter_id' => $this->input->post('dokter_id'),

                'poli_id' => $this->input->post('poli_id'),

                'keluhan' => $this->input->post('keluhan'),

                'jenis_pasien' => $this->input->post('jenis_pasien')

            ];

            $this->M_pendaftaran->update($id, $update);

            $this->session->set_flashdata(
                'success',
                'Data berhasil diupdate'
            );

            redirect('pendaftaran');
        }

        $this->load->view('pendaftaran/edit', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS
    |--------------------------------------------------------------------------
    */

    public function hapus($id)
    {
        $this->M_pendaftaran->delete($id);

        $this->session->set_flashdata(
            'success',
            'Data berhasil dihapus'
        );

        redirect('pendaftaran');
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX DOKTER BERDASARKAN POLI
    |--------------------------------------------------------------------------
    */

    public function dokter_by_poli($poli_id)
    {

        $dokter = $this->db

            ->where('poli_id', $poli_id)

            ->order_by('nama_dokter', 'ASC')

            ->get('dokter')

            ->result_array();

        header('Content-Type: application/json');

        echo json_encode($dokter);
    }
}
