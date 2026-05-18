<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
   cek_login();

        $this->load->model('M_dokter');
    }

    public function index()
    {
        $data['dokter'] = $this->M_dokter->get_all();

        $this->load->view('dokter/index',$data);
    }

    public function tambah()
    {
        $data['poli'] = $this->db->get('poliklinik')->result();

        if($this->input->post()){

            $simpan = [

                'poli_id' => $this->input->post('poli_id'),

                'nama_dokter' => $this->input->post('nama_dokter'),

                'spesialis' => $this->input->post('spesialis'),

                'sip' => $this->input->post('sip'),

                'str_dokter' => $this->input->post('str_dokter'),

                'alamat' => $this->input->post('alamat'),

                'telepon' => $this->input->post('telepon'),

                'jadwal' => $this->input->post('jadwal')
            ];

            $this->M_dokter->simpan($simpan);

            redirect('dokter');
        }

        $this->load->view('dokter/tambah',$data);
    }

    public function edit($id)
    {
        $data['dokter'] = $this->M_dokter->detail($id);

        $data['poli'] = $this->db->get('poliklinik')->result();

        if($this->input->post()){

            $update = [

                'poli_id' => $this->input->post('poli_id'),

                'nama_dokter' => $this->input->post('nama_dokter'),

                'spesialis' => $this->input->post('spesialis'),

                'sip' => $this->input->post('sip'),

                'str_dokter' => $this->input->post('str_dokter'),

                'alamat' => $this->input->post('alamat'),

                'telepon' => $this->input->post('telepon'),

                'jadwal' => $this->input->post('jadwal')
            ];

            $this->M_dokter->update($id,$update);

            redirect('dokter');
        }

        $this->load->view('dokter/edit',$data);
    }

    public function hapus($id)
    {
        $this->M_dokter->delete($id);

        redirect('dokter');
    }
}