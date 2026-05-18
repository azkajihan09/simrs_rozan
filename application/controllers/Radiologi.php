<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Radiologi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();
       

        $this->load->library('form_validation');
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['title'] = 'Data Radiologi';

        $data['radiologi'] = $this->db

        ->select('
            radiologi.*,
            pasien.no_rm,
            pasien.nama_pasien,
            dokter.nama_dokter
        ')

        ->from('radiologi')

        ->join(
            'pasien',
            'pasien.id=radiologi.pasien_id'
        )

        ->join(
            'dokter',
            'dokter.id=radiologi.dokter_id'
        )

        ->order_by(
            'radiologi.id',
            'DESC'
        )

        ->get()

        ->result();

        $this->load->view(
            'radiologi/index',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH PERMINTAAN RADIOLOGI
    |--------------------------------------------------------------------------
    */

    public function tambah()
    {
        $data['title'] = 'Tambah Radiologi';

        $data['rekammedis'] = $this->db

        ->select('
            rekam_medis.*,
            pasien.no_rm,
            pasien.nama_pasien,
            dokter.nama_dokter
        ')

        ->from('rekam_medis')

        ->join(
            'pasien',
            'pasien.id=rekam_medis.pasien_id'
        )

        ->join(
            'dokter',
            'dokter.id=rekam_medis.dokter_id'
        )

        ->order_by(
            'rekam_medis.id',
            'DESC'
        )

        ->get()

        ->result();

        $this->form_validation->set_rules(
            'jenis_pemeriksaan',
            'Jenis Pemeriksaan',
            'required'
        );

        if($this->form_validation->run() == FALSE){

            $this->load->view(
                'radiologi/tambah',
                $data
            );

        }else{

            $insert = [

                'rekam_medis_id' => $this->input->post(
                    'rekam_medis_id',
                    TRUE
                ),

                'pasien_id' => $this->input->post(
                    'pasien_id',
                    TRUE
                ),

                'dokter_id' => $this->input->post(
                    'dokter_id',
                    TRUE
                ),

                'jenis_pemeriksaan' => $this->input->post(
                    'jenis_pemeriksaan',
                    TRUE
                ),

                'hasil' => '',

                'status' => 'MENUNGGU',

                'tanggal' => date('Y-m-d H:i:s')
            ];

            $this->db->insert(
                'radiologi',
                $insert
            );

            $this->session->set_flashdata(

                'success',

                'Permintaan radiologi berhasil dibuat'
            );

            redirect('radiologi');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | INPUT HASIL RADIOLOGI
    |--------------------------------------------------------------------------
    */

    public function hasil($id)
    {
        $data['title'] = 'Input Hasil Radiologi';

        $data['detail'] = $this->db

        ->select('
            radiologi.*,
            pasien.nama_pasien,
            pasien.no_rm,
            dokter.nama_dokter
        ')

        ->from('radiologi')

        ->join(
            'pasien',
            'pasien.id=radiologi.pasien_id'
        )

        ->join(
            'dokter',
            'dokter.id=radiologi.dokter_id'
        )

        ->where(
            'radiologi.id',
            $id
        )

        ->get()

        ->row();

        if(!$data['detail']){

            show_404();
        }

        $this->form_validation->set_rules(
            'hasil',
            'Hasil',
            'required'
        );

        if($this->form_validation->run() == FALSE){

            $this->load->view(
                'radiologi/hasil',
                $data
            );

        }else{

            $config['upload_path'] =
            './uploads/radiologi/';

            $config['allowed_types'] =
            'jpg|jpeg|png|pdf';

            $config['max_size'] = 5000;

            $config['encrypt_name'] = TRUE;

            $this->load->library(
                'upload',
                $config
            );

            $file = $data['detail']->file_hasil;

            if($this->upload->do_upload('file_hasil')){

                $upload = $this->upload->data();

                $file = $upload['file_name'];
            }

            $update = [

                'hasil' => $this->input->post(
                    'hasil',
                    TRUE
                ),

                'file_hasil' => $file,

                'status' => 'SELESAI'
            ];

            $this->db->where('id',$id);

            $this->db->update(
                'radiologi',
                $update
            );

            $this->session->set_flashdata(

                'success',

                'Hasil radiologi berhasil disimpan'
            );

            redirect('radiologi');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL RADIOLOGI
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {
        $data['detail'] = $this->db

        ->select('
            radiologi.*,
            pasien.no_rm,
            pasien.nama_pasien,
            dokter.nama_dokter
        ')

        ->from('radiologi')

        ->join(
            'pasien',
            'pasien.id=radiologi.pasien_id'
        )

        ->join(
            'dokter',
            'dokter.id=radiologi.dokter_id'
        )

        ->where(
            'radiologi.id',
            $id
        )

        ->get()

        ->row();

        if(!$data['detail']){

            show_404();
        }

        $this->load->view(
            'radiologi/detail',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS RADIOLOGI
    |--------------------------------------------------------------------------
    */

    public function hapus($id)
    {
        $detail = $this->db

        ->get_where(
            'radiologi',
            ['id'=>$id]
        )

        ->row();

        if(!$detail){

            show_404();
        }

        if($detail->file_hasil != ''){

            @unlink(
                './uploads/radiologi/'.
                $detail->file_hasil
            );
        }

        $this->db->where('id',$id);

        $this->db->delete('radiologi');

        $this->session->set_flashdata(

            'success',

            'Data radiologi berhasil dihapus'
        );

        redirect('radiologi');
    }
}