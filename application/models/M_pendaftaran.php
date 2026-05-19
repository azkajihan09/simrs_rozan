<?php

class M_pendaftaran extends CI_Model
{

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
            antrian.status as status_antrian,
            COALESCE(pendaftaran.no_reg_mlite, reg_periksa.no_reg) as no_reg_bridge,
            COALESCE(pendaftaran.no_rawat_mlite, reg_periksa.no_rawat) as no_rawat_bridge,
            COALESCE(pendaftaran.stts_mlite, reg_periksa.stts) as status_reg_bridge,
            COALESCE(pendaftaran.status_bayar_mlite, reg_periksa.status_bayar) as status_bayar_bridge
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

            ->join(
                'reg_periksa',
                'reg_periksa.no_rawat = pendaftaran.no_rawat_mlite',
                'left'
            )

            ->order_by('pendaftaran.id', 'DESC')

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
                poliklinik.nama_poli,
                COALESCE(pendaftaran.no_reg_mlite, reg_periksa.no_reg) as no_reg_bridge,
                COALESCE(pendaftaran.no_rawat_mlite, reg_periksa.no_rawat) as no_rawat_bridge,
                COALESCE(pendaftaran.stts_mlite, reg_periksa.stts) as status_reg_bridge,
                COALESCE(pendaftaran.status_bayar_mlite, reg_periksa.status_bayar) as status_bayar_bridge
            ')
            ->from('pendaftaran')
            ->join('pasien', 'pasien.id_pasien = pendaftaran.pasien_id', 'left')
            ->join('dokter', 'dokter.id = pendaftaran.dokter_id', 'left')
            ->join('poliklinik', 'poliklinik.id = pendaftaran.poli_id', 'left')
            ->join('reg_periksa', 'reg_periksa.no_rawat = pendaftaran.no_rawat_mlite', 'left')
            ->where('pendaftaran.id', $id)
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

        $this->db->where('tanggal', $today);

        $this->db->where('poli_id', $poli_id);

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

        $this->db->insert('pendaftaran', $data);

        $pendaftaran_id = $this->db->insert_id();

        $bridge = $this->_sync_reg_periksa_bridge($pendaftaran_id);

        /*
        |--------------------------------------------------------------------------
        | INSERT ANTRIAN
        |--------------------------------------------------------------------------
        */

        $antrian = [

            'kode_antrian' => 'A' . date('YmdHis'),

            'pasien_id' => $data['pasien_id'],

            'dokter_id' => $data['dokter_id'],

            'poliklinik_id' => $data['poli_id'],

            'poli_id' => $data['poli_id'],

            'tanggal' => $data['tanggal'],

            'nomor_antrian' => $data['no_antrian'],

            'urutan_harian' => $data['no_antrian'],

            'no_reg_mlite' => isset($bridge['no_reg_mlite']) ? $bridge['no_reg_mlite'] : NULL,

            'no_rawat_mlite' => isset($bridge['no_rawat_mlite']) ? $bridge['no_rawat_mlite'] : NULL,

            'jenis_antrian' => $data['jenis_pasien'],

            'status' => 'MENUNGGU'

        ];

        $this->db->insert('antrian', $antrian);



        /*
        |--------------------------------------------------------------------------
        | COMMIT
        |--------------------------------------------------------------------------
        */

        if ($this->db->trans_status() === FALSE) {

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

    public function update($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->update('pendaftaran', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        return $this->db
            ->where('id', $id)
            ->delete('pendaftaran');
    }

    private function _sync_reg_periksa_bridge($pendaftaran_id)
    {
        $pendaftaran = $this->db
            ->select('
                pendaftaran.*,
                pasien.nama_pasien,
                pasien.alamat,
                pasien.no_rkm_medis_mlite
            ')
            ->from('pendaftaran')
            ->join('pasien', 'pasien.id_pasien = pendaftaran.pasien_id', 'left')
            ->where('pendaftaran.id', $pendaftaran_id)
            ->get()
            ->row_array();

        if (empty($pendaftaran)) {
            return [];
        }

        $identifiers = $this->_build_bridge_identifiers($pendaftaran['id'], $pendaftaran['tanggal']);

        $update_data = [
            'no_reg_mlite' => $identifiers['no_reg_mlite'],
            'no_rawat_mlite' => $identifiers['no_rawat_mlite'],
            'no_rkm_medis_mlite' => ! empty($pendaftaran['no_rkm_medis_mlite']) ? $pendaftaran['no_rkm_medis_mlite'] : NULL,
            'status_bayar_mlite' => 'Belum Bayar',
            'stts_mlite' => 'Belum',
            'last_sync_mlite' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id', $pendaftaran_id)->update('pendaftaran', $update_data);

        if ($this->db->table_exists('reg_periksa')) {
            $reg_periksa = [
                'no_reg' => $identifiers['no_reg_mlite'],
                'no_rawat' => $identifiers['no_rawat_mlite'],
                'tgl_registrasi' => $pendaftaran['tanggal'],
                'jam_reg' => '00:00:00',
                'kd_dokter' => ! empty($pendaftaran['kd_dokter_mlite']) ? $pendaftaran['kd_dokter_mlite'] : NULL,
                'no_rkm_medis' => ! empty($pendaftaran['no_rkm_medis_mlite']) ? $pendaftaran['no_rkm_medis_mlite'] : NULL,
                'kd_poli' => ! empty($pendaftaran['kd_poli_mlite']) ? $pendaftaran['kd_poli_mlite'] : NULL,
                'p_jawab' => ! empty($pendaftaran['nama_pasien']) ? $pendaftaran['nama_pasien'] : '-',
                'almt_pj' => ! empty($pendaftaran['alamat']) ? $pendaftaran['alamat'] : '-',
                'hubunganpj' => 'DIRI SENDIRI',
                'biaya_reg' => 0,
                'stts' => 'Belum',
                'stts_daftar' => 'Lama',
                'status_lanjut' => 'Ralan',
                'kd_pj' => ! empty($pendaftaran['kd_pj_mlite']) ? $pendaftaran['kd_pj_mlite'] : NULL,
                'umurdaftar' => NULL,
                'sttsumur' => 'Th',
                'status_bayar' => 'Belum Bayar',
                'status_poli' => 'Baru'
            ];

            $exists = $this->db
                ->where('no_rawat', $identifiers['no_rawat_mlite'])
                ->get('reg_periksa')
                ->row_array();

            if ($exists) {
                $this->db
                    ->where('no_rawat', $identifiers['no_rawat_mlite'])
                    ->update('reg_periksa', $reg_periksa);
            } else {
                $this->db->insert('reg_periksa', $reg_periksa);
            }
        }

        return $update_data;
    }

    private function _build_bridge_identifiers($pendaftaran_id, $tanggal)
    {
        $sequence = $this->db
            ->where('tanggal', $tanggal)
            ->where('id <=', $pendaftaran_id)
            ->count_all_results('pendaftaran');

        $no_reg_mlite = str_pad($sequence, 6, '0', STR_PAD_LEFT);
        $no_rawat_mlite = date('Y/m/d/', strtotime($tanggal)) . $no_reg_mlite;

        return [
            'no_reg_mlite' => $no_reg_mlite,
            'no_rawat_mlite' => $no_rawat_mlite
        ];
    }
}
