<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pasien extends CI_Model {

    /*
    |--------------------------------------------------------------------------
    | NAMA TABEL
    |--------------------------------------------------------------------------
    */

    private $table = 'pasien';

    /*
    |--------------------------------------------------------------------------
    | GET ALL DATA PASIEN
    |--------------------------------------------------------------------------
    */

    public function get_all()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id_pasien', 'DESC');

        return $this->db->get()->result();
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL PASIEN
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_pasien', $id);

        return $this->db->get()->row();
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA PASIEN
    |--------------------------------------------------------------------------
    */

    public function simpan($data)
    {
        return $this->db->insert(
            $this->table,
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA PASIEN
    |--------------------------------------------------------------------------
    */

    public function update($id, $data)
    {
        $this->db->where(
            'id_pasien',
            $id
        );

        return $this->db->update(
            $this->table,
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS DATA PASIEN
    |--------------------------------------------------------------------------
    */

    public function hapus($id)
    {
        $this->db->where(
            'id_pasien',
            $id
        );

        return $this->db->delete(
            $this->table
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HITUNG TOTAL PASIEN
    |--------------------------------------------------------------------------
    */

    public function total_pasien()
    {
        return $this->db
            ->count_all($this->table);
    }

    /*
    |--------------------------------------------------------------------------
    | CEK NIK
    |--------------------------------------------------------------------------
    */

    public function cek_nik($nik)
    {
        return $this->db
            ->get_where(
                $this->table,
                ['nik' => $nik]
            )
            ->row();
    }

    /*
    |--------------------------------------------------------------------------
    | GENERATE NOMOR RM
    |--------------------------------------------------------------------------
    */

    public function generate_no_rm()
    {
        $tanggal = date('Ymd');

        $this->db->select('RIGHT(no_rm,4) as nomor');
        $this->db->like('no_rm', 'RM'.$tanggal, 'after');
        $this->db->order_by('no_rm', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get($this->table);

        if($query->num_rows() > 0){

            $data = $query->row();

            $nomor_urut =
            intval($data->nomor) + 1;

        } else {

            $nomor_urut = 1;
        }

        $urut =
        str_pad(
            $nomor_urut,
            4,
            '0',
            STR_PAD_LEFT
        );

        return 'RM'.$tanggal.$urut;
    }

    /*
    |--------------------------------------------------------------------------
    | PENCARIAN PASIEN
    |--------------------------------------------------------------------------
    */

    public function cari_pasien($keyword)
    {
        $this->db->from($this->table);

        $this->db->group_start();

        $this->db->like(
            'nama_pasien',
            $keyword
        );

        $this->db->or_like(
            'nik',
            $keyword
        );

        $this->db->or_like(
            'no_rm',
            $keyword
        );

        $this->db->or_like(
            'telepon',
            $keyword
        );

        $this->db->group_end();

        $this->db->order_by(
            'id_pasien',
            'DESC'
        );

        return $this->db
            ->get()
            ->result();
    }
}