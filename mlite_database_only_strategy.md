# Strategi Modifikasi Database Saja untuk Integrasi mLITE

Dokumen ini dibuat untuk kondisi berikut:

- kode aplikasi saat ini sebisa mungkin tidak diubah
- database lama ingin dimodifikasi agar bisa mengadopsi sebagian struktur dan data mLITE

## Kesimpulan Utama

Jangan mengganti langsung tabel inti aplikasi dengan tabel mLITE yang namanya sama tetapi strukturnya berbeda.

Tabel yang sangat terikat ke kode saat ini:

- `pasien`
- `dokter`
- `poliklinik`
- `pendaftaran`
- `antrian`
- `resep`
- `resep_detail`
- `obat`
- `jurnal`
- `jurnal_detail`
- `coa`

Jika tabel-tabel itu langsung diganti ke struktur mLITE, query aplikasi saat ini akan rusak karena kode memakai nama kolom lama seperti:

- `pasien.id_pasien`
- `pasien.no_rm`
- `pasien.nama_pasien`
- `pasien.telepon`
- `dokter.id`
- `dokter.nama_dokter`
- `poliklinik.id`
- `poliklinik.nama_poli`
- `pendaftaran.id`
- `antrian.kode_antrian`
- `antrian.nomor_antrian`

## Strategi Yang Aman Jika Hanya Database yang Diubah

Gunakan strategi kompatibilitas:

1. Pertahankan tabel lama yang dipakai aplikasi.
2. Tambahkan kolom referensi ke skema mLITE pada tabel lama.
3. Tambahkan tabel mLITE yang belum ada tanpa mengganggu tabel lama.
4. Sinkronkan data bertahap dengan script SQL atau proses ETL.

## Modul yang Bisa Diadopsi Paling Cepat

### 1. Keuangan

Modul ini paling dekat strukturnya dengan mLITE.

Mapping yang disarankan:

- `coa` tetap dipakai aplikasi, tetapi tambahkan kolom `kd_rek_mlite`
- `jurnal` tetap dipakai aplikasi, tetapi tambahkan kolom `no_jurnal_mlite`
- `jurnal_detail` tetap dipakai aplikasi, tetapi tambahkan kolom `kd_rek_mlite`

Kolom tambahan yang disarankan:

```sql
ALTER TABLE coa ADD COLUMN kd_rek_mlite VARCHAR(15) NULL;
ALTER TABLE jurnal ADD COLUMN no_jurnal_mlite VARCHAR(20) NULL;
ALTER TABLE jurnal_detail ADD COLUMN kd_rek_mlite VARCHAR(15) NULL;
```

Dengan pendekatan ini, aplikasi tetap jalan memakai tabel lama, tetapi Anda sudah punya jembatan ke:

- `mlite_rekening`
- `mlite_jurnal`
- `mlite_detailjurnal`

### 2. Master Pasien

Jangan ganti struktur `pasien` lama secara total. Tambahkan kolom referensi ke mLITE.

Kolom tambahan minimum:

```sql
ALTER TABLE pasien ADD COLUMN no_rkm_medis_mlite VARCHAR(15) NULL;
ALTER TABLE pasien ADD COLUMN kd_pj_mlite CHAR(3) NULL;
```

Tujuannya:

- `id_pasien`, `no_rm`, `nama_pasien`, `telepon` tetap dipakai aplikasi
- `no_rkm_medis_mlite` menyimpan relasi ke tabel `pasien` versi mLITE

### 3. Master Dokter

Tambahkan referensi ke kode dokter mLITE.

```sql
ALTER TABLE dokter ADD COLUMN kd_dokter_mlite VARCHAR(20) NULL;
ALTER TABLE dokter ADD COLUMN kd_poli_mlite CHAR(5) NULL;
```

### 4. Master Poliklinik

Tambahkan kode poli mLITE tanpa menghapus kolom lama.

```sql
ALTER TABLE poliklinik ADD COLUMN kd_poli_mlite CHAR(5) NULL;
```

### 5. Pendaftaran dan Antrian

Bagian ini tidak aman jika hanya diganti tabelnya. Karena kode aktif menulis ke `pendaftaran` dan `antrian`.

Solusi aman adalah menambah kolom referensi:

```sql
ALTER TABLE pendaftaran ADD COLUMN no_rawat_mlite VARCHAR(17) NULL;
ALTER TABLE pendaftaran ADD COLUMN kd_pj_mlite CHAR(3) NULL;
ALTER TABLE antrian ADD COLUMN no_rawat_mlite VARCHAR(17) NULL;
```

Jangan langsung mengganti `pendaftaran` menjadi `reg_periksa` bila kode aplikasi belum diubah.

### 6. Farmasi dan Resep

Jangan langsung ganti `obat` menjadi `databarang` atau `resep` menjadi `resep_obat`.

Tambahkan kolom relasi dulu:

```sql
ALTER TABLE obat ADD COLUMN kode_brng_mlite VARCHAR(15) NULL;
ALTER TABLE resep ADD COLUMN no_resep_mlite VARCHAR(14) NULL;
ALTER TABLE resep ADD COLUMN no_rawat_mlite VARCHAR(17) NULL;
```

## Yang Boleh Diimport Langsung dari mLITE

Tabel yang berawalan `mlite_` pada umumnya aman diimpor langsung selama belum dipakai kode lama, misalnya:

- `mlite_rekening`
- `mlite_rekeningtahun`
- `mlite_jurnal`
- `mlite_detailjurnal`
- `mlite_modules`
- `mlite_login_attempts`

Tetapi tetap gunakan database cadangan terlebih dahulu.

## Yang Tidak Disarankan Jika Hanya Database yang Diubah

- mengganti tabel `pasien` lama dengan tabel `pasien` dari mLITE
- mengganti tabel `dokter` lama dengan tabel `dokter` dari mLITE
- mengganti tabel `poliklinik` lama dengan tabel `poliklinik` dari mLITE
- menghapus tabel `pendaftaran` dan memaksa aplikasi memakai `reg_periksa`
- menghapus tabel `antrian` dan berharap alur lama tetap berjalan

## Urutan Eksekusi yang Disarankan

1. Backup database aktif.
2. Import hanya tabel `mlite_` yang dibutuhkan.
3. Tambahkan kolom referensi `*_mlite` di tabel lama.
4. Isi mapping master:
   - pasien lama ke pasien mLITE
   - dokter lama ke dokter mLITE
   - poliklinik lama ke poliklinik mLITE
5. Lanjutkan mapping transaksi:
   - pendaftaran ke `reg_periksa`
   - resep ke `resep_obat`
   - keuangan ke `mlite_jurnal`

## Rekomendasi Praktis

Jika Anda benar-benar ingin hanya modifikasi database, maka target paling realistis adalah:

- database lama tetap menjadi database operasional aplikasi
- mLITE dipakai sebagai sumber referensi tambahan
- sinkronisasi dilakukan bertahap melalui kolom mapping

Jika suatu saat Anda ingin full native ke mLITE, barulah kode aplikasi ikut diubah.
