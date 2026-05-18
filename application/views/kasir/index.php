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

Data Billing Kasir

</h3>

<div class="card-tools">

<a href="<?= base_url('kasir/tambah')?>"
class="btn btn-primary btn-sm">

Tambah Billing

</a>

</div>

</div>

<div class="card-body table-responsive">

<table class="table table-bordered table-striped"
id="tableKasir">

<thead>

<tr>

<th>Kode Billing</th>
<th>Pasien</th>
<th>Tanggal</th>
<th>Total</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($billing as $b): ?>

<tr>

<td><?= $b->kode_billing ?></td>

<td><?= $b->nama_pasien ?></td>

<td>

<?= date(
'd-m-Y H:i',
strtotime($b->tanggal_billing)
) ?>

</td>

<td>

Rp <?= number_format($b->total_bayar) ?>

</td>

<td>

<?php if($b->status=='LUNAS'): ?>

<span class="badge badge-success">

LUNAS

</span>

<?php else: ?>

<span class="badge badge-danger">

BELUM LUNAS

</span>

<?php endif; ?>

</td>

<td width="250">

<a href="<?= base_url('kasir/detail/'.$b->id)?>"
class="btn btn-info btn-sm">

Detail

</a>

<?php if($b->status=='BELUM_LUNAS'): ?>

<a href="<?= base_url('kasir/bayar/'.$b->id)?>"
class="btn btn-success btn-sm"
onclick="return confirm('Proses pembayaran?')">

Bayar

</a>

<?php endif; ?>

<a href="<?= base_url('kasir/hapus/'.$b->id)?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin hapus?')">

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

    $('#tableKasir').DataTable({

        responsive:true

    });

});

</script>