<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content p-3">

<div class="container-fluid">

<div class="card card-info">

<div class="card-header">

<h3 class="card-title">

Detail Billing

</h3>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="30%">

Kode Billing

</th>

<td>

<?= $detail->kode_billing ?>

</td>

</tr>

<tr>

<th>

Nama Pasien

</th>

<td>

<?= $detail->nama_pasien ?>

</td>

</tr>

<tr>

<th>

Tanggal Billing

</th>

<td>

<?= $detail->tanggal_billing ?>

</td>

</tr>

<tr>

<th>

Jenis Pembayaran

</th>

<td>

<?= $detail->jenis_pembayaran ?>

</td>

</tr>

<tr>

<th>

Subtotal

</th>

<td>

Rp <?= number_format($detail->subtotal) ?>

</td>

</tr>

<tr>

<th>

Diskon

</th>

<td>

Rp <?= number_format($detail->diskon) ?>

</td>

</tr>

<tr>

<th>

Total Bayar

</th>

<td>

<b>

Rp <?= number_format($detail->total_bayar) ?>

</b>

</td>

</tr>

<tr>

<th>

Status

</th>

<td>

<?= $detail->status ?>

</td>

</tr>

</table>

<a href="<?= base_url('kasir')?>"
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