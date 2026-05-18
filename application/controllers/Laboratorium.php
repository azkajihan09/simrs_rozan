<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratorium extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();
    }

    public function index()
    {
        $data['lab'] = $this->db

        ->select('
            laboratorium.*,
            pasien.nama_pasien,
            dokter.nama_dokter
        ')

        ->from('laboratorium')

        ->join(
            'pasien',
            'pasien.id_pasien=laboratorium.pasien_id'
        )

        ->join(
            'dokter',
            'dokter.id=laboratorium.dokter_id'
        )

        ->order_by(
            'laboratorium.id',
            'DESC'
        )

        ->get()

        ->result();

        $this->load->view(
            'laboratorium/index',
            $data
        );
    }

    public function tambah()
    {
        $data['rekammedis'] = $this->db

        ->select('
            rekam_medis.*,
            pasien.nama_pasien
        ')

        ->from('rekam_medis')

        ->join(
            'pasien',
            'pasien.id_pasien=rekam_medis.pasien_id'
        )

        ->get()

        ->result();

        if($this->input->post()){

            $data_insert = [

                'rekam_medis_id' => $this->input->post('rekam_medis_id'),

                'pasien_id' => $this->input->post('pasien_id'),

                'dokter_id' => $this->input->post('dokter_id'),

                'jenis_pemeriksaan' => $this->input->post('jenis_pemeriksaan'),

                'hasil' => $this->input->post('hasil'),

                'tanggal' => date('Y-m-d H:i:s')
            ];

            $this->db->insert(
                'laboratorium',
                $data_insert
            );

            redirect('laboratorium');
        }

        $this->load->view(
            'laboratorium/tambah',
            $data
        );
    }

    public function hasil($id)
    {
        $data['detail'] = $this->db

        ->get_where(
            'laboratorium',
            ['id'=>$id]
        )

        ->row();

        if($this->input->post()){

            $config['upload_path'] = './uploads/lab/';

            $config['allowed_types'] =
            'jpg|jpeg|png|pdf';

            $config['max_size'] = 5000;

            $this->load->library(
                'upload',
                $config
            );

            $file = '';

            if($this->upload->do_upload('file_hasil')){

                $upload = $this->upload->data();

                $file = $upload['file_name'];
            }

            $update = [

                'hasil' => $this->input->post('hasil'),

                'file_hasil' => $file,

                'status' => 'SELESAI'
            ];

            $this->db->where('id',$id);

            $this->db->update(
                'laboratorium',
                $update
            );

            redirect('laboratorium');
        }

        $this->load->view(
            'laboratorium/hasil',
            $data
        );
    }
}
