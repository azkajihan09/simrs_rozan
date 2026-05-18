<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content p-3">

<div class="container-fluid">

<?php if($this->session->flashdata('success')): ?>

<div class="alert alert-success">

<?= $this->session->flashdata('success') ?>

</div>

<?php endif; ?>

<div class="card">

<div class="card-header">

<h3 class="card-title">

Master Obat

</h3>

<div class="card-tools">

<a href="<?= base_url('obat/tambah')?>"
class="btn btn-primary btn-sm">

<i class="fas fa-plus"></i>

Tambah Obat

</a>

</div>

</div>

<div class="card-body table-responsive">

<table class="table table-bordered table-striped datatable">

<thead>

<tr>

<th>No</th>
<th>Kode</th>
<th>Nama Obat</th>
<th>Kategori</th>
<th>Stok</th>
<th>Harga</th>
<th>Expired</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php
$no = 1;

foreach($obat as $o):
?>

<tr>

<td><?= $no++ ?></td>

<td><?= $o->kode_obat ?></td>

<td><?= $o->nama_obat ?></td>

<td><?= $o->kategori ?></td>

<td>

<?php if($o->stok <= $o->stok_minimal): ?>

<span class="badge badge-danger">

<?= $o->stok ?>

</span>

<?php else: ?>

<span class="badge badge-success">

<?= $o->stok ?>

</span>

<?php endif; ?>

</td>

<td>

Rp <?= number_format($o->harga_jual) ?>

</td>

<td>

<?= $o->expired_date ?>

</td>

<td width="220">

<a href="<?= base_url('obat/detail/'.$o->id)?>"
class="btn btn-info btn-sm">

Detail

</a>

<a href="<?= base_url('obat/edit/'.$o->id)?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="<?= base_url('obat/hapus/'.$o->id)?>"
class="btn btn-danger btn-sm btn-delete">

Hapus

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>