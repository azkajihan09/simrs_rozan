USE `simrs_klinik_rozan`;

-- Bootstrap mapping master tanpa mengubah kode aplikasi.
-- Catatan penting:
-- 1. Database aktif belum memiliki tabel master mLITE untuk pasien/dokter/poliklinik.
-- 2. Script ini hanya mengisi mapping yang aman berdasarkan business key lokal.
-- 3. Untuk dokter, kd_dokter_mlite tidak diisi otomatis jika tidak ada sumber kode yang valid.

START TRANSACTION;

-- Pasien: mapping aman dari nomor RM dan nomor peserta.
UPDATE `pasien`
SET
    `no_rkm_medis_mlite` = CASE
        WHEN `no_rkm_medis_mlite` IS NULL
        OR `no_rkm_medis_mlite` = '' THEN NULLIF(TRIM(`no_rm`), '')
        ELSE `no_rkm_medis_mlite`
    END,
    `no_peserta_mlite` = CASE
        WHEN `no_peserta_mlite` IS NULL
        OR `no_peserta_mlite` = '' THEN NULLIF(TRIM(`no_bpjs`), '')
        ELSE `no_peserta_mlite`
    END,
    `last_sync_mlite` = NOW();

-- Poliklinik: mapping aman dari kode poli lokal.
UPDATE `poliklinik`
SET
    `kd_poli_mlite` = CASE
        WHEN (
            `kd_poli_mlite` IS NULL
            OR `kd_poli_mlite` = ''
        )
        AND `kode_poli` IS NOT NULL
        AND TRIM(`kode_poli`) <> '' THEN UPPER(TRIM(`kode_poli`))
        ELSE `kd_poli_mlite`
    END,
    `last_sync_mlite` = NOW();

-- Dokter: isi kd_poli_mlite dari mapping poli. Jangan isi kd_dokter_mlite dengan kode palsu.
UPDATE `dokter` d
LEFT JOIN `poliklinik` p ON p.`id` = d.`poli_id`
SET
    d.`kd_poli_mlite` = COALESCE(
        NULLIF(d.`kd_poli_mlite`, ''),
        p.`kd_poli_mlite`
    ),
    d.`last_sync_mlite` = NOW();

-- Turunkan mapping master ke pendaftaran.
UPDATE `pendaftaran` pd
LEFT JOIN `pasien` ps ON ps.`id_pasien` = pd.`pasien_id`
LEFT JOIN `dokter` dk ON dk.`id` = pd.`dokter_id`
LEFT JOIN `poliklinik` pl ON pl.`id` = pd.`poli_id`
SET
    pd.`no_rkm_medis_mlite` = COALESCE(
        NULLIF(pd.`no_rkm_medis_mlite`, ''),
        ps.`no_rkm_medis_mlite`
    ),
    pd.`kd_dokter_mlite` = COALESCE(
        NULLIF(pd.`kd_dokter_mlite`, ''),
        dk.`kd_dokter_mlite`
    ),
    pd.`kd_poli_mlite` = COALESCE(
        NULLIF(pd.`kd_poli_mlite`, ''),
        pl.`kd_poli_mlite`
    ),
    pd.`status_bayar_mlite` = COALESCE(
        NULLIF(pd.`status_bayar_mlite`, ''),
        CASE pd.`jenis_pasien`
            WHEN 'BPJS' THEN 'Belum Bayar'
            WHEN 'UMUM' THEN 'Belum Bayar'
            ELSE NULL
        END
    ),
    pd.`stts_mlite` = COALESCE(
        NULLIF(pd.`stts_mlite`, ''),
        CASE pd.`status`
            WHEN 'MENUNGGU' THEN 'Belum'
            WHEN 'DIPERIKSA' THEN 'Sudah'
            WHEN 'SELESAI' THEN 'Sudah'
            ELSE NULL
        END
    ),
    pd.`last_sync_mlite` = NOW();

-- Turunkan mapping master ke antrian.
UPDATE `antrian` a
LEFT JOIN `pasien` ps ON ps.`id_pasien` = a.`pasien_id`
LEFT JOIN `dokter` dk ON dk.`id` = a.`dokter_id`
LEFT JOIN `poliklinik` pl ON pl.`id` = a.`poli_id`
SET
    a.`no_rawat_mlite` = COALESCE(
        NULLIF(a.`no_rawat_mlite`, ''),
        NULL
    ),
    a.`no_reg_mlite` = COALESCE(
        NULLIF(a.`no_reg_mlite`, ''),
        NULL
    ),
    a.`last_sync_mlite` = NOW(),
    a.`task_id_mlite` = COALESCE(
        NULLIF(a.`task_id_mlite`, ''),
        NULL
    );

-- Turunkan mapping aman ke resep dari pasien dan dokter.
UPDATE `resep` r
LEFT JOIN `pasien` ps ON ps.`id_pasien` = r.`pasien_id`
LEFT JOIN `dokter` dk ON dk.`id` = r.`dokter_id`
SET
    r.`kd_dokter_mlite` = COALESCE(
        NULLIF(r.`kd_dokter_mlite`, ''),
        dk.`kd_dokter_mlite`
    ),
    r.`status_resep_mlite` = COALESCE(
        NULLIF(r.`status_resep_mlite`, ''),
        CASE r.`status`
            WHEN 'MENUNGGU' THEN 'ralan'
            WHEN 'DIPROSES' THEN 'ralan'
            WHEN 'SELESAI' THEN 'ralan'
            ELSE NULL
        END
    ),
    r.`last_sync_mlite` = NOW();

COMMIT;

-- Ringkasan hasil bootstrap.
SELECT 'Bootstrap mapping master selesai.' AS message;

SELECT
    COUNT(*) AS total_pasien,
    SUM(
        CASE
            WHEN `no_rkm_medis_mlite` IS NOT NULL
            AND `no_rkm_medis_mlite` <> '' THEN 1
            ELSE 0
        END
    ) AS pasien_mapped_rm,
    SUM(
        CASE
            WHEN `no_peserta_mlite` IS NOT NULL
            AND `no_peserta_mlite` <> '' THEN 1
            ELSE 0
        END
    ) AS pasien_mapped_bpjs
FROM `pasien`;

SELECT
    COUNT(*) AS total_poliklinik,
    SUM(
        CASE
            WHEN `kd_poli_mlite` IS NOT NULL
            AND `kd_poli_mlite` <> '' THEN 1
            ELSE 0
        END
    ) AS poliklinik_mapped
FROM `poliklinik`;

SELECT
    COUNT(*) AS total_dokter,
    SUM(
        CASE
            WHEN `kd_poli_mlite` IS NOT NULL
            AND `kd_poli_mlite` <> '' THEN 1
            ELSE 0
        END
    ) AS dokter_mapped_poli,
    SUM(
        CASE
            WHEN `kd_dokter_mlite` IS NOT NULL
            AND `kd_dokter_mlite` <> '' THEN 1
            ELSE 0
        END
    ) AS dokter_mapped_kode
FROM `dokter`;

-- Review manual untuk dokter yang belum punya kd_dokter_mlite.
SELECT d.`id`, d.`nama_dokter`, d.`sip`, d.`str_dokter`, d.`kd_poli_mlite`
FROM `dokter` d
WHERE
    d.`kd_dokter_mlite` IS NULL
    OR d.`kd_dokter_mlite` = '';