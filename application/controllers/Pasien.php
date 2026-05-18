<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();
        

        $this->load->model('M_pasien');
        $this->load->library('form_validation');
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['title'] = 'Data Pasien';
        $data['pasien'] = $this->M_pasien->get_all();

        $this->load->view('pasien/index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH PASIEN
    |--------------------------------------------------------------------------
    */

    public function tambah()
{

    $data['title'] = 'Tambah Pasien';

    /*
    |--------------------------------------------------------------------------
    | GENERATE NO RM
    |--------------------------------------------------------------------------
    */

    $last = $this->db
        ->order_by('id_pasien','DESC')
        ->get('pasien')
        ->row();

    if($last){

        $urut = (int) substr($last->no_rm, -4);

        $urut++;

    } else {

        $urut = 1;
    }

    $data['kode_rm'] =
        'RM'.date('ymd').sprintf('%04s',$urut);

    $this->load->view(
        'pasien/tambah',
        $data
    );
}

public function simpan()
{

    $insert = [

        'no_rm' =>
            $this->input->post('no_rm'),

        'nik' =>
            $this->input->post('nik'),

        'nama_pasien' =>
            $this->input->post('nama_pasien'),

        'jenis_kelamin' =>
            $this->input->post('jenis_kelamin'),

        'tanggal_lahir' =>
            $this->input->post('tanggal_lahir'),

        'telepon' =>
            $this->input->post('telepon'),

        'alamat' =>
            $this->input->post('alamat')

    ];

    $this->db->insert(
        'pasien',
        $insert
    );

    $this->session->set_flashdata(
        'success',
        'Data pasien berhasil disimpan'
    );

    redirect('pasien');
}

    /*
    |--------------------------------------------------------------------------
    | EDIT PASIEN
    |--------------------------------------------------------------------------
    */

    public function edit($id = null)
    {
        if (!$id) {
            show_404();
        }

        $data['title'] = 'Edit Pasien';

        $data['pasien'] = $this->M_pasien->detail($id);

        if (!$data['pasien']) {
            show_404();
        }

        $this->_validasi_pasien();

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('pasien/edit', $data);

        } else {

            $update = [

                'nik'              => htmlspecialchars($this->input->post('nik', true)),
                'nama_pasien'      => htmlspecialchars($this->input->post('nama_pasien', true)),
                'jenis_kelamin'    => htmlspecialchars($this->input->post('jenis_kelamin', true)),
                'tempat_lahir'     => htmlspecialchars($this->input->post('tempat_lahir', true)),
                'tanggal_lahir'    => htmlspecialchars($this->input->post('tanggal_lahir', true)),
                'alamat'           => htmlspecialchars($this->input->post('alamat', true)),
                'telepon'          => htmlspecialchars($this->input->post('telepon', true)),
            ];

            $this->M_pasien->update($id, $update);

            $this->session->set_flashdata(
                'success',
                'Data pasien berhasil diupdate'
            );

            redirect('pasien');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL PASIEN
    |--------------------------------------------------------------------------
    */

    public function detail($id)
{

    $data['title'] = 'Detail Pasien';

    $data['pasien'] =
        $this->M_pasien->detail($id);

    $this->load->view(
        'pasien/detail',
        $data
    );
}

    /*
    |--------------------------------------------------------------------------
    | HAPUS PASIEN
    |--------------------------------------------------------------------------
    */

    public function hapus($id = null)
    {
        if (!$id) {
            show_404();
        }

        $pasien = $this->M_pasien->detail($id);

        if (!$pasien) {
            show_404();
        }

        $this->M_pasien->hapus($id);

        $this->session->set_flashdata(
            'success',
            'Data pasien berhasil dihapus'
        );

        redirect('pasien');
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI FORM
    |--------------------------------------------------------------------------
    */

    private function _validasi_pasien()
    {
        $this->form_validation->set_rules(
            'nama_pasien',
            'Nama Pasien',
            'required|trim',
            [
                'required' => 'Nama pasien wajib diisi'
            ]
        );

        $this->form_validation->set_rules(
            'nik',
            'NIK',
            'required|numeric|min_length[16]|max_length[16]',
            [
                'required'   => 'NIK wajib diisi',
                'numeric'    => 'NIK harus angka',
                'min_length' => 'NIK harus 16 digit',
                'max_length' => 'NIK harus 16 digit'
            ]
        );

        $this->form_validation->set_rules(
            'jenis_kelamin',
            'Jenis Kelamin',
            'required',
            [
                'required' => 'Jenis kelamin wajib dipilih'
            ]
        );

        $this->form_validation->set_rules(
            'telepon',
            'Telepon',
            'required',
            [
                'required' => 'Nomor telepon wajib diisi'
            ]
        );
    }
}