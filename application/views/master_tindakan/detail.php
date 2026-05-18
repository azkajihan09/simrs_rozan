<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center">

<h1 class="m-0">

<i class="fas fa-notes-medical text-info"></i>
Detail Tindakan

</h1>

<a href="<?= base_url('master_tindakan') ?>"
class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>
Kembali

</a>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card border-0 shadow-lg">

<div class="card-header bg-info">

<h3 class="card-title text-white">

Informasi Tindakan

</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<div class="info-box bg-light">

<span class="info-box-icon bg-primary">

<i class="fas fa-barcode"></i>

</span>

<div class="info-box-content">

<span class="info-box-text">
Kode Tindakan
</span>

<span class="info-box-number">
<?= $row->kode_tindakan ?>
</span>

</div>

</div>

</div>

<div class="col-md-6">

<div class="info-box bg-light">

<span class="info-box-icon bg-success">

<i class="fas fa-toggle-on"></i>

</span>

<div class="info-box-content">

<span class="info-box-text">
Status
</span>

<span class="info-box-number">
<?= $row->status ?>
</span>

</div>

</div>

</div>

<div class="col-md-12">

<div class="card card-body bg-light">

<h4 class="text-primary">

<?= $row->nama_tindakan ?>

</h4>

<hr>

<div class="row">

<div class="col-md-6">

<p>

<strong>Tarif:</strong><br>

Rp <?= number_format($row->tarif,0,',','.') ?>

</p>

</div>

<div class="col-md-6">

<p>

<strong>Jasa Dokter:</strong><br>

Rp <?= number_format($row->jasa_dokter,0,',','.') ?>

</p>

</div>

<div class="col-md-12">

<p>

<strong>Keterangan:</strong><br>

<?= $row->keterangan ?: '-' ?>

</p>

</div>

</div>

</div>

</div>

</div>

</div>

<div class="card-footer text-right">

<a href="<?= base_url('master_tindakan/edit/'.$row->id) ?>"
class="btn btn-warning">

<i class="fas fa-edit"></i>
Edit

</a>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>