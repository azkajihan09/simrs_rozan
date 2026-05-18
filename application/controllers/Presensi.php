<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presensi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {
        $data['presensi'] = $this->db

        ->order_by('id','DESC')

        ->get('presensi')

        ->result();

        $this->load->view(
            'presensi/index',
            $data
        );
    }

    public function simpan()
    {
        $foto = $this->input->post('foto');

        $foto = str_replace(
            'data:image/png;base64,',
            '',
            $foto
        );

        $foto = str_replace(
            ' ',
            '+',
            $foto
        );

        $nama_file = time().'.png';

        file_put_contents(

            './uploads/presensi/'.$nama_file,

            base64_decode($foto)
        );

        $data = [

            'user_id' => $this->session->userdata('id'),

            'tanggal' => date('Y-m-d'),

            'jam_masuk' => date('H:i:s'),

            'latitude' => $this->input->post('latitude'),

            'longitude' => $this->input->post('longitude'),

            'foto' => $nama_file,

            'status' => 'MASUK'
        ];

        $this->db->insert(
            'presensi',
            $data
        );

        redirect('presensi');
    }

    public function pulang($id)
    {
        $this->db->where('id',$id);

        $this->db->update('presensi',[

            'jam_pulang' => date('H:i:s'),

            'status' => 'PULANG'
        ]);

        redirect('presensi');
    }
}