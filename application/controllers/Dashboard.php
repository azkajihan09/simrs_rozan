<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();
   

        $this->load->model('M_dashboard');
    }

    public function index()
{

    /*
    |--------------------------------------------------------------------------
    | PASIEN
    |--------------------------------------------------------------------------
    */

    $data['pasien_hari_ini'] =

    $this->db

    ->where('tanggal', date('Y-m-d'))

    ->count_all_results('pendaftaran');

    /*
    |--------------------------------------------------------------------------
    | ANTRIAN
    |--------------------------------------------------------------------------
    */

    $data['antrian_aktif'] =

    $this->db

    ->where('status !=', 'SELESAI')

    ->count_all_results('antrian');

    /*
    |--------------------------------------------------------------------------
    | BILLING
    |--------------------------------------------------------------------------
    */

    $billing = $this->db

    ->select_sum('total_bayar')

    ->where('DATE(created_at)', date('Y-m-d'))

    ->get('billing')

    ->row();

    $data['billing_hari_ini'] =
        $billing->total_bayar ?? 0;

    /*
    |--------------------------------------------------------------------------
    | BILLING LUNAS
    |--------------------------------------------------------------------------
    */

    $data['total_lunas'] =

    $this->db

    ->where('status', 'LUNAS')

    ->count_all_results('billing');

    /*
    |--------------------------------------------------------------------------
    | DOKTER
    |--------------------------------------------------------------------------
    */

    $data['dokter_aktif'] =

    $this->db

    ->count_all('dokter');

    /*
    |--------------------------------------------------------------------------
    | OBAT MENIPIS
    |--------------------------------------------------------------------------
    */

    $data['obat_hampir_habis'] =

    $this->db

    ->where('stok <=', 10)

    ->order_by('stok', 'ASC')

    ->limit(5)

    ->get('obat')

    ->result();

    /*
    |--------------------------------------------------------------------------
    | ANTRIAN REALTIME
    |--------------------------------------------------------------------------
    */

    $data['antrian'] = $this->db

    ->select('

        antrian.*,

        pasien.nama_pasien,

        dokter.nama_dokter,

        poliklinik.nama_poli

    ')

    ->from('antrian')

    ->join(
        'pasien',
        'pasien.id_pasien = antrian.pasien_id',
        'left'
    )

    ->join(
        'dokter',
        'dokter.id = antrian.dokter_id',
        'left'
    )

    ->join(
        'poliklinik',
        'poliklinik.id = antrian.poli_id',
        'left'
    )

    ->order_by('antrian.id', 'DESC')

    ->limit(10)

    ->get()

    ->result();

    /*
    |--------------------------------------------------------------------------
    | GRAFIK KUNJUNGAN
    |--------------------------------------------------------------------------
    */

    $grafik = $this->db

    ->select('tanggal, COUNT(*) as total')

    ->from('pendaftaran')

    ->group_by('tanggal')

    ->order_by('tanggal', 'ASC')

    ->limit(7)

    ->get()

    ->result();

    $grafik_tanggal = [];
    $grafik_jumlah = [];

    foreach($grafik as $g){

        $grafik_tanggal[] =
            date(
                'd M',
                strtotime($g->tanggal)
            );

        $grafik_jumlah[] =
            (int)$g->total;

    }

    $data['grafik_tanggal'] =
        $grafik_tanggal;

    $data['grafik_jumlah'] =
        $grafik_jumlah;

    /*
    |--------------------------------------------------------------------------
    | GRAFIK PASIEN
    |--------------------------------------------------------------------------
    */

    $data['pasien_umum'] =

    $this->db

    ->where('jenis_pasien', 'UMUM')

    ->count_all_results('pendaftaran');

    $data['pasien_bpjs'] =

    $this->db

    ->where('jenis_pasien', 'BPJS')

    ->count_all_results('pendaftaran');

    $data['pasien_asuransi'] =

    $this->db

    ->where('jenis_pasien', 'ASURANSI')

    ->count_all_results('pendaftaran');

    /*
    |--------------------------------------------------------------------------
    | LOAD VIEW
    |--------------------------------------------------------------------------
    */

    $this->load->view(
        'dashboard/index',
        $data
    );

}

}