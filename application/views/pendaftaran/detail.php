<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">

<h1 class="m-0">

<i class="fas fa-id-card text-primary"></i>
Detail Pendaftaran Pasien

</h1>

<div>

<a href="<?= base_url('pendaftaran') ?>"
class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>
Kembali

</a>

<button
onclick="window.print()"
class="btn btn-dark">

<i class="fas fa-print"></i>
Cetak

</button>

</div>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<!-- IDENTITAS PASIEN -->

<div class="col-md-4">

<div class="card shadow-lg border-0">

<div class="card-body text-center">

<div class="mb-3">

<div class="avatar-circle">

<?= strtoupper(substr($detail->nama_pasien,0,1)) ?>

</div>

</div>

<h3 class="mb-1">

<?= $detail->nama_pasien ?>

</h3>

<p class="text-muted">

<?= $detail->no_rm ?>

</p>

<?php

$status_class = 'secondary';

if($detail->status == 'MENUNGGU'){
    $status_class = 'warning';
}

if($detail->status == 'DIPERIKSA'){
    $status_class = 'info';
}

if($detail->status == 'SELESAI'){
    $status_class = 'success';
}

?>

<span class="badge badge-<?= $status_class ?> p-2">

<?= $detail->status ?>

</span>

<hr>

<div class="text-left">

<p>

<i class="fas fa-user text-primary"></i>

<strong>Jenis Kelamin:</strong><br>

<?= $detail->jenis_kelamin ?>

</p>

<p>

<i class="fas fa-phone text-success"></i>

<strong>Telepon:</strong><br>

<?= $detail->telepon ?>

</p>

<p>

<i class="fas fa-map-marker-alt text-danger"></i>

<strong>Alamat:</strong><br>

<?= $detail->alamat ?>

</p>

</div>

</div>

</div>

<!-- DETAIL PENDAFTARAN -->

</div>

<div class="col-md-8">

<div class="card shadow-lg border-0">

<div class="card-header bg-primary">

<h3 class="card-title text-white">

Informasi Pendaftaran

</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<div class="info-box bg-light">

<span class="info-box-icon bg-primary">

<i class="fas fa-hospital"></i>

</span>

<div class="info-box-content">

<span class="info-box-text">

Poliklinik

</span>

<span class="info-box-number">

<?= $detail->nama_poli ?>

</span>

</div>

</div>

</div>

<div class="col-md-6">

<div class="info-box bg-light">

<span class="info-box-icon bg-success">

<i class="fas fa-user-md"></i>

</span>

<div class="info-box-content">

<span class="info-box-text">

Dokter

</span>

<span class="info-box-number">

<?= $detail->nama_dokter ?>

</span>

</div>

</div>

</div>

<div class="col-md-6">

<div class="info-box bg-light">

<span class="info-box-icon bg-warning">

<i class="fas fa-calendar"></i>

</span>

<div class="info-box-content">

<span class="info-box-text">

Tanggal Daftar

</span>

<span class="info-box-number">

<?= date(
'd-m-Y',
strtotime($detail->tanggal)
) ?>

</span>

</div>

</div>

</div>

<div class="col-md-6">

<div class="info-box bg-light">

<span class="info-box-icon bg-danger">

<i class="fas fa-sort-numeric-up"></i>

</span>

<div class="info-box-content">

<span class="info-box-text">

No Antrian

</span>

<span class="info-box-number">

<?= $detail->no_antrian ?>

</span>

</div>

</div>

</div>

</div>

<hr>

<h5 class="mb-3">

<i class="fas fa-notes-medical text-info"></i>
Keluhan Awal

</h5>

<div class="alert alert-light border">

<?= !empty($detail->keluhan)
? $detail->keluhan
: 'Tidak ada keluhan awal.' ?>

</div>

<hr>

<h5 class="mb-3">

<i class="fab fa-whatsapp text-success"></i>
Kirim Informasi

</h5>

<?php

$pesan = "

Halo ".$detail->nama_pasien."

Berikut informasi pendaftaran Anda di SIMRS Klinik Rozan

No RM : ".$detail->no_rm."

Poli : ".$detail->nama_poli."

Dokter : ".$detail->nama_dokter."

Tanggal : ".date(
'd-m-Y',
strtotime($detail->tanggal)
)."

No Antrian : ".$detail->no_antrian."

Status : ".$detail->status."

Terima kasih.
";

$link_wa =
'https://wa.me/'.
preg_replace('/[^0-9]/','',$detail->telepon).
'?text='.
urlencode($pesan);

?>

<a href="<?= $link_wa ?>"
target="_blank"
class="btn btn-success btn-lg btn-block">

<i class="fab fa-whatsapp"></i>
Kirim ke WhatsApp

</a>

</div>

</div>

</div>

</div>

</div>

</section>

</div>

<style>

.avatar-circle{

width:100px;
height:100px;

border-radius:50%;

background:linear-gradient(
135deg,
#007bff,
#00c6ff
);

display:flex;
align-items:center;
justify-content:center;

font-size:42px;
font-weight:bold;
color:white;

margin:auto;

box-shadow:
0 5px 15px rgba(0,0,0,0.2);

}

.info-box{

border-radius:15px;

}

.card{

border-radius:20px;

overflow:hidden;

}

@media print{

.sidebar,
.main-header,
.btn,
.content-header{

display:none !important;

}

.content-wrapper{

margin:0 !important;
padding:0 !important;

}

}

</style>

<?php $this->load->view('template/footer'); ?>