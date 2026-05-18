<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();
      

        $this->load->model('M_obat');
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['obat'] =
        $this->M_obat->get_all();

        $this->load->view(
            'obat/index',
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

                'kode_obat' =>

                $this->input->post(
                    'kode_obat'
                ),

                'nama_obat' =>

                $this->input->post(
                    'nama_obat'
                ),

                'kategori' =>

                $this->input->post(
                    'kategori'
                ),

                'satuan' =>

                $this->input->post(
                    'satuan'
                ),

                'stok' =>

                $this->input->post(
                    'stok'
                ),

                'stok_minimal' =>

                $this->input->post(
                    'stok_minimal'
                ),

                'harga_beli' =>

                $this->input->post(
                    'harga_beli'
                ),

                'harga_jual' =>

                $this->input->post(
                    'harga_jual'
                ),

                'expired_date' =>

                $this->input->post(
                    'expired_date'
                )
            ];

            $this->M_obat->simpan(
                $simpan
            );

            $this->session->set_flashdata(
                'success',
                'Obat berhasil ditambah'
            );

            redirect('obat');
        }

        $this->load->view(
            'obat/tambah'
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
        $this->M_obat->detail($id);
if($qty[$key] > $obat->stok){

    $this->db->trans_rollback();

    $this->session->set_flashdata(
        'error',
        'Stok '.$obat->nama_obat.' tidak mencukupi'
    );

    redirect(
        'resep/tambah/'.$rekam_medis_id
    );
}
        if($this->input->post()){

            $update = [

                'kode_obat' =>

                $this->input->post(
                    'kode_obat'
                ),

                'nama_obat' =>

                $this->input->post(
                    'nama_obat'
                ),

                'kategori' =>

                $this->input->post(
                    'kategori'
                ),

                'satuan' =>

                $this->input->post(
                    'satuan'
                ),

                'stok' =>

                $this->input->post(
                    'stok'
                ),

                'stok_minimal' =>

                $this->input->post(
                    'stok_minimal'
                ),

                'harga_beli' =>

                $this->input->post(
                    'harga_beli'
                ),

                'harga_jual' =>

                $this->input->post(
                    'harga_jual'
                ),

                'expired_date' =>

                $this->input->post(
                    'expired_date'
                )
            ];

            $this->M_obat->update(
                $id,
                $update
            );

            $this->session->set_flashdata(
                'success',
                'Obat berhasil diupdate'
            );

            redirect('obat');
        }

        $this->load->view(
            'obat/edit',
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
        $this->M_obat->detail($id);

        $this->load->view(
            'obat/detail',
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
        $this->M_obat->hapus($id);

        $this->session->set_flashdata(
            'success',
            'Obat berhasil dihapus'
        );

        redirect('obat');
    }
}