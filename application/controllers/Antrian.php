<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Antrian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        cek_login();

        $this->load->model('M_antrian');
    }

    public function index()
    {
        $data['antrian'] = $this->M_antrian->get_all();

        $this->load->view('antrian/index', $data);
    }

    public function tambah()
    {
        $nomor = $this->M_antrian->nomor_antrian();

        $data = [

            'kode_antrian' => 'A' . $nomor,

            'pasien_id' => $this->input->post('pasien_id'),

            'dokter_id' => $this->input->post('dokter_id'),

            'tanggal' => date('Y-m-d'),

            'nomor_antrian' => $nomor,

            'status' => 'MENUNGGU'
        ];

        $this->M_antrian->simpan($data);

        redirect('antrian');
    }

    public function panggil($id)
    {
        $this->db->where('id', $id);

        $this->db->update('antrian', [

            'status' => 'DIPANGGIL',

            'waktu_panggil' => date('Y-m-d H:i:s')
        ]);

        redirect('antrian');
    }

    public function selesai($id)
    {
        $this->db->where('id', $id);

        $this->db->update('antrian', [

            'status' => 'SELESAI'
        ]);

        redirect('antrian');
    }

    public function batal($id)
    {
        $this->db->where('id', $id);

        $this->db->update('antrian', [

            'status' => 'BATAL'
        ]);

        redirect('antrian');
    }
    public function cetak($id)
    {
        $data['antrian'] = $this->M_antrian->detail($id);

        $this->load->view(
            'antrian/cetak',
            $data
        );
    }
}
