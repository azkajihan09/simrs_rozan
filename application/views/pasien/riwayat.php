<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content p-3">

<div class="container-fluid">

<div class="card">

<div class="card-header bg-info">

<h3 class="card-title">

Riwayat Rekam Medis Pasien

</h3>

<div class="card-tools">

<a href="<?= base_url('pasien')?>"
class="btn btn-light btn-sm">

Kembali

</a>

</div>

</div>

<div class="card-body">

<!-- ================================================= -->
<!-- IDENTITAS PASIEN -->
<!-- ================================================= -->

<div class="row">

<div class="col-md-6">

<table class="table table-bordered">

<tr>

<th width="35%">

No RM

</th>

<td>

<?= $pasien->no_rm ?>

</td>

</tr>

<tr>

<th>

Nama

</th>

<td>

<?= $pasien->nama_pasien ?>

</td>

</tr>

<tr>

<th>

NIK

</th>

<td>

<?= $pasien->nik ?>

</td>

</tr>

<tr>

<th>

Telepon

</th>

<td>

<?= $pasien->telepon ?>

</td>

</tr>

</table>

</div>

</div>

<hr>

<!-- ================================================= -->
<!-- RIWAYAT -->
<!-- ================================================= -->

<div class="table-responsive">

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Tanggal</th>
<th>Dokter</th>
<th>Diagnosa</th>
<th>Keluhan</th>
<th>Tindakan</th>

</tr>

</thead>

<tbody>

<?php if($riwayat): ?>

<?php foreach($riwayat as $r): ?>

<tr>

<td>

<?= date(
'd-m-Y H:i',
strtotime($r->tanggal_periksa)
) ?>

</td>

<td>

<?= $r->nama_dokter ?>

</td>

<td>

<?= $r->nama_diagnosa ?>

</td>

<td>

<?= $r->keluhan ?>

</td>

<td>

<?= $r->tindakan ?>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="5"
class="text-center">

Belum ada riwayat rekam medis

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>