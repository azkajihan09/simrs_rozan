<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rawatinap extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();
       
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['rawat'] = $this->db

        ->select('
            rawat_inap.*,
            pasien.nama_pasien,
            pasien.no_rm,
            dokter.nama_dokter,
            kamar.nama_kamar,
            bed.nomor_bed
        ')

        ->from('rawat_inap')

        ->join(
            'pasien',
            'pasien.id=rawat_inap.pasien_id'
        )

        ->join(
            'dokter',
            'dokter.id=rawat_inap.dokter_id'
        )

        ->join(
            'kamar',
            'kamar.id=rawat_inap.kamar_id'
        )

        ->join(
            'bed',
            'bed.id=rawat_inap.bed_id'
        )

        ->order_by(
            'rawat_inap.id',
            'DESC'
        )

        ->get()

        ->result();

        $this->load->view(
            'rawatinap/index',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH RAWAT INAP
    |--------------------------------------------------------------------------
    */

    public function tambah()
    {
        $data['pasien'] =
        $this->db->get('pasien')->result();

        $data['dokter'] =
        $this->db->get('dokter')->result();

        $data['bed'] = $this->db

        ->select('
            bed.*,
            kamar.nama_kamar
        ')

        ->from('bed')

        ->join(
            'kamar',
            'kamar.id=bed.kamar_id'
        )

        ->where(
            'bed.status',
            'KOSONG'
        )

        ->get()

        ->result();

        if($this->input->post()){

            $bed = $this->db

            ->get_where(
                'bed',
                ['id'=>$this->input->post('bed_id')]
            )

            ->row();

            $insert = [

                'pasien_id' => $this->input->post('pasien_id'),

                'dokter_id' => $this->input->post('dokter_id'),

                'kamar_id' => $bed->kamar_id,

                'bed_id' => $this->input->post('bed_id'),

                'tanggal_masuk' => date('Y-m-d H:i:s'),

                'diagnosa' => $this->input->post('diagnosa'),

                'kondisi_pasien' => $this->input->post('kondisi_pasien')
            ];

            $this->db->insert(
                'rawat_inap',
                $insert
            );

            /*
            |--------------------------------------------------------------------------
            | UPDATE STATUS BED
            |--------------------------------------------------------------------------
            */

            $this->db->where(
                'id',
                $this->input->post('bed_id')
            );

            $this->db->update('bed',[

                'status'=>'TERISI'
            ]);

            redirect('rawatinap');
        }

        $this->load->view(
            'rawatinap/tambah',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PASIEN PULANG
    |--------------------------------------------------------------------------
    */

    public function pulang($id)
    {
        $rawat = $this->db

        ->get_where(
            'rawat_inap',
            ['id'=>$id]
        )

        ->row();

        $this->db->where('id',$id);

        $this->db->update('rawat_inap',[

            'tanggal_keluar' =>
            date('Y-m-d H:i:s'),

            'status' => 'PULANG'
        ]);

        /*
        |--------------------------------------------------------------------------
        | BED KEMBALI KOSONG
        |--------------------------------------------------------------------------
        */

        $this->db->where(
            'id',
            $rawat->bed_id
        );

        $this->db->update('bed',[

            'status'=>'KOSONG'
        ]);

        redirect('rawatinap');
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL RAWAT INAP
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {
        $data['detail'] = $this->db

        ->select('
            rawat_inap.*,
            pasien.nama_pasien,
            pasien.no_rm,
            dokter.nama_dokter,
            kamar.nama_kamar,
            kamar.kelas,
            bed.nomor_bed
        ')

        ->from('rawat_inap')

        ->join(
            'pasien',
            'pasien.id=rawat_inap.pasien_id'
        )

        ->join(
            'dokter',
            'dokter.id=rawat_inap.dokter_id'
        )

        ->join(
            'kamar',
            'kamar.id=rawat_inap.kamar_id'
        )

        ->join(
            'bed',
            'bed.id=rawat_inap.bed_id'
        )

        ->where(
            'rawat_inap.id',
            $id
        )

        ->get()

        ->row();

        $this->load->view(
            'rawatinap/detail',
            $data
        );
    }
}