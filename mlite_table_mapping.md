# Mapping Tabel Lama ke mLITE

Dokumen ini disusun dari struktur tabel aktif di database `simrs_klinik_rozan` dan target struktur pada `mlite_db.sql`.

## Prinsip

- tabel lama tetap menjadi tabel operasional aplikasi
- tabel mLITE menjadi target referensi dan migrasi bertahap
- kolom `*_mlite` dipakai sebagai jembatan antara dua struktur

## Modul Pasien

Tabel lama: `pasien`

Target mLITE: `pasien`

Mapping utama:

| Tabel Lama | Kolom Lama    | Tabel mLITE | Kolom mLITE  | Catatan                                             |
| ---------- | ------------- | ----------- | ------------ | --------------------------------------------------- |
| pasien     | id_pasien     | pasien      | tidak ada    | tetap jadi PK internal aplikasi                     |
| pasien     | no_rm         | pasien      | no_rkm_medis | nomor RM lokal dipetakan ke nomor rekam medis mLITE |
| pasien     | no_bpjs       | pasien      | no_peserta   | bisa dipindah ke `no_peserta_mlite`                 |
| pasien     | nama_pasien   | pasien      | nm_pasien    | beda nama kolom                                     |
| pasien     | jenis_kelamin | pasien      | jk           | nilai sama: `L/P`                                   |
| pasien     | tempat_lahir  | pasien      | tmp_lahir    | beda nama kolom                                     |
| pasien     | tanggal_lahir | pasien      | tgl_lahir    | beda nama kolom                                     |
| pasien     | alamat        | pasien      | alamat       | sama                                                |
| pasien     | telepon       | pasien      | no_tlp       | beda nama kolom                                     |
| pasien     | nik           | pasien      | no_ktp       | beda nama kolom                                     |

Kolom mapping yang ditambahkan:

- `pasien.no_rkm_medis_mlite`
- `pasien.kd_pj_mlite`
- `pasien.no_peserta_mlite`

## Modul Dokter

Tabel lama: `dokter`

Target mLITE: `dokter`

Mapping utama:

| Tabel Lama | Kolom Lama  | Tabel mLITE    | Kolom mLITE        | Catatan                                              |
| ---------- | ----------- | -------------- | ------------------ | ---------------------------------------------------- |
| dokter     | id          | dokter         | tidak ada          | tetap jadi PK internal aplikasi                      |
| dokter     | poli_id     | dokter         | tidak langsung     | relasi ke `poliklinik.kd_poli` melalui mapping       |
| dokter     | nama_dokter | dokter         | nm_dokter          | beda nama kolom                                      |
| dokter     | spesialis   | dokter         | tidak langsung     | perlu disesuaikan sesuai master pegawai/dokter mLITE |
| dokter     | sip         | dokter         | tidak ada langsung | bisa disimpan lokal                                  |
| dokter     | str_dokter  | dokter         | tidak ada langsung | bisa disimpan lokal                                  |
| dokter     | telepon     | dokter/pegawai | tidak langsung     | di mLITE biasanya atribut pegawai lebih dominan      |

Kolom mapping yang ditambahkan:

- `dokter.kd_dokter_mlite`
- `dokter.kd_poli_mlite`

## Modul Poliklinik

Tabel lama: `poliklinik`

Target mLITE: `poliklinik`

Mapping utama:

| Tabel Lama | Kolom Lama | Tabel mLITE | Kolom mLITE        | Catatan                         |
| ---------- | ---------- | ----------- | ------------------ | ------------------------------- |
| poliklinik | id         | poliklinik  | tidak ada          | tetap jadi PK internal aplikasi |
| poliklinik | kode_poli  | poliklinik  | kd_poli            | paling dekat                    |
| poliklinik | nama_poli  | poliklinik  | nm_poli            | beda nama kolom                 |
| poliklinik | keterangan | poliklinik  | tidak ada langsung | tetap lokal jika diperlukan     |

Kolom mapping yang ditambahkan:

- `poliklinik.kd_poli_mlite`

## Modul Pendaftaran

Tabel lama: `pendaftaran`

Target mLITE: `reg_periksa`

Mapping utama:

| Tabel Lama  | Kolom Lama   | Tabel mLITE | Kolom mLITE         | Catatan                                       |
| ----------- | ------------ | ----------- | ------------------- | --------------------------------------------- |
| pendaftaran | id           | reg_periksa | tidak ada           | tetap PK internal aplikasi                    |
| pendaftaran | pasien_id    | reg_periksa | no_rkm_medis        | perlu lookup dari `pasien.no_rkm_medis_mlite` |
| pendaftaran | dokter_id    | reg_periksa | kd_dokter           | perlu lookup dari `dokter.kd_dokter_mlite`    |
| pendaftaran | poli_id      | reg_periksa | kd_poli             | perlu lookup dari `poliklinik.kd_poli_mlite`  |
| pendaftaran | tanggal      | reg_periksa | tgl_registrasi      | beda nama kolom                               |
| pendaftaran | no_antrian   | reg_periksa | no_reg              | hanya sebagian makna, bukan identik           |
| pendaftaran | jenis_pasien | reg_periksa | kd_pj               | butuh tabel mapping penjamin                  |
| pendaftaran | status       | reg_periksa | stts / status_bayar | perlu transformasi nilai                      |

Kolom mapping yang ditambahkan:

- `pendaftaran.no_rawat_mlite`
- `pendaftaran.no_reg_mlite`
- `pendaftaran.no_rkm_medis_mlite`
- `pendaftaran.kd_dokter_mlite`
- `pendaftaran.kd_poli_mlite`
- `pendaftaran.kd_pj_mlite`

## Modul Antrian

Tabel lama: `antrian`

Target mLITE: tetap tabel lokal sebagai operasional, lalu ditautkan ke `reg_periksa`

Mapping utama:

| Tabel Lama | Kolom Lama    | Target Relasi | Kolom Target   | Catatan                                  |
| ---------- | ------------- | ------------- | -------------- | ---------------------------------------- |
| antrian    | kode_antrian  | lokal         | tetap lokal    | tidak ada padanan langsung di mLITE inti |
| antrian    | pasien_id     | reg_periksa   | no_rkm_medis   | melalui mapping pasien                   |
| antrian    | dokter_id     | reg_periksa   | kd_dokter      | melalui mapping dokter                   |
| antrian    | poli_id       | reg_periksa   | kd_poli        | melalui mapping poli                     |
| antrian    | tanggal       | reg_periksa   | tgl_registrasi | sama makna                               |
| antrian    | nomor_antrian | reg_periksa   | no_reg         | hanya referensi, bukan identik           |

Kolom mapping yang ditambahkan:

- `antrian.no_rawat_mlite`
- `antrian.no_reg_mlite`
- `antrian.task_id_mlite`

## Modul Resep dan Obat

Tabel lama: `resep`, `resep_detail`, `obat`

Target mLITE: `resep_obat`, `resep_dokter`, `databarang`

Mapping utama resep:

| Tabel Lama | Kolom Lama | Tabel mLITE | Kolom mLITE                   | Catatan                                       |
| ---------- | ---------- | ----------- | ----------------------------- | --------------------------------------------- |
| resep      | id         | resep_obat  | tidak ada                     | tetap PK internal aplikasi                    |
| resep      | kode_resep | resep_obat  | no_resep                      | paling dekat                                  |
| resep      | pasien_id  | resep_obat  | tidak langsung                | pasien diturunkan dari `reg_periksa.no_rawat` |
| resep      | dokter_id  | resep_obat  | kd_dokter                     | lewat mapping dokter                          |
| resep      | tanggal    | resep_obat  | tgl_peresepan / jam_peresepan | perlu dipecah tanggal dan jam                 |
| resep      | status     | resep_obat  | status                        | perlu transformasi nilai                      |

Mapping utama item obat:

| Tabel Lama   | Kolom Lama   | Tabel mLITE  | Kolom mLITE              | Catatan                      |
| ------------ | ------------ | ------------ | ------------------------ | ---------------------------- |
| resep_detail | resep_id     | resep_dokter | no_resep                 | lewat `resep.no_resep_mlite` |
| resep_detail | obat_id      | resep_dokter | kode_brng                | lewat `obat.kode_brng_mlite` |
| resep_detail | qty          | resep_dokter | jml                      | sama makna                   |
| resep_detail | aturan_pakai | resep_dokter | aturan_pakai             | sama makna                   |
| obat         | kode_obat    | databarang   | kode_brng                | butuh normalisasi kode       |
| obat         | nama_obat    | databarang   | nama_brng                | beda nama kolom              |
| obat         | satuan       | databarang   | kode_sat / kode_satbesar | perlu master satuan          |

Kolom mapping yang ditambahkan:

- `resep.no_resep_mlite`
- `resep.no_rawat_mlite`
- `resep.kd_dokter_mlite`
- `resep_detail.no_resep_mlite`
- `resep_detail.kode_brng_mlite`
- `obat.kode_brng_mlite`
- `obat.kode_sat_mlite`

## Modul Keuangan

Tabel lama: `coa`, `jurnal`, `jurnal_detail`

Target mLITE: `mlite_rekening`, `mlite_jurnal`, `mlite_detailjurnal`

Mapping utama:

| Tabel Lama    | Kolom Lama | Tabel mLITE        | Kolom mLITE           | Catatan                                |
| ------------- | ---------- | ------------------ | --------------------- | -------------------------------------- |
| coa           | id         | mlite_rekening     | tidak ada             | tetap PK internal aplikasi             |
| coa           | kode_akun  | mlite_rekening     | kd_rek                | paling dekat                           |
| coa           | nama_akun  | mlite_rekening     | nm_rek                | beda nama kolom                        |
| coa           | tipe       | mlite_rekening     | tipe + balance        | perlu transformasi                     |
| jurnal        | id         | mlite_jurnal       | tidak ada             | tetap PK internal aplikasi             |
| jurnal        | tanggal    | mlite_jurnal       | tgl_jurnal            | ambil bagian tanggal                   |
| jurnal        | keterangan | mlite_jurnal       | kegiatan + keterangan | dipadatkan ke dua field                |
| jurnal_detail | jurnal_id  | mlite_detailjurnal | no_jurnal             | lewat mapping `jurnal.no_jurnal_mlite` |
| jurnal_detail | coa_id     | mlite_detailjurnal | kd_rek                | lewat mapping `coa.kd_rek_mlite`       |
| jurnal_detail | debit      | mlite_detailjurnal | debet                 | beda ejaan                             |
| jurnal_detail | kredit     | mlite_detailjurnal | kredit                | sama                                   |

Transformasi tipe akun:

| coa.tipe   | mlite_rekening.tipe | mlite_rekening.balance |
| ---------- | ------------------- | ---------------------- |
| ASET       | N                   | D                      |
| KEWAJIBAN  | N                   | K                      |
| MODAL      | M                   | K                      |
| PENDAPATAN | R                   | K                      |
| BEBAN      | R                   | D                      |

Kolom mapping yang ditambahkan:

- `coa.kd_rek_mlite`
- `coa.tipe_mlite`
- `coa.balance_mlite`
- `jurnal.no_jurnal_mlite`
- `jurnal.no_bukti_mlite`
- `jurnal.jenis_mlite`
- `jurnal_detail.no_jurnal_mlite`
- `jurnal_detail.kd_rek_mlite`
- `jurnal_detail.arus_kas_mlite`

## Rekomendasi Eksekusi

1. Jalankan `mlite_prepare_legacy_schema.sql`.
2. Isi mapping master: pasien, poli, dokter.
3. Setelah master terisi, lanjut isi mapping pendaftaran dan resep.
4. Terakhir jalankan migrasi awal keuangan dari `mlite_migrate_keuangan.sql`.
