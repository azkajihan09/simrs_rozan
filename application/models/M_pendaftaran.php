<?php

class M_pendaftaran extends CI_Model {

    /*
    |--------------------------------------------------------------------------
    | GET ALL PENDAFTARAN
    |--------------------------------------------------------------------------
    */

   public function get_all()
{
    return $this->db
        ->select('
            pendaftaran.*,

            pasien.nama_pasien,
            pasien.no_rm,
            pasien.telepon,

            dokter.nama_dokter,

            poliklinik.nama_poli,

            antrian.nomor_antrian,
            antrian.status as status_antrian
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

        ->join(
            'antrian',
            'antrian.pasien_id = pendaftaran.pasien_id 
            AND antrian.tanggal = pendaftaran.tanggal',
            'left'
        )

        ->order_by('pendaftaran.id','DESC')

        ->get()

        ->result();
}
    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {
        return $this->db
            ->select('
                pendaftaran.*,
                pasien.nama_pasien,
                pasien.no_rm,
                pasien.telepon,
                pasien.alamat,
                dokter.nama_dokter,
                poliklinik.nama_poli
            ')
            ->from('pendaftaran')
            ->join('pasien','pasien.id_pasien = pendaftaran.pasien_id','left')
            ->join('dokter','dokter.id = pendaftaran.dokter_id','left')
            ->join('poliklinik','poliklinik.id = pendaftaran.poli_id','left')
            ->where('pendaftaran.id',$id)
            ->get()
            ->row();
    }

    /*
    |--------------------------------------------------------------------------
    | GENERATE NOMOR ANTRIAN
    |--------------------------------------------------------------------------
    */

    public function generate_nomor_antrian($poli_id)
    {
        $today = date('Y-m-d');

        $this->db->where('tanggal',$today);

        $this->db->where('poli_id',$poli_id);

        $this->db->from('pendaftaran');

        $total = $this->db->count_all_results();

        return $total + 1;
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PENDAFTARAN + AUTO ANTRIAN
    |--------------------------------------------------------------------------
    */

    public function simpan($data)
    {
        $this->db->trans_begin();

        /*
        |--------------------------------------------------------------------------
        | INSERT PENDAFTARAN
        |--------------------------------------------------------------------------
        */

        $this->db->insert('pendaftaran',$data);

        $pendaftaran_id = $this->db->insert_id();

        /*
        |--------------------------------------------------------------------------
        | INSERT ANTRIAN
        |--------------------------------------------------------------------------
        */

        $antrian = [

            'kode_antrian' => 'A'.date('YmdHis'),

            'pasien_id' => $data['pasien_id'],

            'dokter_id' => $data['dokter_id'],

            'poliklinik_id' => $data['poli_id'],

            'poli_id' => $data['poli_id'],

            'tanggal' => $data['tanggal'],

            'nomor_antrian' => $data['no_antrian'],

            'urutan_harian' => $data['no_antrian'],

            'jenis_antrian' => $data['jenis_pasien'],

            'status' => 'MENUNGGU'

        ];

        $this->db->insert('antrian',$antrian);

     

        /*
        |--------------------------------------------------------------------------
        | COMMIT
        |--------------------------------------------------------------------------
        */

        if ($this->db->trans_status() === FALSE){

            $this->db->trans_rollback();

            return false;

        } else {

            $this->db->trans_commit();

            return true;

        }
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update($id,$data)
    {
        return $this->db
            ->where('id',$id)
            ->update('pendaftaran',$data);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        return $this->db
            ->where('id',$id)
            ->delete('pendaftaran');
    }

}