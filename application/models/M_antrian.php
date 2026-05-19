<?php

class M_antrian extends CI_Model
{

    public function get_all()
    {
        return $this->db

            ->select('
            antrian.*,
            pasien.nama_pasien,
            dokter.nama_dokter,
            poliklinik.nama_poli,
            COALESCE(antrian.no_reg_mlite, reg_periksa.no_reg) as no_reg_bridge,
            COALESCE(antrian.no_rawat_mlite, reg_periksa.no_rawat) as no_rawat_bridge
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

            ->join(
                'reg_periksa',
                'reg_periksa.no_rawat = antrian.no_rawat_mlite',
                'left'
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

    public function detail($id)
    {
        return $this->db
            ->select('
                antrian.*,
                pasien.nama_pasien,
                pasien.no_rm,
                dokter.nama_dokter,
                poliklinik.nama_poli,
                COALESCE(antrian.no_reg_mlite, reg_periksa.no_reg) as no_reg_bridge,
                COALESCE(antrian.no_rawat_mlite, reg_periksa.no_rawat) as no_rawat_bridge
            ')
            ->from('antrian')
            ->join('pasien', 'pasien.id_pasien = antrian.pasien_id', 'left')
            ->join('dokter', 'dokter.id = antrian.dokter_id', 'left')
            ->join('poliklinik', 'poliklinik.id = antrian.poli_id', 'left')
            ->join('reg_periksa', 'reg_periksa.no_rawat = antrian.no_rawat_mlite', 'left')
            ->where('antrian.id', $id)
            ->get()
            ->row();
    }
}
