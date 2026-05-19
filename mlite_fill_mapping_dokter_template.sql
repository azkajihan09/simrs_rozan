USE simrs_klinik_rozan;

-- Isi kd_dokter_mlite dengan kode dokter dari sistem mLITE Anda,
-- lalu jalankan file ini dan setelah itu jalankan mlite_manual_mapping_dokter.sql
-- agar nilai tersebut dipropagasikan ke tabel dokter, pendaftaran, dan resep.

UPDATE mlite_manual_map_dokter
SET
    kd_dokter_mlite = 'ISI_KODE_DOKTER_MLITE_ROBBY',
    status_verifikasi = 'VALID',
    catatan = 'Mapping manual dokter Robby',
    updated_at = NOW()
WHERE
    legacy_dokter_id = 1
    AND nama_dokter = 'Robby';

UPDATE mlite_manual_map_dokter
SET
    kd_dokter_mlite = 'ISI_KODE_DOKTER_MLITE_MELATI',
    status_verifikasi = 'VALID',
    catatan = 'Mapping manual dokter drg Melati',
    updated_at = NOW()
WHERE
    legacy_dokter_id = 2
    AND nama_dokter = 'drg Melati';

UPDATE mlite_manual_map_dokter
SET
    kd_dokter_mlite = 'ISI_KODE_DOKTER_MLITE_SISKA',
    status_verifikasi = 'VALID',
    catatan = 'Mapping manual dokter dr Siska',
    updated_at = NOW()
WHERE
    legacy_dokter_id = 3
    AND nama_dokter = 'dr Siska';

UPDATE mlite_manual_map_dokter
SET
    kd_dokter_mlite = 'ISI_KODE_DOKTER_MLITE_AGUSS',
    status_verifikasi = 'VALID',
    catatan = 'Mapping manual dokter dr. Aguss',
    updated_at = NOW()
WHERE
    legacy_dokter_id = 4
    AND nama_dokter = 'dr. Aguss';

SELECT
    legacy_dokter_id,
    nama_dokter,
    kd_poli_mlite,
    kd_dokter_mlite,
    status_verifikasi
FROM mlite_manual_map_dokter
ORDER BY legacy_dokter_id;