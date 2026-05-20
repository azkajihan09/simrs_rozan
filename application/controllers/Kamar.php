<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();
    }

    public function index()
    {
        $data['kamar'] = $this->db
            ->order_by('id', 'DESC')
            ->get('kamar')
            ->result();

        $this->load->view('kamar/index', $data);
    }

    public function tambah()
    {
        if ($this->input->post()) {
            $insert = [
                'kode_kamar' => $this->input->post('kode_kamar', TRUE),
                'nama_kamar' => $this->input->post('nama_kamar', TRUE),
                'kelas' => $this->input->post('kelas', TRUE),
                'tarif_harian' => $this->input->post('tarif_harian', TRUE),
                'kapasitas' => $this->input->post('kapasitas', TRUE),
                'status' => $this->input->post('status', TRUE),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('kamar', $insert);

            $this->session->set_flashdata('success', 'Data kamar berhasil ditambahkan');
            redirect('kamar');
        }

        $this->load->view('kamar/tambah');
    }

    public function edit($id)
    {
        $data['detail'] = $this->db->get_where('kamar', ['id' => $id])->row();

        if (!$data['detail']) {
            show_404();
        }

        if ($this->input->post()) {
            $update = [
                'kode_kamar' => $this->input->post('kode_kamar', TRUE),
                'nama_kamar' => $this->input->post('nama_kamar', TRUE),
                'kelas' => $this->input->post('kelas', TRUE),
                'tarif_harian' => $this->input->post('tarif_harian', TRUE),
                'kapasitas' => $this->input->post('kapasitas', TRUE),
                'status' => $this->input->post('status', TRUE)
            ];

            $this->db->where('id', $id)->update('kamar', $update);

            $this->session->set_flashdata('success', 'Data kamar berhasil diupdate');
            redirect('kamar');
        }

        $this->load->view('kamar/edit', $data);
    }

    public function hapus($id)
    {
        $jumlah_bed = $this->db->where('kamar_id', $id)->count_all_results('bed');

        if ($jumlah_bed > 0) {
            $this->session->set_flashdata('error', 'Kamar tidak bisa dihapus karena masih memiliki data bed');
            redirect('kamar');
        }

        $this->db->where('id', $id)->delete('kamar');

        $this->session->set_flashdata('success', 'Data kamar berhasil dihapus');
        redirect('kamar');
    }
}