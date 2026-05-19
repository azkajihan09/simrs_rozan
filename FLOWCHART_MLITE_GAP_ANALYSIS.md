# Audit Kesesuaian Aplikasi dengan Flow Chart SIMRS

Dokumen ini membandingkan:

- flow chart target SIMRS/mLITE
- modul yang sudah ada di aplikasi saat ini
- status implementasi aktual di kode

Status yang dipakai:

- `100% ADA` = alur inti dan modul utama sudah tersedia serta dipakai aplikasi
- `PARSIAL` = ada modul atau fitur, tetapi tabel, integrasi, atau prosesnya belum sesuai flow chart mLITE
- `BELUM ADA` = belum ada implementasi yang nyata di aplikasi

## Tabel Perbandingan Detail

| Modul Flow Chart        | Tabel/Alur pada Flow Chart                             | Implementasi Aplikasi Saat Ini                                   | Status    | Catatan                                                                         |
| ----------------------- | ------------------------------------------------------ | ---------------------------------------------------------------- | --------- | ------------------------------------------------------------------------------- |
| Login user              | users, login_attempts, role/modules                    | Login via `users`, session `role_id`, helper role sederhana      | PARSIAL   | Belum memakai `mlite_modules`, `mlite_crud_permissions`, `mlite_login_attempts` |
| Master pasien           | `pasien`                                               | Ada controller, model, CRUD pasien                               | 100% ADA  | Struktur masih tabel lokal, belum native mLITE                                  |
| Master dokter           | `dokter`                                               | Ada controller, model, CRUD dokter                               | 100% ADA  | Sudah ada tabel lokal dan kolom mapping mLITE                                   |
| Master poliklinik       | `poliklinik`                                           | Ada controller, model, CRUD poliklinik                           | 100% ADA  | Sudah ada tabel lokal dan kolom mapping mLITE                                   |
| Booking online          | `booking_periksa`, `booking_periksa_diterima`          | Tidak ada controller booking online                              | BELUM ADA | Belum ada alur verifikasi admin booking                                         |
| Registrasi pasien       | `reg_periksa`                                          | Ada `pendaftaran` + `antrian`                                    | PARSIAL   | Secara fungsi ada, tetapi masih tabel lokal, bukan native `reg_periksa`         |
| Nomor antrian           | `reg_periksa` + antrian layanan                        | Ada modul `antrian` dan nomor antrian otomatis                   | 100% ADA  | Sudah berjalan untuk rawat jalan dasar                                          |
| Pelayanan rawat jalan   | Pemeriksaan dokter, tindakan, diagnosis, resep         | Ada `rekam_medis`, `rekam_medis_tindakan`, resep, billing detail | 100% ADA  | Sudah mengalir dari pemeriksaan ke billing                                      |
| IGD                     | Triase, pemeriksaan IGD                                | Ada list `jenis_layanan = IGD` di pelayanan                      | PARSIAL   | Belum ada modul triase/asesmen IGD terpisah seperti chart                       |
| Rawat inap              | `rawat_inap`, kamar, bed                               | Ada modul rawat inap, kamar, bed, pasien pulang                  | PARSIAL   | Belum menyatu ke alur mLITE ranap penuh                                         |
| Operasi                 | `booking_operasi`, `laporan_operasi`, `obatbhp_ok`     | Tidak ada controller operasi aktif                               | BELUM ADA | Tidak ada modul operasi end-to-end                                              |
| Laboratorium            | `permintaan_lab`, `periksa_lab`                        | Ada modul `laboratorium`                                         | PARSIAL   | Secara fitur ada, tetapi struktur tabel tidak mengikuti flow chart mLITE        |
| Radiologi               | `permintaan_radiologi`, hasil radiologi                | Ada modul `radiologi`                                            | PARSIAL   | Secara fitur ada, tetapi tabel masih lokal                                      |
| Farmasi                 | `resep_obat`, `detail_penyerahan_obat`                 | Ada `resep`, `resep_detail`, `obat`, proses resep di farmasi     | PARSIAL   | Proses resep berjalan, tetapi belum native ke tabel mLITE farmasi               |
| Inventory obat & barang | gudang, mutasi, opname                                 | Ada master obat dasar                                            | PARSIAL   | Inventory gudang lengkap seperti flow chart belum ada                           |
| Billing & kasir         | `mlite_billing`, `mlite_penjualan`                     | Ada `billing`, `billing_detail`, `kasir`                         | PARSIAL   | Fitur ada, tapi tabel dan integrasi akuntansi belum native mLITE                |
| Keuangan                | `mlite_jurnal`, `mlite_detailjurnal`, `mlite_rekening` | Modul keuangan ada, migrasi awal ke mLITE sudah dibuat           | PARSIAL   | Bridge mLITE sudah mulai ada, tetapi controller masih baca tabel lama           |
| BPJS / bridging         | SEP, rujukan, klaim                                    | Hanya pilihan jenis pasien BPJS di UI                            | BELUM ADA | Belum ada alur bridging aktif                                                   |
| Resume medis            | `resume_pasien`, `resume_pasien_ranap`                 | Ada rekam medis dan detail pemeriksaan                           | PARSIAL   | Resume formal sesuai struktur mLITE belum ada                                   |
| Berkas digital          | `berkas_digital_perawatan`, `master_berkas_digital`    | Upload hasil lab/radiologi ada terbatas                          | PARSIAL   | Belum ada modul berkas digital terpusat                                         |
| Hak akses per modul     | `mlite_modules`, `mlite_crud_permissions`              | Ada helper role sederhana dan sidebar berbasis role              | PARSIAL   | Belum granular per modul/CRUD                                                   |

## Penandaan Status Flow Chart

### Bagian yang sudah 100% ada

- Master pasien
- Master dokter
- Master poliklinik
- Antrian dasar pasien
- Pemeriksaan rawat jalan dasar
- Resep dasar dari pemeriksaan
- Billing dasar

### Bagian yang parsial

- Registrasi karena masih memakai `pendaftaran` dan `antrian`, belum native `reg_periksa`
- Pelayanan IGD karena belum ada triase/asesmen IGD formal
- Rawat inap karena alur mLITE ranap penuh belum lengkap
- Laboratorium dan radiologi karena fitur ada tetapi tabel belum mengikuti flow chart mLITE
- Farmasi karena proses resep ada tetapi belum native ke `resep_obat` dan `detail_penyerahan_obat`
- Inventory obat/barang karena baru sebatas master obat
- Billing, kasir, dan keuangan karena fitur ada tetapi baru bridge ke mLITE
- Resume medis dan berkas digital karena belum memakai struktur formal mLITE
- Hak akses karena masih role sederhana

### Bagian yang belum ada

- Booking online pasien
- Modul operasi lengkap
- Bridging BPJS/VClaim/SEP
- Permission CRUD berbasis `mlite_modules` dan `mlite_crud_permissions`

## Temuan Utama yang Perlu Diperbaiki

1. Banyak fitur sudah ada, tetapi masih memakai tabel lokal yang berbeda dari flow chart mLITE.
2. Beberapa modul besar di flow chart hanya terwakili sebagian di UI, bukan proses penuh.
3. Kontrol akses masih belum konsisten di semua controller.
4. Integrasi antarmodul masih berbasis tabel lokal, belum konsisten ke bridge mLITE yang sedang dibangun.

## Roadmap Perubahan Agar Mendekati Flow Chart mLITE

### Fase 1: Stabilisasi Aplikasi Saat Ini

Target:

- rapikan kontrol akses
- pastikan alur pendaftaran -> antrian -> pemeriksaan -> billing stabil
- hilangkan ketidakkonsistenan antarcontroller dan model

Pekerjaan:

- aktifkan `cek_login()` di semua controller operasional
- audit penggunaan role agar menu dan controller konsisten
- rapikan query join yang masih tidak konsisten pada dokter/poli/pasien
- pastikan transaksi resep, billing, lab, radiologi, rawat inap berjalan tanpa konflik skema

### Fase 2: Native Bridge ke Skema mLITE

Target:

- tabel lama tetap berjalan
- kolom `*_mlite` terisi penuh
- transaksi lama mulai tersinkron ke bridge mLITE

Pekerjaan:

- selesaikan mapping dokter manual
- finalisasi `no_rawat_mlite` dan `reg_periksa` bridge
- sinkron resep dan obat ke `resep_obat`, `resep_dokter`, `databarang`
- ubah keuangan agar membaca tabel mLITE bila data sudah lengkap

### Fase 3: Penyesuaian Modul ke Flow Chart

Target:

- modul lama diubah agar lebih dekat ke flow chart target

Pekerjaan:

- ubah pendaftaran agar berbasis `reg_periksa`
- ubah billing/kasir agar berbasis `mlite_billing` dan `mlite_penjualan` atau bridge setara
- bentuk resume medis formal dan berkas digital
- bentuk inventory obat dan barang yang lebih lengkap

### Fase 4: Modul yang Belum Ada

Target:

- tutup gap terbesar antara aplikasi dan flow chart

Pekerjaan:

- booking online
- operasi lengkap
- BPJS/bridging
- permission modular berbasis tabel mLITE

## Urutan Perbaikan yang Disarankan

1. Stabilkan login, role, dan controller operasional.
2. Selesaikan bridge dokter, pendaftaran, resep, dan obat.
3. Ubah keuangan dan billing agar mengonsumsi bridge mLITE.
4. Tambahkan modul yang belum ada.

## Rekomendasi Tindakan Praktis Sekarang

Kalau target Anda adalah memperbaiki aplikasi ini secara bertahap tanpa rewrite penuh, urutan paling aman adalah:

1. rapikan kontrol akses dan konsistensi controller
2. selesaikan mapping dan bridge mLITE untuk transaksi inti
3. baru setelah itu bangun modul booking, operasi, BPJS, dan hak akses granular
