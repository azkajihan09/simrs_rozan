<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center">

<h1 class="m-0">

<i class="fas fa-edit text-warning"></i>
Edit Tindakan

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

<div class="card-header bg-warning">

<h3 class="card-title">

Update Data Tindakan

</h3>

</div>

<form method="POST">

<div class="card-body">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Kode Tindakan</label>

<input type="text"
name="kode_tindakan"
class="form-control form-control-lg"
value="<?= $row->kode_tindakan ?>"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Status</label>

<select name="status"
class="form-control form-control-lg">

<option value="AKTIF"
<?= $row->status == 'AKTIF' ? 'selected' : '' ?>>

AKTIF

</option>

<option value="NONAKTIF"
<?= $row->status == 'NONAKTIF' ? 'selected' : '' ?>>

NONAKTIF

</option>

</select>

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Nama Tindakan</label>

<input type="text"
name="nama_tindakan"
class="form-control form-control-lg"
value="<?= $row->nama_tindakan ?>"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Tarif</label>

<input type="number"
name="tarif"
class="form-control form-control-lg"
value="<?= $row->tarif ?>"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Jasa Dokter</label>

<input type="number"
name="jasa_dokter"
class="form-control form-control-lg"
value="<?= $row->jasa_dokter ?>"
required>

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Keterangan</label>

<textarea name="keterangan"
class="form-control"
rows="4"><?= $row->keterangan ?></textarea>

</div>

</div>

</div>

</div>

<div class="card-footer text-right">

<button type="submit"
class="btn btn-warning btn-lg">

<i class="fas fa-save"></i>
Update Data

</button>

</div>

</form>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>