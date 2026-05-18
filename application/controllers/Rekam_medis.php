<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekam_medis extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();

        $this->load->model('M_rekam_medis');
        $this->load->model('M_antrian');

        $this->load->helper(array('url','form'));
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {

        $data['title'] =
            'Rekam Medis';

        $data['rekam_medis'] =
            $this->M_rekam_medis->get_all();

        $this->load->view(
            'rekam_medis/index',
            $data
        );

    }

    /*
    |--------------------------------------------------------------------------
    | PEMERIKSAAN PASIEN
    |--------------------------------------------------------------------------
    */

    public function periksa($pendaftaran_id)
    {

        /*
        |--------------------------------------------------------------------------
        | DATA PENDAFTARAN
        |--------------------------------------------------------------------------
        */

        $data['daftar'] = $this->db

        ->select('

            pendaftaran.*,

            pasien.nama_pasien,
            pasien.no_rm,
            pasien.jenis_kelamin,
            pasien.tanggal_lahir,
            pasien.telepon,
            pasien.alamat,

            dokter.nama_dokter,

            poliklinik.nama_poli

        ')

        ->from('pendaftaran')

        ->join(
            'pasien',
            'pasien.id_pasien = pendaftaran.pasien_id',
            'left'
        )

        ->join(
            'dokter',
            'dokter.id = pendaftaran.dokter_id',
            'left'
        )

        ->join(
            'poliklinik',
            'poliklinik.id = pendaftaran.poli_id',
            'left'
        )

        ->where(
            'pendaftaran.id',
            $pendaftaran_id
        )

        ->get()

        ->row();

        if(!$data['daftar']){

            $this->session->set_flashdata(
                'error',
                'Data pendaftaran tidak ditemukan'
            );

            redirect('pendaftaran');

        }

        /*
        |--------------------------------------------------------------------------
        | MASTER DATA
        |--------------------------------------------------------------------------
        */

        $data['diagnosa'] = $this->db

        ->order_by(
            'nama_diagnosa',
            'ASC'
        )

        ->get('diagnosa')

        ->result();

        $data['tindakan'] = $this->db

        ->where(
            'status',
            'AKTIF'
        )

        ->get('master_tindakan')

        ->result();

        $data['obat'] = $this->db

        ->where('stok >',0)

        ->order_by(
            'nama_obat',
            'ASC'
        )

        ->get('obat')

        ->result();

        /*
        |--------------------------------------------------------------------------
        | SIMPAN PEMERIKSAAN
        |--------------------------------------------------------------------------
        */

        if($this->input->post()){

            $this->db->trans_strict(TRUE);

            $this->db->trans_begin();

            /*
            |--------------------------------------------------------------------------
            | INSERT REKAM MEDIS
            |--------------------------------------------------------------------------
            */

            $rekam_medis = [

                'pendaftaran_id' =>

                    $pendaftaran_id,

                'pasien_id' =>

                    $data['daftar']->pasien_id,

                'dokter_id' =>

                    $data['daftar']->dokter_id,

                'poli_id' =>

                    $data['daftar']->poli_id,

                'tanggal' =>

                    date('Y-m-d'),

                'keluhan' =>

                    $this->input->post(
                        'keluhan'
                    ),

                'anamnesa' =>

                    $this->input->post(
                        'anamnesa'
                    ),

                'diagnosa_id' =>

                    $this->input->post(
                        'diagnosa_id'
                    ),

                'tekanan_darah' =>

                    $this->input->post(
                        'tekanan_darah'
                    ),

                'berat_badan' =>

                    $this->input->post(
                        'berat_badan'
                    ),

                'suhu' =>

                    $this->input->post(
                        'suhu'
                    ),

                'catatan_dokter' =>

                    $this->input->post(
                        'catatan_dokter'
                    ),

                'status' =>

                    'SELESAI',

                'created_at' =>

                    date('Y-m-d H:i:s')

            ];

            $this->db->insert(
                'rekam_medis',
                $rekam_medis
            );

            $rekam_medis_id =
                $this->db->insert_id();

            /*
            |--------------------------------------------------------------------------
            | BILLING
            |--------------------------------------------------------------------------
            */

            $billing = [

                'rekam_medis_id' =>

                    $rekam_medis_id,

                'pasien_id' =>

                    $data['daftar']->pasien_id,

                'subtotal' =>

                    0,

                'total_bayar' =>

                    0,

                'status' =>

                    'BELUM BAYAR',

                'created_at' =>

                    date('Y-m-d H:i:s')

            ];

            $this->db->insert(
                'billing',
                $billing
            );

            $billing_id =
                $this->db->insert_id();

            $total_bayar = 0;

            /*
            |--------------------------------------------------------------------------
            | TINDAKAN
            |--------------------------------------------------------------------------
            */

            $tindakan_id =
                $this->input->post(
                    'tindakan_id'
                );

            if(!empty($tindakan_id)){

                foreach($tindakan_id as $t){

                    $master = $this->db

                    ->where('id',$t)

                    ->get('master_tindakan')

                    ->row();

                    if(!$master){
                        continue;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | REKAM MEDIS TINDAKAN
                    |--------------------------------------------------------------------------
                    */

                    $insert_tindakan = [

                        'rekam_medis_id' =>

                            $rekam_medis_id,

                        'tindakan_id' =>

                            $master->id,

                        'dokter_id' =>

                            $data['daftar']->dokter_id,

                        'qty' =>

                            1,

                        'tarif' =>

                            $master->tarif,

                        'subtotal' =>

                            $master->tarif

                    ];

                    $this->db->insert(
                        'rekam_medis_tindakan',
                        $insert_tindakan
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | BILLING DETAIL
                    |--------------------------------------------------------------------------
                    */

                    $billing_detail = [

                        'billing_id' =>

                            $billing_id,

                        'jenis_item' =>

                            'TINDAKAN',

                        'item_id' =>

                            $master->id,

                        'nama_item' =>

                            $master->nama_tindakan,

                        'qty' =>

                            1,

                        'harga' =>

                            $master->tarif,

                        'subtotal' =>

                            $master->tarif

                    ];

                    $this->db->insert(
                        'billing_detail',
                        $billing_detail
                    );

                    $total_bayar +=
                        $master->tarif;

                }

            }

            /*
            |--------------------------------------------------------------------------
            | RESEP
            |--------------------------------------------------------------------------
            */

            $obat_id =
                $this->input->post(
                    'obat_id'
                );

            if(!empty($obat_id)){

                $kode_resep =
                    'RSP'.date('YmdHis');

                /*
                |--------------------------------------------------------------------------
                | HEADER RESEP
                |--------------------------------------------------------------------------
                */

                $resep = [

                    'kode_resep' =>

                        $kode_resep,

                    'rekam_medis_id' =>

                        $rekam_medis_id,

                    'pasien_id' =>

                        $data['daftar']->pasien_id,

                    'dokter_id' =>

                        $data['daftar']->dokter_id,

                    

                    'tanggal' =>

                        date('Y-m-d H:i:s'),

                    'status' =>

                        'MENUNGGU'

                ];

                $this->db->insert(
                    'resep',
                    $resep
                );

                $resep_id =
                    $this->db->insert_id();

                /*
|--------------------------------------------------------------------------
| DETAIL RESEP
|--------------------------------------------------------------------------
*/

$qty =
    $this->input->post(
        'qty'
    );

$aturan =
    $this->input->post(
        'aturan_pakai'
    );

foreach($obat_id as $key => $o){

    /*
    |--------------------------------------------------------------------------
    | AMBIL DATA OBAT
    |--------------------------------------------------------------------------
    */

    $obat = $this->db

    ->where(
        'id',
        $o
    )

    ->get('obat')

    ->row();

    /*
    |--------------------------------------------------------------------------
    | VALIDASI
    |--------------------------------------------------------------------------
    */

    if(!$obat){
        continue;
    }

    /*
    |--------------------------------------------------------------------------
    | QTY
    |--------------------------------------------------------------------------
    */

    $jumlah =
        isset($qty[$key])
        ? (int)$qty[$key]
        : 0;

    if($jumlah <= 0){
        continue;
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI STOK
    |--------------------------------------------------------------------------
    */

    if($jumlah > $obat->stok){

        $this->db->trans_rollback();

        $this->session->set_flashdata(

            'error',

            'Stok obat '.$obat->nama_obat.' tidak mencukupi'

        );

        redirect(
            'rekam_medis/periksa/'.$pendaftaran_id
        );

    }

    /*
    |--------------------------------------------------------------------------
    | SUBTOTAL
    |--------------------------------------------------------------------------
    */

    $subtotal =
        $jumlah *
        $obat->harga_jual;

    /*
    |--------------------------------------------------------------------------
    | RESEP DETAIL
    |--------------------------------------------------------------------------
    */

    $detail = [

        'resep_id' =>

            $resep_id,

        'obat_id' =>

            $obat->id,

        'qty' =>

            $jumlah,

        'aturan_pakai' =>

            isset($aturan[$key])
            ? $aturan[$key]
            : '',

        'harga' =>

            $obat->harga_jual,

        'subtotal' =>

            $subtotal

    ];

    $this->db->insert(
        'resep_detail',
        $detail
    );

    /*
    |--------------------------------------------------------------------------
    | UPDATE STOK OBAT
    |--------------------------------------------------------------------------
    */

    $stok_baru =
        $obat->stok -
        $jumlah;

    $this->db

    ->where(
        'id',
        $obat->id
    )

    ->update('obat',[

        'stok' =>
            $stok_baru

    ]);

    /*
    |--------------------------------------------------------------------------
    | BILLING DETAIL
    |--------------------------------------------------------------------------
    */

    $billing_detail = [

        'billing_id' =>

            $billing_id,

        'jenis_item' =>

            'OBAT',

        'item_id' =>

            $obat->id,

        'nama_item' =>

            $obat->nama_obat,

        'qty' =>

            $jumlah,

        'harga' =>

            $obat->harga_jual,

        'subtotal' =>

            $subtotal

    ];

    $this->db->insert(
        'billing_detail',
        $billing_detail
    );

    /*
    |--------------------------------------------------------------------------
    | TOTAL BILLING
    |--------------------------------------------------------------------------
    */

    $total_bayar +=
        $subtotal;

}            

}

            /*
            |--------------------------------------------------------------------------
            | UPDATE TOTAL BILLING
            |--------------------------------------------------------------------------
            */

            $this->db

            ->where(
                'id',
                $billing_id
            )

            ->update('billing',[

                'subtotal' =>

                    $total_bayar,

                'total_bayar' =>

                    $total_bayar

            ]);

            /*
            |--------------------------------------------------------------------------
            | UPDATE PENDAFTARAN
            |--------------------------------------------------------------------------
            */

            $this->db

            ->where(
                'id',
                $pendaftaran_id
            )

            ->update('pendaftaran',[

                'status' =>
                    'SELESAI'

            ]);

            /*
            |--------------------------------------------------------------------------
            | UPDATE ANTRIAN
            |--------------------------------------------------------------------------
            */

            $this->db

            ->where(
                'pasien_id',
                $data['daftar']->pasien_id
            )

            ->where(
                'tanggal',
                date('Y-m-d')
            )

            ->update('antrian',[

                'status' =>
                    'SELESAI'

            ]);

            /*
            |--------------------------------------------------------------------------
            | COMMIT
            |--------------------------------------------------------------------------
            */

            if(
                $this->db->trans_status()
                === FALSE
            ){

                $this->db->trans_rollback();

                $this->session->set_flashdata(

                    'error',

                    'Pemeriksaan gagal disimpan'

                );

            } else {

                $this->db->trans_commit();

                $this->session->set_flashdata(

                    'success',

                    'Pemeriksaan berhasil disimpan'

                );

            }

            redirect(
                'billing/pasien/'.$billing_id
            );

        }

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        $this->load->view(
            'rekam_medis/periksa',
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

        $data['title'] =
            'Detail Rekam Medis';

        $data['rekam_medis'] =
            $this->M_rekam_medis->detail($id);

        $this->load->view(
            'rekam_medis/detail',
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

        $this->M_rekam_medis->hapus($id);

        $this->session->set_flashdata(
            'success',
            'Data berhasil dihapus'
        );

        redirect('rekam_medis');

    }

}