<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>

Laporan Pendapatan

</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow">

<div class="card-body">

<form method="get">

<div class="row">

<div class="col-md-4">

<label>Tanggal Awal</label>

<input type="date"
       name="tanggal_awal"
       class="form-control"
       value="<?= $tanggal_awal ?>">

</div>

<div class="col-md-4">

<label>Tanggal Akhir</label>

<input type="date"
       name="tanggal_akhir"
       class="form-control"
       value="<?= $tanggal_akhir ?>">

</div>

<div class="col-md-4">

<label>&nbsp;</label>

<button type="submit"
        class="btn btn-primary btn-block">

Filter

</button>

</div>

</div>

</form>

<hr>

<h4>

Total Pendapatan:
<strong>

Rp <?= number_format($total) ?>

</strong>

</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead class="thead-dark">

<tr>

<th>No</th>
<th>Kode Billing</th>
<th>Pasien</th>
<th>Total</th>
<th>Status</th>

</tr>

</thead>

<tbody>

<?php
$no = 1;
?>

<?php foreach($laporan as $l): ?>

<tr>

<td>

<?= $no++ ?>

</td>

<td>

<?= $l->kode_billing ?>

</td>

<td>

<?= $l->pasien_id ?>

</td>

<td>

Rp <?= number_format($l->total_bayar) ?>

</td>

<td>

<?= $l->status ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>