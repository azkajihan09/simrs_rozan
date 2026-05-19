USE `simrs_klinik_rozan`;

-- Mapping manual dokter ke kode dokter mLITE.
-- Alur pakai:
-- 1. Jalankan script ini untuk membuat/refresh tabel staging mapping.
-- 2. Isi kolom kd_dokter_mlite dan ubah status_verifikasi menjadi VALID pada tabel mlite_manual_map_dokter.
-- 3. Jalankan script ini lagi untuk menerapkan mapping ke tabel dokter, pendaftaran, dan resep.

CREATE TABLE IF NOT EXISTS `mlite_manual_map_dokter` (
    `legacy_dokter_id` INT NOT NULL,
    `nama_dokter` VARCHAR(150) NOT NULL,
    `sip` VARCHAR(100) NULL,
    `str_dokter` VARCHAR(100) NULL,
    `legacy_poli_id` INT NULL,
    `kd_poli_mlite` CHAR(5) NULL,
    `kd_dokter_mlite` VARCHAR(20) NULL,
    `status_verifikasi` ENUM('PENDING', 'VALID', 'SKIP') NOT NULL DEFAULT 'PENDING',
    `catatan` VARCHAR(255) NULL,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`legacy_dokter_id`),
    UNIQUE KEY `uk_manual_map_dokter_mlite` (`kd_dokter_mlite`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
    `mlite_manual_map_dokter` (
        `legacy_dokter_id`,
        `nama_dokter`,
        `sip`,
        `str_dokter`,
        `legacy_poli_id`,
        `kd_poli_mlite`,
        `kd_dokter_mlite`,
        `status_verifikasi`,
        `catatan`
    )
SELECT
    d.`id`,
    d.`nama_dokter`,
    d.`sip`,
    d.`str_dokter`,
    d.`poli_id`,
    d.`kd_poli_mlite`,
    d.`kd_dokter_mlite`,
    CASE
        WHEN d.`kd_dokter_mlite` IS NOT NULL
        AND d.`kd_dokter_mlite` <> '' THEN 'VALID'
        ELSE 'PENDING'
    END,
    NULL
FROM `dokter` d
ON DUPLICATE KEY UPDATE
    `nama_dokter` = VALUES(`nama_dokter`),
    `sip` = VALUES(`sip`),
    `str_dokter` = VALUES(`str_dokter`),
    `legacy_poli_id` = VALUES(`legacy_poli_id`),
    `kd_poli_mlite` = VALUES(`kd_poli_mlite`),
    `kd_dokter_mlite` = COALESCE(
        NULLIF(
            `mlite_manual_map_dokter`.`kd_dokter_mlite`,
            ''
        ),
        VALUES (`kd_dokter_mlite`)
    ),
    `status_verifikasi` = CASE
        WHEN `mlite_manual_map_dokter`.`status_verifikasi` = 'SKIP' THEN 'SKIP'
        WHEN COALESCE(
            NULLIF(
                `mlite_manual_map_dokter`.`kd_dokter_mlite`,
                ''
            ),
            VALUES (`kd_dokter_mlite`)
        ) IS NOT NULL THEN 'VALID'
        ELSE 'PENDING'
    END;

-- Terapkan mapping yang sudah diverifikasi.
UPDATE `dokter` d
JOIN `mlite_manual_map_dokter` m ON m.`legacy_dokter_id` = d.`id`
SET
    d.`kd_dokter_mlite` = m.`kd_dokter_mlite`,
    d.`kd_poli_mlite` = COALESCE(
        NULLIF(m.`kd_poli_mlite`, ''),
        d.`kd_poli_mlite`
    ),
    d.`last_sync_mlite` = NOW()
WHERE
    m.`status_verifikasi` = 'VALID'
    AND m.`kd_dokter_mlite` IS NOT NULL
    AND m.`kd_dokter_mlite` <> '';

UPDATE `pendaftaran` p
JOIN `dokter` d ON d.`id` = p.`dokter_id`
SET
    p.`kd_dokter_mlite` = d.`kd_dokter_mlite`,
    p.`last_sync_mlite` = NOW()
WHERE
    d.`kd_dokter_mlite` IS NOT NULL
    AND d.`kd_dokter_mlite` <> '';

UPDATE `resep` r
JOIN `dokter` d ON d.`id` = r.`dokter_id`
SET
    r.`kd_dokter_mlite` = d.`kd_dokter_mlite`,
    r.`last_sync_mlite` = NOW()
WHERE
    d.`kd_dokter_mlite` IS NOT NULL
    AND d.`kd_dokter_mlite` <> '';

SELECT 'Manual doctor mapping staging is ready.' AS message;

SELECT
    `legacy_dokter_id`,
    `nama_dokter`,
    `sip`,
    `str_dokter`,
    `kd_poli_mlite`,
    `kd_dokter_mlite`,
    `status_verifikasi`,
    `catatan`
FROM `mlite_manual_map_dokter`
ORDER BY
    `status_verifikasi`,
    `nama_dokter`;