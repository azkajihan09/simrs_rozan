<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>Edit Pelayanan</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card card-warning">

<div class="card-header">

<h3 class="card-title">

Edit Data Pelayanan

</h3>

</div>

<form method="POST">

<div class="card-body">

<div class="form-group">

<label>Pasien</label>

<select
name="pasien_id"
class="form-control">

<?php foreach($pasien as $p): ?>

<option
value="<?= $p->id ?>"

<?= $detail->pasien_id==$p->id ? 'selected' : '' ?>>

<?= $p->nama_pasien ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="form-group">

<label>Dokter</label>

<select
name="dokter_id"
class="form-control">

<?php foreach($dokter as $d): ?>

<option
value="<?= $d->id ?>"

<?= $detail->dokter_id==$d->id ? 'selected' : '' ?>>

<?= $d->nama_dokter ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="form-group">

<label>Poliklinik</label>

<select
name="poliklinik_id"
class="form-control">

<?php foreach($poliklinik as $p): ?>

<option
value="<?= $p->id ?>"

<?= $detail->poliklinik_id==$p->id ? 'selected' : '' ?>>

<?= $p->nama_poli ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="form-group">

<label>Status</label>

<select
name="status"
class="form-control">

<option
value="MENUNGGU"

<?= $detail->status=='MENUNGGU' ? 'selected' : '' ?>>

MENUNGGU

</option>

<option
value="SELESAI"

<?= $detail->status=='SELESAI' ? 'selected' : '' ?>>

SELESAI

</option>

</select>

</div>

</div>

<div class="card-footer">

<button type="submit"
class="btn btn-warning">

<i class="fas fa-save"></i>

Update

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