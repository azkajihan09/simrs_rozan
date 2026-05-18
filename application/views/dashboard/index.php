<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>

Dashboard Klinik Rozan

</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<div class="col-lg-3 col-6">

<div class="small-box bg-info">

<div class="inner">

<h3>

<?= $pasien_hari_ini ?>

</h3>

<p>

Pasien Hari Ini

</p>

</div>

<div class="icon">

<i class="fas fa-user-injured"></i>

</div>

</div>

</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-warning">

<div class="inner">

<h3>

<?= $antrian_aktif ?>

</h3>

<p>

Antrian Aktif

</p>

</div>

<div class="icon">

<i class="fas fa-list"></i>

</div>

</div>

</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-success">

<div class="inner">

<h3>

Rp <?= number_format($billing_hari_ini) ?>

</h3>

<p>

Pendapatan Hari Ini

</p>

</div>

<div class="icon">

<i class="fas fa-money-bill"></i>

</div>

</div>

</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-danger">

<div class="inner">

<h3>

<?= $total_lunas ?>

</h3>

<p>

Billing Lunas

</p>

</div>

<div class="icon">

<i class="fas fa-check-circle"></i>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-primary">

<h3 class="card-title text-white">

Obat Hampir Habis

</h3>

</div>

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>

<th>Obat</th>
<th>Stok</th>

</tr>

</thead>

<tbody>

<?php foreach($obat_hampir_habis as $o): ?>

<tr>

<td>

<?= $o->nama_obat ?>

</td>

<td>

<span class="badge badge-danger">

<?= $o->stok ?>

</span>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-success">

<h3 class="card-title text-white">

Dokter Aktif

</h3>

</div>

<div class="card-body text-center">

<h1>

<?= $dokter_aktif ?>

</h1>

<p>

Dokter Terdaftar

</p>

</div>

</div>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>