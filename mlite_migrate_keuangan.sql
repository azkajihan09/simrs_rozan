USE `simrs_klinik_rozan`;

-- Migrasi awal modul keuangan dari tabel lama:
-- coa -> mlite_rekening
-- jurnal -> mlite_jurnal
-- jurnal_detail -> mlite_detailjurnal
--
-- Aman dijalankan setelah `mlite_prepare_legacy_schema.sql`.
-- Script ini membuat tabel mLITE minimal jika belum ada, mengisi kolom mapping,
-- lalu memindahkan data ke tabel target mLITE.

CREATE TABLE IF NOT EXISTS `mlite_rekening` (
    `kd_rek` varchar(15) NOT NULL DEFAULT '',
    `nm_rek` varchar(100) DEFAULT NULL,
    `tipe` enum('N', 'M', 'R') DEFAULT NULL,
    `balance` enum('D', 'K') DEFAULT NULL,
    `level` enum('0', '1') DEFAULT '1',
    PRIMARY KEY (`kd_rek`),
    KEY `nm_rek` (`nm_rek`),
    KEY `tipe` (`tipe`),
    KEY `balance` (`balance`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE IF NOT EXISTS `mlite_jurnal` (
    `no_jurnal` varchar(20) NOT NULL,
    `no_bukti` varchar(20) DEFAULT NULL,
    `tgl_jurnal` date DEFAULT NULL,
    `jenis` enum('U', 'P') DEFAULT NULL,
    `kegiatan` varchar(250) NOT NULL,
    `keterangan` varchar(350) DEFAULT NULL,
    PRIMARY KEY (`no_jurnal`),
    KEY `no_bukti` (`no_bukti`),
    KEY `tgl_jurnal` (`tgl_jurnal`),
    KEY `jenis` (`jenis`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE IF NOT EXISTS `mlite_detailjurnal` (
    `no_jurnal` varchar(20) DEFAULT NULL,
    `kd_rek` varchar(15) DEFAULT NULL,
    `arus_kas` int NOT NULL DEFAULT 0,
    `debet` double NOT NULL DEFAULT 0,
    `kredit` double NOT NULL DEFAULT 0,
    KEY `no_jurnal` (`no_jurnal`),
    KEY `kd_rek` (`kd_rek`),
    KEY `debet` (`debet`),
    KEY `kredit` (`kredit`),
    CONSTRAINT `mlite_detailjurnal_ibfk_1` FOREIGN KEY (`no_jurnal`) REFERENCES `mlite_jurnal` (`no_jurnal`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `mlite_detailjurnal_ibfk_2` FOREIGN KEY (`kd_rek`) REFERENCES `mlite_rekening` (`kd_rek`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Isi mapping akun lama ke rekening mLITE.
UPDATE `coa`
SET
    `kd_rek_mlite` = COALESCE(
        NULLIF(`kd_rek_mlite`, ''),
        NULLIF(`kode_akun`, ''),
        CONCAT('OLD', LPAD(`id`, 4, '0'))
    ),
    `tipe_mlite` = CASE `tipe`
        WHEN 'ASET' THEN 'N'
        WHEN 'KEWAJIBAN' THEN 'N'
        WHEN 'MODAL' THEN 'M'
        WHEN 'PENDAPATAN' THEN 'R'
        WHEN 'BEBAN' THEN 'R'
        ELSE NULL
    END,
    `balance_mlite` = CASE `tipe`
        WHEN 'ASET' THEN 'D'
        WHEN 'KEWAJIBAN' THEN 'K'
        WHEN 'MODAL' THEN 'K'
        WHEN 'PENDAPATAN' THEN 'K'
        WHEN 'BEBAN' THEN 'D'
        ELSE NULL
    END
WHERE
    `kd_rek_mlite` IS NULL
    OR `kd_rek_mlite` = ''
    OR `tipe_mlite` IS NULL
    OR `balance_mlite` IS NULL;

-- Isi mapping jurnal lama ke jurnal mLITE.
UPDATE `jurnal`
SET
    `no_jurnal_mlite` = COALESCE(
        NULLIF(`no_jurnal_mlite`, ''),
        CONCAT('JU-LGC-', LPAD(`id`, 6, '0'))
    ),
    `no_bukti_mlite` = COALESCE(
        NULLIF(`no_bukti_mlite`, ''),
        CONCAT(
            'BKT-LGC-',
            LPAD(`id`, 6, '0')
        )
    ),
    `jenis_mlite` = COALESCE(`jenis_mlite`, 'U')
WHERE
    `no_jurnal_mlite` IS NULL
    OR `no_jurnal_mlite` = ''
    OR `no_bukti_mlite` IS NULL
    OR `no_bukti_mlite` = ''
    OR `jenis_mlite` IS NULL;

-- Isi mapping detail jurnal lama.
UPDATE `jurnal_detail` jd
JOIN `jurnal` j ON j.`id` = jd.`jurnal_id`
JOIN `coa` c ON c.`id` = jd.`coa_id`
SET
    jd.`no_jurnal_mlite` = j.`no_jurnal_mlite`,
    jd.`kd_rek_mlite` = c.`kd_rek_mlite`,
    jd.`arus_kas_mlite` = COALESCE(jd.`arus_kas_mlite`, 0)
WHERE
    jd.`no_jurnal_mlite` IS NULL
    OR jd.`no_jurnal_mlite` = ''
    OR jd.`kd_rek_mlite` IS NULL
    OR jd.`kd_rek_mlite` = '';

-- Sinkron rekening.
INSERT INTO
    `mlite_rekening` (
        `kd_rek`,
        `nm_rek`,
        `tipe`,
        `balance`,
        `level`
    )
SELECT c.`kd_rek_mlite`, c.`nama_akun`, c.`tipe_mlite`, c.`balance_mlite`, '1'
FROM `coa` c
WHERE
    c.`kd_rek_mlite` IS NOT NULL
    AND c.`kd_rek_mlite` <> ''
ON DUPLICATE KEY UPDATE
    `nm_rek` = VALUES(`nm_rek`),
    `tipe` = VALUES(`tipe`),
    `balance` = VALUES(`balance`),
    `level` = VALUES(`level`);

-- Sinkron header jurnal.
INSERT INTO
    `mlite_jurnal` (
        `no_jurnal`,
        `no_bukti`,
        `tgl_jurnal`,
        `jenis`,
        `kegiatan`,
        `keterangan`
    )
SELECT j.`no_jurnal_mlite`, j.`no_bukti_mlite`, DATE(
        COALESCE(j.`tanggal`, j.`created_at`)
    ), COALESCE(j.`jenis_mlite`, 'U'), LEFT(
        COALESCE(
            NULLIF(j.`keterangan`, ''), CONCAT(
                'Migrasi jurnal lama #', j.`id`
            )
        ), 250
    ), LEFT(j.`keterangan`, 350)
FROM `jurnal` j
WHERE
    j.`no_jurnal_mlite` IS NOT NULL
    AND j.`no_jurnal_mlite` <> ''
ON DUPLICATE KEY UPDATE
    `no_bukti` = VALUES(`no_bukti`),
    `tgl_jurnal` = VALUES(`tgl_jurnal`),
    `jenis` = VALUES(`jenis`),
    `kegiatan` = VALUES(`kegiatan`),
    `keterangan` = VALUES(`keterangan`);

-- Hapus detail target untuk jurnal yang akan dimigrasikan ulang agar script aman direrun.
DELETE md
FROM
    `mlite_detailjurnal` md
    JOIN `jurnal` j ON j.`no_jurnal_mlite` = md.`no_jurnal`;

-- Sinkron detail jurnal.
INSERT INTO
    `mlite_detailjurnal` (
        `no_jurnal`,
        `kd_rek`,
        `arus_kas`,
        `debet`,
        `kredit`
    )
SELECT jd.`no_jurnal_mlite`, jd.`kd_rek_mlite`, COALESCE(jd.`arus_kas_mlite`, 0), COALESCE(jd.`debit`, 0), COALESCE(jd.`kredit`, 0)
FROM `jurnal_detail` jd
WHERE
    jd.`no_jurnal_mlite` IS NOT NULL
    AND jd.`no_jurnal_mlite` <> ''
    AND jd.`kd_rek_mlite` IS NOT NULL
    AND jd.`kd_rek_mlite` <> '';

-- Tandai sinkronisasi pada tabel lama.
UPDATE `jurnal` SET `last_sync_mlite` = NOW();

UPDATE `jurnal_detail`
SET
    `last_sync_mlite` = NOW()
WHERE
    `no_jurnal_mlite` IS NOT NULL
    AND `no_jurnal_mlite` <> '';

SELECT 'Migrasi awal modul keuangan ke mLITE selesai.' AS message;

SELECT COUNT(*) AS total_rekening_mlite FROM `mlite_rekening`;

SELECT COUNT(*) AS total_jurnal_mlite FROM `mlite_jurnal`;

SELECT COUNT(*) AS total_detailjurnal_mlite
FROM `mlite_detailjurnal`;