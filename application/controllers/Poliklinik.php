<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poliklinik extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();
       

        $this->load->model('M_poliklinik');
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['poliklinik'] =
        $this->M_poliklinik->get_all();

        $this->load->view(
            'poliklinik/index',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH
    |--------------------------------------------------------------------------
    */

    public function tambah()
    {
        if($this->input->post()){

            $simpan = [

                'kode_poli' =>
                $this->input->post('kode_poli'),

                'nama_poli' =>
                $this->input->post('nama_poli'),

                'keterangan' =>
                $this->input->post('keterangan')
            ];

            $this->M_poliklinik->simpan(
                $simpan
            );

            $this->session->set_flashdata(
                'success',
                'Data poliklinik berhasil ditambah'
            );

            redirect('poliklinik');
        }

        $this->load->view(
            'poliklinik/tambah'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data['detail'] =
        $this->M_poliklinik->detail($id);

        if($this->input->post()){

            $update = [

                'kode_poli' =>
                $this->input->post('kode_poli'),

                'nama_poli' =>
                $this->input->post('nama_poli'),

                'keterangan' =>
                $this->input->post('keterangan')
            ];

            $this->M_poliklinik->update(
                $id,
                $update
            );

            $this->session->set_flashdata(
                'success',
                'Data poliklinik berhasil diupdate'
            );

            redirect('poliklinik');
        }

        $this->load->view(
            'poliklinik/edit',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {
        $data['detail'] =
        $this->M_poliklinik->detail($id);

        $this->load->view(
            'poliklinik/detail',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS
    |--------------------------------------------------------------------------
    */

    public function hapus($id)
    {
        $this->M_poliklinik->hapus($id);

        $this->session->set_flashdata(
            'success',
            'Data poliklinik berhasil dihapus'
        );

        redirect('poliklinik');
    }
}