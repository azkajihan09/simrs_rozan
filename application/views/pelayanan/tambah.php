<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h1>

Tambah Pelayanan Pasien

</h1>

</div>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card card-primary shadow-sm">

<div class="card-header">

<h3 class="card-title">

Form Pelayanan

</h3>

</div>

<form method="POST">

<div class="card-body">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Pasien</label>

<select
name="pasien_id"
class="form-control select2"
required>

<option value="">
-- Pilih Pasien --
</option>

<?php foreach($pasien as $p): ?>

<option value="<?= $p->id ?>">

<?= $p->nama_pasien ?>

- <?= $p->no_rm ?>

</option>

<?php endforeach; ?>

</select>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Dokter</label>

<select
name="dokter_id"
class="form-control select2"
required>

<option value="">
-- Pilih Dokter --
</option>

<?php foreach($dokter as $d): ?>

<option value="<?= $d->id ?>">

<?= $d->nama_dokter ?>

</option>

<?php endforeach; ?>

</select>

</div>

</div>

</div>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Poliklinik</label>

<select
name="poliklinik_id"
class="form-control select2"
required>

<option value="">
-- Pilih Poli --
</option>

<?php foreach($poliklinik as $p): ?>

<option value="<?= $p->id ?>">

<?= $p->nama_poli ?>

</option>

<?php endforeach; ?>

</select>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Status</label>

<input type="text"
class="form-control"
value="MENUNGGU"
readonly>

</div>

</div>

</div>

</div>

<div class="card-footer">

<button type="submit"
class="btn btn-primary">

<i class="fas fa-save"></i>

Simpan

</button>

<a href="<?= base_url('pelayanan')?>"
class="btn btn-secondary">

Kembali

</a>

</div>

</form>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>