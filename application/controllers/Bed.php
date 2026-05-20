<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bed extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();
    }

    public function index()
    {
        $data['bed'] = $this->db
            ->select('bed.*, kamar.kode_kamar, kamar.nama_kamar, kamar.kelas')
            ->from('bed')
            ->join('kamar', 'kamar.id = bed.kamar_id', 'left')
            ->order_by('bed.id', 'DESC')
            ->get()
            ->result();

        $this->load->view('bed/index', $data);
    }

    public function tambah()
    {
        $data['kamar'] = $this->db
            ->order_by('nama_kamar', 'ASC')
            ->get('kamar')
            ->result();

        if ($this->input->post()) {
            if (empty($this->input->post('kamar_id'))) {
                $this->session->set_flashdata('error', 'Data kamar belum tersedia. Tambahkan kamar terlebih dahulu.');
                redirect('bed/tambah');
            }

            $insert = [
                'kamar_id' => $this->input->post('kamar_id', TRUE),
                'nomor_bed' => $this->input->post('nomor_bed', TRUE),
                'status' => $this->input->post('status', TRUE),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('bed', $insert);

            $this->session->set_flashdata('success', 'Data bed berhasil ditambahkan');
            redirect('bed');
        }

        $this->load->view('bed/tambah', $data);
    }

    public function edit($id)
    {
        $data['detail'] = $this->db->get_where('bed', ['id' => $id])->row();
        $data['kamar'] = $this->db
            ->order_by('nama_kamar', 'ASC')
            ->get('kamar')
            ->result();

        if (!$data['detail']) {
            show_404();
        }

        if ($this->input->post()) {
            $update = [
                'kamar_id' => $this->input->post('kamar_id', TRUE),
                'nomor_bed' => $this->input->post('nomor_bed', TRUE),
                'status' => $this->input->post('status', TRUE)
            ];

            $this->db->where('id', $id)->update('bed', $update);

            $this->session->set_flashdata('success', 'Data bed berhasil diupdate');
            redirect('bed');
        }

        $this->load->view('bed/edit', $data);
    }

    public function hapus($id)
    {
        $dipakai_rawat = $this->db->where('bed_id', $id)->count_all_results('rawat_inap');

        if ($dipakai_rawat > 0) {
            $this->session->set_flashdata('error', 'Bed tidak bisa dihapus karena sudah dipakai di data rawat inap');
            redirect('bed');
        }

        $this->db->where('id', $id)->delete('bed');

        $this->session->set_flashdata('success', 'Data bed berhasil dihapus');
        redirect('bed');
    }
}