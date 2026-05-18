<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<div class="card">

<div class="card-header">

<h3>Tambah Dokter</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Poliklinik</label>

<select name="poli_id"
class="form-control"
required>

<option value="">-- Pilih Poli --</option>

<?php foreach($poli as $p): ?>

<option value="<?= $p->id ?>">

<?= $p->nama_poli ?>

</option>

<?php endforeach; ?>

</select>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Nama Dokter</label>

<input type="text"
name="nama_dokter"
class="form-control"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Spesialis</label>

<input type="text"
name="spesialis"
class="form-control">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>No SIP</label>

<input type="text"
name="sip"
class="form-control">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>STR Dokter</label>

<input type="text"
name="str_dokter"
class="form-control">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Telepon</label>

<input type="text"
name="telepon"
class="form-control">

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Jadwal</label>

<textarea name="jadwal"
class="form-control"></textarea>

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Alamat</label>

<textarea name="alamat"
class="form-control"></textarea>

</div>

</div>

<div class="col-md-12">

<button type="submit"
class="btn btn-primary">

Simpan

</button>

<a href="<?= base_url('dokter')?>"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</form>

</div>

</div>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>