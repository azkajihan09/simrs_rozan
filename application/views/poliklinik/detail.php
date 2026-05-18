<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content p-3">

<div class="container-fluid">

<div class="card card-info">

<div class="card-header">

<h3 class="card-title">

Detail Poliklinik

</h3>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="30%">

Kode Poli

</th>

<td>

<?= $detail->kode_poli ?>

</td>

</tr>

<tr>

<th>

Nama Poli

</th>

<td>

<?= $detail->nama_poli ?>

</td>

</tr>

<tr>

<th>

Keterangan

</th>

<td>

<?= $detail->keterangan ?>

</td>

</tr>

</table>

<a href="<?= base_url('poliklinik')?>"
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