<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Farmasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

   cek_login();
        $this->load->model('M_farmasi');
    }

    public function index()
    {
        $data['obat'] = $this->M_farmasi->get_all();

        $this->load->view(
            'farmasi/index',
            $data
        );
    }

    public function tambah()
    {
        if($this->input->post()){

            $data = [

                'kode_obat' => $this->input->post('kode_obat'),

                'nama_obat' => $this->input->post('nama_obat'),

                'kategori' => $this->input->post('kategori'),

                'stok' => $this->input->post('stok'),

                'satuan' => $this->input->post('satuan'),

                'harga_beli' => $this->input->post('harga_beli'),

                'harga_jual' => $this->input->post('harga_jual'),

                'expired_date' => $this->input->post('expired_date')
            ];

            $this->M_farmasi->simpan($data);

            redirect('farmasi');
        }

        $this->load->view('farmasi/tambah');
    }

    public function edit($id)
    {
        $data['obat'] = $this->M_farmasi
            ->detail($id);

        if($this->input->post()){

            $update = [

                'kode_obat' => $this->input->post('kode_obat'),

                'nama_obat' => $this->input->post('nama_obat'),

                'kategori' => $this->input->post('kategori'),

                'stok' => $this->input->post('stok'),

                'satuan' => $this->input->post('satuan'),

                'harga_beli' => $this->input->post('harga_beli'),

                'harga_jual' => $this->input->post('harga_jual'),

                'expired_date' => $this->input->post('expired_date')
            ];

            $this->M_farmasi->update(
                $id,
                $update
            );

            redirect('farmasi');
        }

        $this->load->view(
            'farmasi/edit',
            $data
        );
    }

    public function hapus($id)
    {
        $this->M_farmasi->delete($id);

        redirect('farmasi');
    }
    public function resep()
{
    $data['resep'] = $this->db

    ->select('
        resep.*,
        pasien.nama_pasien,
        dokter.nama_dokter
    ')

    ->from('resep')

    ->join(
        'pasien',
        'pasien.id=resep.pasien_id'
    )

    ->join(
        'dokter',
        'dokter.id=resep.dokter_id'
    )

    ->order_by(
        'resep.id',
        'DESC'
    )

    ->get()

    ->result();

    $this->load->view(
        'farmasi/resep',
        $data
    );
}

public function proses_resep($id)
{

    /*
    |--------------------------------------------------------------------------
    | AMBIL DETAIL RESEP
    |--------------------------------------------------------------------------
    */

    $detail = $this->db

    ->get_where(
        'resep_detail',
        ['resep_id'=>$id]
    )

    ->result();

    /*
    |--------------------------------------------------------------------------
    | KURANGI STOK OBAT
    |--------------------------------------------------------------------------
    */

    foreach($detail as $d){

        $this->db->set(
            'stok',
            'stok-'.$d->qty,
            FALSE
        );

        $this->db->where(
            'id',
            $d->obat_id
        );

        $this->db->update('obat');
    }

    /*
    |--------------------------------------------------------------------------
    | HITUNG TOTAL BILLING
    |--------------------------------------------------------------------------
    */

    $subtotal = 0;

    foreach($detail as $d){

        $subtotal += $d->subtotal;
    }

    /*
    |--------------------------------------------------------------------------
    | AMBIL DATA RESEP
    |--------------------------------------------------------------------------
    */

    $resep = $this->db

    ->get_where(
        'resep',
        ['id'=>$id]
    )

    ->row();

    /*
    |--------------------------------------------------------------------------
    | INSERT BILLING
    |--------------------------------------------------------------------------
    */

    $billing = [

        'kode_billing' =>

        'BILL'.date('YmdHis'),

        'pasien_id' =>

        $resep->pasien_id,

        'tanggal_billing' =>

        date('Y-m-d H:i:s'),

        'jenis_pembayaran' =>

        'UMUM',

        'subtotal' =>

        $subtotal,

        'diskon' => 0,

        'total_bayar' =>

        $subtotal,

        'status' =>

        'BELUM_LUNAS'
    ];

    $this->db->insert(
        'billing',
        $billing
    );

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS RESEP
    |--------------------------------------------------------------------------
    */

    $this->db->where('id',$id);

    $this->db->update(
        'resep',
        ['status'=>'SELESAI']
    );

    /*
    |--------------------------------------------------------------------------
    | REDIRECT
    |--------------------------------------------------------------------------
    */

    $this->session->set_flashdata(
        'success',
        'Resep berhasil diproses'
    );

    redirect('farmasi');
}

public function detail_resep($id)
{
    $data['resep'] = $this->db

    ->select('
        resep.*,
        pasien.nama_pasien,
        dokter.nama_dokter
    ')

    ->from('resep')

    ->join(
        'pasien',
        'pasien.id=resep.pasien_id'
    )

    ->join(
        'dokter',
        'dokter.id=resep.dokter_id'
    )

    ->where('resep.id',$id)

    ->get()

    ->row();

    $data['detail'] = $this->db

    ->select('
        resep_detail.*,
        obat.nama_obat,
        obat.harga_jual
    ')

    ->from('resep_detail')

    ->join(
        'obat',
        'obat.id=resep_detail.obat_id'
    )

    ->where(
        'resep_detail.resep_id',
        $id
    )

    ->get()

    ->result();

    $this->load->view(
        'farmasi/detail_resep',
        $data
    );
}
public function proses($id)
{
    $detail = $this->db

    ->get_where(
        'resep_detail',
        ['resep_id'=>$id]
    )

    ->result();

    foreach($detail as $d){

        $obat = $this->db

        ->get_where(
            'obat',
            ['id'=>$d->obat_id]
        )

        ->row();

        $stok_baru = $obat->stok - $d->qty;

        $this->db->where(
            'id',
            $d->obat_id
        );

        $this->db->update('obat',[

            'stok'=>$stok_baru
        ]);

        $this->db->insert('obat_keluar',[

            'obat_id'=>$d->obat_id,

            'qty'=>$d->qty,

            'tanggal'=>date('Y-m-d H:i:s'),

            'keterangan'=>'Resep pasien'
        ]);
    }

    $this->db->where('id',$id);

    $this->db->update('resep',[

        'status'=>'SELESAI'
    ]);

    redirect('farmasi/resep');
}

public function search_obat()
    {
        $keyword =
        $this->input->post('keyword');

        $this->db->like(
            'nama_obat',
            $keyword
        );

        $obat = $this->db
        ->get('obat')
        ->result();

        foreach($obat as $o){

            echo '
            <div class="card p-2 mb-2">
            '.$o->nama_obat.'
            - Stok: '.$o->stok.'
            </div>
            ';
        }
    }
}