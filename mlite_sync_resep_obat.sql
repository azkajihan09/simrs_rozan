USE `simrs_klinik_rozan`;

-- Sinkron transaksi resep dan obat ke struktur bridge mLITE.
-- Prasyarat:
-- 1. mlite_manual_mapping_dokter.sql sudah dijalankan dan kd_dokter_mlite dokter yang valid sudah terisi.
-- 2. mlite_generate_no_rawat_bridge.sql sudah dijalankan agar reg_periksa dan no_rawat_mlite tersedia.

CREATE TABLE IF NOT EXISTS `databarang` (
    `kode_brng` VARCHAR(15) NOT NULL,
    `nama_brng` VARCHAR(150) DEFAULT NULL,
    `kode_sat` CHAR(4) DEFAULT NULL,
    `stok` DOUBLE DEFAULT 0,
    `stokminimal` DOUBLE DEFAULT 0,
    `h_beli` DOUBLE DEFAULT 0,
    `ralan` DOUBLE DEFAULT 0,
    `status` VARCHAR(1) DEFAULT '1',
    PRIMARY KEY (`kode_brng`),
    KEY `idx_databarang_nama` (`nama_brng`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE IF NOT EXISTS `resep_obat` (
    `no_resep` VARCHAR(14) NOT NULL,
    `tgl_perawatan` DATE DEFAULT NULL,
    `jam` TIME NOT NULL DEFAULT '00:00:00',
    `no_rawat` VARCHAR(17) NOT NULL,
    `kd_dokter` VARCHAR(20) DEFAULT NULL,
    `tgl_peresepan` DATE DEFAULT NULL,
    `jam_peresepan` TIME DEFAULT NULL,
    `status` ENUM('ralan', 'ranap') DEFAULT 'ralan',
    `tgl_penyerahan` DATE NOT NULL DEFAULT '0000-00-00',
    `jam_penyerahan` TIME NOT NULL DEFAULT '00:00:00',
    PRIMARY KEY (`no_resep`),
    KEY `idx_resep_obat_rawat` (`no_rawat`),
    KEY `idx_resep_obat_dokter` (`kd_dokter`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE IF NOT EXISTS `resep_dokter` (
    `no_resep` VARCHAR(14) DEFAULT NULL,
    `kode_brng` VARCHAR(15) DEFAULT NULL,
    `jml` DOUBLE DEFAULT NULL,
    `aturan_pakai` VARCHAR(150) DEFAULT NULL,
    KEY `idx_resep_dokter_resep` (`no_resep`),
    KEY `idx_resep_dokter_barang` (`kode_brng`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Mapping obat lokal ke kode barang mLITE bridge.
UPDATE `obat`
SET
    `kode_brng_mlite` = COALESCE(
        NULLIF(`kode_brng_mlite`, ''),
        NULLIF(TRIM(`kode_obat`), ''),
        CONCAT('B', LPAD(`id`, 5, '0'))
    ),
    `kode_sat_mlite` = COALESCE(
        NULLIF(`kode_sat_mlite`, ''),
        CASE
            WHEN `satuan` IS NULL
            OR TRIM(`satuan`) = '' THEN NULL
            ELSE UPPER(
                LEFT(
                    REPLACE (TRIM(`satuan`), ' ', ''),
                        4
                )
            )
        END
    ),
    `last_sync_mlite` = NOW()
WHERE
    `kode_brng_mlite` IS NULL
    OR `kode_brng_mlite` = ''
    OR `kode_sat_mlite` IS NULL
    OR `kode_sat_mlite` = '';

INSERT INTO
    `databarang` (
        `kode_brng`,
        `nama_brng`,
        `kode_sat`,
        `stok`,
        `stokminimal`,
        `h_beli`,
        `ralan`,
        `status`
    )
SELECT o.`kode_brng_mlite`, o.`nama_obat`, o.`kode_sat_mlite`, COALESCE(o.`stok`, 0), COALESCE(o.`stok_minimal`, 0), COALESCE(o.`harga_beli`, 0), COALESCE(o.`harga_jual`, 0), '1'
FROM `obat` o
WHERE
    o.`kode_brng_mlite` IS NOT NULL
    AND o.`kode_brng_mlite` <> ''
ON DUPLICATE KEY UPDATE
    `nama_brng` = VALUES(`nama_brng`),
    `kode_sat` = VALUES(`kode_sat`),
    `stok` = VALUES(`stok`),
    `stokminimal` = VALUES(`stokminimal`),
    `h_beli` = VALUES(`h_beli`),
    `ralan` = VALUES(`ralan`),
    `status` = VALUES(`status`);

-- Bentuk nomor resep bridge dan tautkan no_rawat dari pendaftaran yang sehari/pasien/dokter.
UPDATE `resep` r
LEFT JOIN `pendaftaran` p ON p.`pasien_id` = r.`pasien_id`
AND p.`dokter_id` = r.`dokter_id`
AND p.`tanggal` = DATE(r.`tanggal`)
SET
    r.`no_resep_mlite` = COALESCE(
        NULLIF(r.`no_resep_mlite`, ''),
        CASE
            WHEN r.`kode_resep` IS NOT NULL
            AND CHAR_LENGTH(TRIM(r.`kode_resep`)) <= 14 THEN TRIM(r.`kode_resep`)
            ELSE CONCAT(
                'RSP',
                DATE_FORMAT(r.`tanggal`, '%y%m%d'),
                LPAD(r.`id`, 4, '0')
            )
        END
    ),
    r.`no_rawat_mlite` = COALESCE(
        NULLIF(r.`no_rawat_mlite`, ''),
        p.`no_rawat_mlite`
    ),
    r.`kd_dokter_mlite` = COALESCE(
        NULLIF(r.`kd_dokter_mlite`, ''),
        p.`kd_dokter_mlite`
    ),
    r.`status_resep_mlite` = COALESCE(
        NULLIF(r.`status_resep_mlite`, ''),
        'ralan'
    ),
    r.`last_sync_mlite` = NOW();

UPDATE `resep_detail` rd
JOIN `resep` r ON r.`id` = rd.`resep_id`
JOIN `obat` o ON o.`id` = rd.`obat_id`
SET
    rd.`no_resep_mlite` = r.`no_resep_mlite`,
    rd.`kode_brng_mlite` = o.`kode_brng_mlite`,
    rd.`last_sync_mlite` = NOW()
WHERE (
        rd.`no_resep_mlite` IS NULL
        OR rd.`no_resep_mlite` = ''
    )
    OR (
        rd.`kode_brng_mlite` IS NULL
        OR rd.`kode_brng_mlite` = ''
    );

INSERT INTO
    `resep_obat` (
        `no_resep`,
        `tgl_perawatan`,
        `jam`,
        `no_rawat`,
        `kd_dokter`,
        `tgl_peresepan`,
        `jam_peresepan`,
        `status`,
        `tgl_penyerahan`,
        `jam_penyerahan`
    )
SELECT r.`no_resep_mlite`, DATE(r.`tanggal`), TIME(r.`tanggal`), r.`no_rawat_mlite`, r.`kd_dokter_mlite`, DATE(r.`tanggal`), TIME(r.`tanggal`), COALESCE(
        r.`status_resep_mlite`, 'ralan'
    ), DATE(r.`tanggal`), TIME(r.`tanggal`)
FROM `resep` r
WHERE
    r.`no_resep_mlite` IS NOT NULL
    AND r.`no_resep_mlite` <> ''
    AND r.`no_rawat_mlite` IS NOT NULL
    AND r.`no_rawat_mlite` <> ''
    AND r.`kd_dokter_mlite` IS NOT NULL
    AND r.`kd_dokter_mlite` <> ''
ON DUPLICATE KEY UPDATE
    `tgl_perawatan` = VALUES(`tgl_perawatan`),
    `jam` = VALUES(`jam`),
    `no_rawat` = VALUES(`no_rawat`),
    `kd_dokter` = VALUES(`kd_dokter`),
    `tgl_peresepan` = VALUES(`tgl_peresepan`),
    `jam_peresepan` = VALUES(`jam_peresepan`),
    `status` = VALUES(`status`),
    `tgl_penyerahan` = VALUES(`tgl_penyerahan`),
    `jam_penyerahan` = VALUES(`jam_penyerahan`);

DELETE rdg
FROM `resep_dokter` rdg
    JOIN `resep` r ON r.`no_resep_mlite` = rdg.`no_resep`;

INSERT INTO
    `resep_dokter` (
        `no_resep`,
        `kode_brng`,
        `jml`,
        `aturan_pakai`
    )
SELECT rd.`no_resep_mlite`, rd.`kode_brng_mlite`, COALESCE(rd.`qty`, 0), rd.`aturan_pakai`
FROM `resep_detail` rd
    JOIN `resep` r ON r.`id` = rd.`resep_id`
WHERE
    rd.`no_resep_mlite` IS NOT NULL
    AND rd.`no_resep_mlite` <> ''
    AND rd.`kode_brng_mlite` IS NOT NULL
    AND rd.`kode_brng_mlite` <> ''
    AND r.`kd_dokter_mlite` IS NOT NULL
    AND r.`kd_dokter_mlite` <> ''
    AND r.`no_rawat_mlite` IS NOT NULL
    AND r.`no_rawat_mlite` <> '';

SELECT 'Resep dan obat bridge mLITE synced.' AS message;

SELECT COUNT(*) AS total_obat, SUM(
        CASE
            WHEN `kode_brng_mlite` IS NOT NULL
            AND `kode_brng_mlite` <> '' THEN 1
            ELSE 0
        END
    ) AS obat_mapped
FROM `obat`;

SELECT
    COUNT(*) AS total_resep,
    SUM(
        CASE
            WHEN `no_resep_mlite` IS NOT NULL
            AND `no_resep_mlite` <> '' THEN 1
            ELSE 0
        END
    ) AS resep_mapped,
    SUM(
        CASE
            WHEN `no_rawat_mlite` IS NOT NULL
            AND `no_rawat_mlite` <> '' THEN 1
            ELSE 0
        END
    ) AS resep_linked_kunjungan,
    SUM(
        CASE
            WHEN `kd_dokter_mlite` IS NOT NULL
            AND `kd_dokter_mlite` <> '' THEN 1
            ELSE 0
        END
    ) AS resep_linked_dokter
FROM `resep`;

SELECT COUNT(*) AS total_databarang_bridge FROM `databarang`;

SELECT COUNT(*) AS total_resep_obat_bridge FROM `resep_obat`;

SELECT COUNT(*) AS total_resep_dokter_bridge FROM `resep_dokter`;