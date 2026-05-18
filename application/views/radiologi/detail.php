<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<div class="card card-info">

<div class="card-header">

<h3 class="card-title">

Detail Radiologi

</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<table class="table table-bordered">

<tr>

<th>No RM</th>

<td><?= $detail->no_rm ?></td>

</tr>

<tr>

<th>Nama Pasien</th>

<td><?= $detail->nama_pasien ?></td>

</tr>

<tr>

<th>Dokter Pengirim</th>

<td><?= $detail->nama_dokter ?></td>

</tr>

<tr>

<th>Jenis Pemeriksaan</th>

<td><?= $detail->jenis_pemeriksaan ?></td>

</tr>

<tr>

<th>Status</th>

<td>

<?php if($detail->status=='MENUNGGU'): ?>

<span class="badge badge-warning">

MENUNGGU

</span>

<?php else: ?>

<span class="badge badge-success">

SELESAI

</span>

<?php endif; ?>

</td>

</tr>

<tr>

<th>Tanggal</th>

<td><?= $detail->tanggal ?></td>

</tr>

</table>

</div>

<div class="col-md-6">

<div class="card">

<div class="card-header bg-light">

<h5>Hasil Radiologi</h5>

</div>

<div class="card-body">

<?= nl2br($detail->hasil) ?>

</div>

</div>

</div>

</div>

<hr>

<?php if($detail->file_hasil != ''): ?>

<div class="card">

<div class="card-header bg-secondary">

<h5>File Hasil Radiologi</h5>

</div>

<div class="card-body text-center">

<?php

$ext = pathinfo(
    $detail->file_hasil,
    PATHINFO_EXTENSION
);

?>

<?php if(
    $ext == 'jpg' ||
    $ext == 'jpeg' ||
    $ext == 'png'
): ?>

<img
src="<?= base_url('uploads/radiologi/'.$detail->file_hasil)?>"
class="img-fluid rounded shadow">

<?php endif; ?>

<?php if($ext == 'pdf'): ?>

<iframe
src="<?= base_url('uploads/radiologi/'.$detail->file_hasil)?>"
width="100%"
height="600">

</iframe>

<?php endif; ?>

<br><br>

<a href="<?= base_url('uploads/radiologi/'.$detail->file_hasil)?>"
target="_blank"
class="btn btn-success">

Download Hasil

</a>

</div>

</div>

<?php endif; ?>

<a href="<?= base_url('radiologi')?>"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>