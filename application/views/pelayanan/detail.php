<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>Detail Pelayanan</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card card-info shadow-sm">

<div class="card-header">

<h3 class="card-title">

Informasi Pelayanan Pasien

</h3>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="30%">

Nama Pasien

</th>

<td>

<?= $detail->nama_pasien ?>

</td>

</tr>

<tr>

<th>Dokter</th>

<td>

<?= $detail->nama_dokter ?>

</td>

</tr>

<tr>

<th>Poliklinik</th>

<td>

<?= $detail->nama_poli ?>

</td>

</tr>

<tr>

<th>No Antrian</th>

<td>

<?= $detail->nomor_antrian ?>

</td>

</tr>

<tr>

<th>Status</th>

<td>

<?php if($detail->status=='SELESAI'): ?>

<span class="badge badge-success">

SELESAI

</span>

<?php else: ?>

<span class="badge badge-warning">

MENUNGGU

</span>

<?php endif; ?>

</td>

</tr>

<tr>

<th>Tanggal</th>

<td>

<?= $detail->created_at ?>

</td>

</tr>

</table>

</div>

<div class="card-footer">

<a href="<?= base_url('pelayanan/edit/'.$detail->id)?>"
class="btn btn-warning">

<i class="fas fa-edit"></i>

Edit

</a>

<a href="<?= base_url('rekammedis/tambah/'.$detail->id)?>"
class="btn btn-primary">

<i class="fas fa-stethoscope"></i>

Periksa

</a>

<a href="<?= base_url('pelayanan')?>"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>