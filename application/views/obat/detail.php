<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h1>Detail Obat</h1>

</div>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card card-info">

<div class="card-header">

<h3 class="card-title">

Informasi Obat

</h3>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="30%">

Kode Obat

</th>

<td>

<?= $detail->kode_obat ?>

</td>

</tr>

<tr>

<th>Nama Obat</th>

<td>

<?= $detail->nama_obat ?>

</td>

</tr>

<tr>

<th>Kategori</th>

<td>

<?= $detail->kategori ?>

</td>

</tr>

<tr>

<th>Satuan</th>

<td>

<?= $detail->satuan ?>

</td>

</tr>

<tr>

<th>Stok</th>

<td>

<?= $detail->stok ?>

</td>

</tr>

<tr>

<th>Stok Minimal</th>

<td>

<?= $detail->stok_minimal ?>

</td>

</tr>

<tr>

<th>Harga Beli</th>

<td>

Rp <?= number_format($detail->harga_beli) ?>

</td>

</tr>

<tr>

<th>Harga Jual</th>

<td>

Rp <?= number_format($detail->harga_jual) ?>

</td>

</tr>

<tr>

<th>Expired Date</th>

<td>

<?= $detail->expired_date ?>

</td>

</tr>

</table>

</div>

<div class="card-footer">

<a href="<?= base_url('obat/edit/'.$detail->id)?>"
class="btn btn-warning">

<i class="fas fa-edit"></i>

Edit

</a>

<a href="<?= base_url('obat')?>"
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