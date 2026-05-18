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

Data Poliklinik

</h3>

<div class="card-tools">

<a href="<?= base_url('poliklinik/tambah')?>"
class="btn btn-primary btn-sm">

Tambah Poliklinik

</a>

</div>

</div>

<div class="card-body table-responsive">

<table class="table table-bordered table-striped"
id="tablePoli">

<thead>

<tr>

<th>No</th>
<th>Kode Poli</th>
<th>Nama Poli</th>
<th>Keterangan</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php
$no=1;
foreach($poliklinik as $p):
?>

<tr>

<td><?= $no++ ?></td>

<td><?= $p->kode_poli ?></td>

<td><?= $p->nama_poli ?></td>

<td><?= $p->keterangan ?></td>

<td width="250">

<a href="<?= base_url('poliklinik/detail/'.$p->id)?>"
class="btn btn-info btn-sm">

Detail

</a>

<a href="<?= base_url('poliklinik/edit/'.$p->id)?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="<?= base_url('poliklinik/hapus/'.$p->id)?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin hapus data?')">

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

<script>

$(document).ready(function(){

    $('#tablePoli').DataTable({

        responsive:true

    });

});

</script>