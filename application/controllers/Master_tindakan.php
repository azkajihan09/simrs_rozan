<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_tindakan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();

        $this->load->model('M_master_tindakan');
    }

    public function index()
    {
        $data['tindakan'] = $this->M_master_tindakan->get_all();

        $this->load->view('master_tindakan/index',$data);
    }

    public function tambah()
    {
        if($this->input->post()){

            $simpan = [

                'kode_tindakan' => $this->input->post('kode_tindakan'),

                'nama_tindakan' => $this->input->post('nama_tindakan'),

                'tarif' => $this->input->post('tarif'),

                'jasa_dokter' => $this->input->post('jasa_dokter'),

                'keterangan' => $this->input->post('keterangan'),

                'status' => $this->input->post('status')

            ];

            $this->M_master_tindakan->insert($simpan);

            redirect('master_tindakan');
        }

        $this->load->view('master_tindakan/tambah');
    }

    public function edit($id)
    {
        $data['row'] = $this->M_master_tindakan->detail($id);

        if($this->input->post()){

            $update = [

                'kode_tindakan' => $this->input->post('kode_tindakan'),

                'nama_tindakan' => $this->input->post('nama_tindakan'),

                'tarif' => $this->input->post('tarif'),

                'jasa_dokter' => $this->input->post('jasa_dokter'),

                'keterangan' => $this->input->post('keterangan'),

                'status' => $this->input->post('status')

            ];

            $this->M_master_tindakan->update($id,$update);

            redirect('master_tindakan');
        }

        $this->load->view('master_tindakan/edit',$data);
    }

    public function hapus($id)
    {
        $this->M_master_tindakan->delete($id);

        redirect('master_tindakan');
    }
    public function detail($id)
{
    $data['row'] = $this->M_master_tindakan->detail($id);

    $this->load->view('master_tindakan/detail',$data);
}
}