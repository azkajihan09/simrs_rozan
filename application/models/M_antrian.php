<?php

class M_antrian extends CI_Model {

    public function get_all()
    {
        return $this->db

        ->select('
            antrian.*,
            pasien.nama_pasien,
            dokter.nama_dokter
        ')

        ->from('antrian')

        ->join(
            'pasien',
            'pasien.id=antrian.pasien_id'
        )

        ->join(
            'dokter',
            'dokter.id=antrian.dokter_id'
        )

        ->order_by(
            'antrian.id',
            'DESC'
        )

        ->get()

        ->result();
    }

    public function simpan($data)
    {
        return $this->db->insert(
            'antrian',
            $data
        );
    }

    public function nomor_antrian()
    {
        $this->db->where(
            'tanggal',
            date('Y-m-d')
        );

        $jumlah = $this->db
            ->count_all_results('antrian');

        return $jumlah + 1;
    }
}