USE `simrs_klinik_rozan`;

-- Generator bridge kunjungan mLITE dari tabel pendaftaran lama.
-- Aturan default yang dipakai di script ini:
-- 1. no_reg_mlite  = 6 digit urutan kunjungan per tanggal, berdasarkan id terkecil -> terbesar.
-- 2. no_rawat_mlite = YYYY/MM/DD/NNNNNN
--    Contoh: 2026/05/17/000001
-- Jika Anda ingin aturan lain, ubah ekspresi pembentukan no_reg_mlite/no_rawat_mlite di bagian UPDATE pendaftaran.

CREATE TABLE IF NOT EXISTS `reg_periksa` (
    `no_reg` VARCHAR(8) DEFAULT NULL,
    `no_rawat` VARCHAR(17) NOT NULL,
    `tgl_registrasi` DATE DEFAULT NULL,
    `jam_reg` TIME DEFAULT NULL,
    `kd_dokter` VARCHAR(20) DEFAULT NULL,
    `no_rkm_medis` VARCHAR(15) DEFAULT NULL,
    `kd_poli` CHAR(5) DEFAULT NULL,
    `p_jawab` VARCHAR(100) DEFAULT NULL,
    `almt_pj` VARCHAR(200) DEFAULT NULL,
    `hubunganpj` VARCHAR(20) DEFAULT NULL,
    `biaya_reg` DOUBLE DEFAULT 0,
    `stts` VARCHAR(30) DEFAULT NULL,
    `stts_daftar` VARCHAR(10) DEFAULT NULL,
    `status_lanjut` VARCHAR(10) DEFAULT 'Ralan',
    `kd_pj` CHAR(3) DEFAULT NULL,
    `umurdaftar` INT DEFAULT NULL,
    `sttsumur` VARCHAR(5) DEFAULT NULL,
    `status_bayar` VARCHAR(20) DEFAULT NULL,
    `status_poli` VARCHAR(10) DEFAULT 'Baru',
    PRIMARY KEY (`no_rawat`),
    KEY `idx_reg_periksa_no_reg` (`no_reg`),
    KEY `idx_reg_periksa_rm` (`no_rkm_medis`),
    KEY `idx_reg_periksa_dokter` (`kd_dokter`),
    KEY `idx_reg_periksa_poli` (`kd_poli`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

UPDATE `pendaftaran` p
JOIN (
    SELECT p1.`id`, COUNT(*) AS seq_per_tanggal
    FROM
        `pendaftaran` p1
        JOIN `pendaftaran` p2 ON p2.`tanggal` = p1.`tanggal`
        AND p2.`id` <= p1.`id`
    GROUP BY
        p1.`id`
) seq ON seq.`id` = p.`id`
SET
    p.`no_reg_mlite` = COALESCE(
        NULLIF(p.`no_reg_mlite`, ''),
        LPAD(seq.`seq_per_tanggal`, 6, '0')
    ),
    p.`no_rawat_mlite` = COALESCE(
        NULLIF(p.`no_rawat_mlite`, ''),
        CONCAT(
            DATE_FORMAT(p.`tanggal`, '%Y/%m/%d/'),
            LPAD(seq.`seq_per_tanggal`, 6, '0')
        )
    ),
    p.`last_sync_mlite` = NOW();

UPDATE `antrian` a
JOIN `pendaftaran` p ON p.`pasien_id` = a.`pasien_id`
AND p.`dokter_id` = a.`dokter_id`
AND p.`poli_id` = a.`poli_id`
AND p.`tanggal` = a.`tanggal`
AND CAST(
    COALESCE(p.`no_antrian`, '0') AS UNSIGNED
) = COALESCE(a.`nomor_antrian`, 0)
SET
    a.`no_reg_mlite` = p.`no_reg_mlite`,
    a.`no_rawat_mlite` = p.`no_rawat_mlite`,
    a.`last_sync_mlite` = NOW();

INSERT INTO
    `reg_periksa` (
        `no_reg`,
        `no_rawat`,
        `tgl_registrasi`,
        `jam_reg`,
        `kd_dokter`,
        `no_rkm_medis`,
        `kd_poli`,
        `p_jawab`,
        `almt_pj`,
        `hubunganpj`,
        `biaya_reg`,
        `stts`,
        `stts_daftar`,
        `status_lanjut`,
        `kd_pj`,
        `umurdaftar`,
        `sttsumur`,
        `status_bayar`,
        `status_poli`
    )
SELECT
    p.`no_reg_mlite`,
    p.`no_rawat_mlite`,
    p.`tanggal`,
    '00:00:00',
    p.`kd_dokter_mlite`,
    p.`no_rkm_medis_mlite`,
    p.`kd_poli_mlite`,
    ps.`nama_pasien`,
    ps.`alamat`,
    'DIRI SENDIRI',
    0,
    CASE p.`status`
        WHEN 'MENUNGGU' THEN 'Belum'
        WHEN 'DIPERIKSA' THEN 'Sudah'
        WHEN 'SELESAI' THEN 'Sudah'
        ELSE 'Belum'
    END,
    'Lama',
    'Ralan',
    p.`kd_pj_mlite`,
    NULL,
    'Th',
    COALESCE(
        p.`status_bayar_mlite`,
        'Belum Bayar'
    ),
    'Baru'
FROM `pendaftaran` p
    LEFT JOIN `pasien` ps ON ps.`id_pasien` = p.`pasien_id`
WHERE
    p.`no_rawat_mlite` IS NOT NULL
    AND p.`no_rawat_mlite` <> ''
ON DUPLICATE KEY UPDATE
    `no_reg` = VALUES(`no_reg`),
    `tgl_registrasi` = VALUES(`tgl_registrasi`),
    `kd_dokter` = VALUES(`kd_dokter`),
    `no_rkm_medis` = VALUES(`no_rkm_medis`),
    `kd_poli` = VALUES(`kd_poli`),
    `p_jawab` = VALUES(`p_jawab`),
    `almt_pj` = VALUES(`almt_pj`),
    `stts` = VALUES(`stts`),
    `kd_pj` = VALUES(`kd_pj`),
    `status_bayar` = VALUES(`status_bayar`),
    `status_poli` = VALUES(`status_poli`);

SELECT 'Kunjungan bridge mLITE generated.' AS message;

SELECT
    COUNT(*) AS total_pendaftaran,
    SUM(
        CASE
            WHEN `no_reg_mlite` IS NOT NULL
            AND `no_reg_mlite` <> '' THEN 1
            ELSE 0
        END
    ) AS mapped_no_reg,
    SUM(
        CASE
            WHEN `no_rawat_mlite` IS NOT NULL
            AND `no_rawat_mlite` <> '' THEN 1
            ELSE 0
        END
    ) AS mapped_no_rawat
FROM `pendaftaran`;

SELECT COUNT(*) AS total_reg_periksa_bridge FROM `reg_periksa`;