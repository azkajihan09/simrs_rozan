USE `simrs_klinik_rozan`;

-- Siapkan tabel lama agar bisa ditautkan ke skema mLITE tanpa memutus query aplikasi.
-- Script ini hanya menambah kolom mapping dan index bantu. Struktur lama tetap dipertahankan.

DROP PROCEDURE IF EXISTS add_column_if_missing;

DROP PROCEDURE IF EXISTS add_index_if_missing;

DELIMITER $$

CREATE PROCEDURE add_column_if_missing(
    IN p_table VARCHAR(64),
    IN p_column VARCHAR(64),
    IN p_definition TEXT
)
BEGIN
    IF NOT EXISTS (
        SELECT 1
        FROM information_schema.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME = p_table
          AND COLUMN_NAME = p_column
    ) THEN
        SET @sql = CONCAT(
            'ALTER TABLE `', p_table, '` ADD COLUMN `', p_column, '` ', p_definition
        );
        PREPARE stmt FROM @sql;
        EXECUTE stmt;
        DEALLOCATE PREPARE stmt;
    END IF;
END $$

CREATE PROCEDURE add_index_if_missing(
    IN p_table VARCHAR(64),
    IN p_index VARCHAR(64),
    IN p_definition TEXT
)
BEGIN
    IF NOT EXISTS (
        SELECT 1
        FROM information_schema.STATISTICS
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME = p_table
          AND INDEX_NAME = p_index
    ) THEN
        SET @sql = CONCAT(
            'ALTER TABLE `', p_table, '` ADD INDEX `', p_index, '` ', p_definition
        );
        PREPARE stmt FROM @sql;
        EXECUTE stmt;
        DEALLOCATE PREPARE stmt;
    END IF;
END $$

DELIMITER;

-- pasien -> mLITE pasien
CALL add_column_if_missing (
    'pasien',
    'no_rkm_medis_mlite',
    'VARCHAR(15) NULL AFTER `no_rm`'
);

CALL add_column_if_missing (
    'pasien',
    'kd_pj_mlite',
    'CHAR(3) NULL AFTER `no_bpjs`'
);

CALL add_column_if_missing (
    'pasien',
    'no_peserta_mlite',
    'VARCHAR(25) NULL AFTER `kd_pj_mlite`'
);

CALL add_column_if_missing (
    'pasien',
    'last_sync_mlite',
    'DATETIME NULL AFTER `created_at`'
);

CALL add_index_if_missing (
    'pasien',
    'idx_pasien_mlite_rm',
    '(`no_rkm_medis_mlite`)'
);

CALL add_index_if_missing (
    'pasien',
    'idx_pasien_mlite_pj',
    '(`kd_pj_mlite`)'
);

-- dokter -> mLITE dokter
CALL add_column_if_missing (
    'dokter',
    'kd_dokter_mlite',
    'VARCHAR(20) NULL AFTER `id`'
);

CALL add_column_if_missing (
    'dokter',
    'kd_poli_mlite',
    'CHAR(5) NULL AFTER `poli_id`'
);

CALL add_column_if_missing (
    'dokter',
    'last_sync_mlite',
    'DATETIME NULL AFTER `created_at`'
);

CALL add_index_if_missing (
    'dokter',
    'idx_dokter_mlite_kode',
    '(`kd_dokter_mlite`)'
);

CALL add_index_if_missing (
    'dokter',
    'idx_dokter_mlite_poli',
    '(`kd_poli_mlite`)'
);

-- poliklinik -> mLITE poliklinik
CALL add_column_if_missing (
    'poliklinik',
    'kd_poli_mlite',
    'CHAR(5) NULL AFTER `kode_poli`'
);

CALL add_column_if_missing (
    'poliklinik',
    'last_sync_mlite',
    'DATETIME NULL AFTER `keterangan`'
);

CALL add_index_if_missing (
    'poliklinik',
    'idx_poliklinik_mlite_kode',
    '(`kd_poli_mlite`)'
);

-- pendaftaran -> mLITE reg_periksa
CALL add_column_if_missing (
    'pendaftaran',
    'no_rawat_mlite',
    'VARCHAR(17) NULL AFTER `id`'
);

CALL add_column_if_missing (
    'pendaftaran',
    'no_reg_mlite',
    'VARCHAR(8) NULL AFTER `no_rawat_mlite`'
);

CALL add_column_if_missing (
    'pendaftaran',
    'no_rkm_medis_mlite',
    'VARCHAR(15) NULL AFTER `pasien_id`'
);

CALL add_column_if_missing (
    'pendaftaran',
    'kd_dokter_mlite',
    'VARCHAR(20) NULL AFTER `dokter_id`'
);

CALL add_column_if_missing (
    'pendaftaran',
    'kd_poli_mlite',
    'CHAR(5) NULL AFTER `poli_id`'
);

CALL add_column_if_missing (
    'pendaftaran',
    'kd_pj_mlite',
    'CHAR(3) NULL AFTER `jenis_pasien`'
);

CALL add_column_if_missing (
    'pendaftaran',
    'status_bayar_mlite',
    'VARCHAR(20) NULL AFTER `status`'
);

CALL add_column_if_missing (
    'pendaftaran',
    'stts_mlite',
    'VARCHAR(30) NULL AFTER `status_bayar_mlite`'
);

CALL add_column_if_missing (
    'pendaftaran',
    'last_sync_mlite',
    'DATETIME NULL AFTER `created_at`'
);

CALL add_index_if_missing (
    'pendaftaran',
    'idx_pendaftaran_mlite_rawat',
    '(`no_rawat_mlite`)'
);

CALL add_index_if_missing (
    'pendaftaran',
    'idx_pendaftaran_mlite_rm',
    '(`no_rkm_medis_mlite`)'
);

CALL add_index_if_missing (
    'pendaftaran',
    'idx_pendaftaran_mlite_dokter',
    '(`kd_dokter_mlite`)'
);

-- antrian -> referensi kunjungan mLITE
CALL add_column_if_missing (
    'antrian',
    'no_rawat_mlite',
    'VARCHAR(17) NULL AFTER `kode_antrian`'
);

CALL add_column_if_missing (
    'antrian',
    'no_reg_mlite',
    'VARCHAR(8) NULL AFTER `no_rawat_mlite`'
);

CALL add_column_if_missing (
    'antrian',
    'task_id_mlite',
    'VARCHAR(30) NULL AFTER `jenis_layanan`'
);

CALL add_column_if_missing (
    'antrian',
    'last_sync_mlite',
    'DATETIME NULL AFTER `created_at`'
);

CALL add_index_if_missing (
    'antrian',
    'idx_antrian_mlite_rawat',
    '(`no_rawat_mlite`)'
);

CALL add_index_if_missing (
    'antrian',
    'idx_antrian_mlite_reg',
    '(`no_reg_mlite`)'
);

-- resep -> mLITE resep_obat
CALL add_column_if_missing (
    'resep',
    'no_resep_mlite',
    'VARCHAR(14) NULL AFTER `kode_resep`'
);

CALL add_column_if_missing (
    'resep',
    'no_rawat_mlite',
    'VARCHAR(17) NULL AFTER `rekam_medis_id`'
);

CALL add_column_if_missing (
    'resep',
    'kd_dokter_mlite',
    'VARCHAR(20) NULL AFTER `dokter_id`'
);

CALL add_column_if_missing (
    'resep',
    'status_resep_mlite',
    'VARCHAR(20) NULL AFTER `status`'
);

CALL add_column_if_missing (
    'resep',
    'last_sync_mlite',
    'DATETIME NULL AFTER `created_at`'
);

CALL add_index_if_missing (
    'resep',
    'idx_resep_mlite_no_resep',
    '(`no_resep_mlite`)'
);

CALL add_index_if_missing (
    'resep',
    'idx_resep_mlite_no_rawat',
    '(`no_rawat_mlite`)'
);

-- resep_detail -> mLITE resep_dokter / detail item
CALL add_column_if_missing (
    'resep_detail',
    'no_resep_mlite',
    'VARCHAR(14) NULL AFTER `resep_id`'
);

CALL add_column_if_missing (
    'resep_detail',
    'kode_brng_mlite',
    'VARCHAR(15) NULL AFTER `obat_id`'
);

CALL add_column_if_missing (
    'resep_detail',
    'last_sync_mlite',
    'DATETIME NULL AFTER `subtotal`'
);

CALL add_index_if_missing (
    'resep_detail',
    'idx_resep_detail_mlite_resep',
    '(`no_resep_mlite`)'
);

CALL add_index_if_missing (
    'resep_detail',
    'idx_resep_detail_mlite_barang',
    '(`kode_brng_mlite`)'
);

-- obat -> mLITE databarang
CALL add_column_if_missing (
    'obat',
    'kode_brng_mlite',
    'VARCHAR(15) NULL AFTER `kode_obat`'
);

CALL add_column_if_missing (
    'obat',
    'kode_sat_mlite',
    'CHAR(4) NULL AFTER `satuan`'
);

CALL add_column_if_missing (
    'obat',
    'last_sync_mlite',
    'DATETIME NULL AFTER `created_at`'
);

CALL add_index_if_missing (
    'obat',
    'idx_obat_mlite_kode',
    '(`kode_brng_mlite`)'
);

-- coa -> mLITE rekening
CALL add_column_if_missing (
    'coa',
    'kd_rek_mlite',
    'VARCHAR(15) NULL AFTER `kode_akun`'
);

CALL add_column_if_missing (
    'coa',
    'tipe_mlite',
    'ENUM(''N'',''M'',''R'') NULL AFTER `tipe`'
);

CALL add_column_if_missing (
    'coa',
    'balance_mlite',
    'ENUM(''D'',''K'') NULL AFTER `tipe_mlite`'
);

CALL add_index_if_missing (
    'coa',
    'idx_coa_mlite_kd_rek',
    '(`kd_rek_mlite`)'
);

-- jurnal -> mLITE jurnal
CALL add_column_if_missing (
    'jurnal',
    'no_jurnal_mlite',
    'VARCHAR(20) NULL AFTER `id`'
);

CALL add_column_if_missing (
    'jurnal',
    'no_bukti_mlite',
    'VARCHAR(20) NULL AFTER `no_jurnal_mlite`'
);

CALL add_column_if_missing (
    'jurnal',
    'jenis_mlite',
    'ENUM(''U'',''P'') NULL AFTER `tanggal`'
);

CALL add_column_if_missing (
    'jurnal',
    'last_sync_mlite',
    'DATETIME NULL AFTER `created_at`'
);

CALL add_index_if_missing (
    'jurnal',
    'idx_jurnal_mlite_no_jurnal',
    '(`no_jurnal_mlite`)'
);

-- jurnal_detail -> mLITE detail jurnal
CALL add_column_if_missing (
    'jurnal_detail',
    'no_jurnal_mlite',
    'VARCHAR(20) NULL AFTER `jurnal_id`'
);

CALL add_column_if_missing (
    'jurnal_detail',
    'kd_rek_mlite',
    'VARCHAR(15) NULL AFTER `coa_id`'
);

CALL add_column_if_missing (
    'jurnal_detail',
    'arus_kas_mlite',
    'INT NOT NULL DEFAULT 0 AFTER `kd_rek_mlite`'
);

CALL add_column_if_missing (
    'jurnal_detail',
    'last_sync_mlite',
    'DATETIME NULL AFTER `created_at`'
);

CALL add_index_if_missing (
    'jurnal_detail',
    'idx_jurnal_detail_mlite_jurnal',
    '(`no_jurnal_mlite`)'
);

CALL add_index_if_missing (
    'jurnal_detail',
    'idx_jurnal_detail_mlite_rek',
    '(`kd_rek_mlite`)'
);

DROP PROCEDURE IF EXISTS add_column_if_missing;

DROP PROCEDURE IF EXISTS add_index_if_missing;

SELECT 'Legacy schema is ready for mLITE mapping.' AS message;