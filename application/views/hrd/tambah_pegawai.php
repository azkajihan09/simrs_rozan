<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<div class="card card-primary">

<div class="card-header">

<h3 class="card-title">

Tambah Pegawai

</h3>

</div>

<div class="card-body">

<form method="POST">

<input type="hidden"

name="<?= $this->security->get_csrf_token_name(); ?>"

value="<?= $this->security->get_csrf_hash(); ?>">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>NIK Pegawai</label>

<input type="text"
name="nik"
class="form-control"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Nama Pegawai</label>

<input type="text"
name="nama_pegawai"
class="form-control"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Jabatan</label>

<input type="text"
name="jabatan"
class="form-control"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Jenis Pegawai</label>

<select
name="jenis_pegawai"
class="form-control"
required>

<option value="">

-- Pilih --

</option>

<option value="DOKTER">

DOKTER

</option>

<option value="STAFF">

STAFF

</option>

<option value="ADMIN">

ADMIN

</option>

</select>

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

<div class="col-md-6">

<div class="form-group">

<label>Gaji Pokok</label>

<input type="number"
name="gaji_pokok"
class="form-control"
required>

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Alamat</label>

<textarea
name="alamat"
class="form-control"
rows="4"></textarea>

</div>

</div>

<div class="col-md-12">

<button type="submit"
class="btn btn-primary">

Simpan Pegawai

</button>

<a href="<?= base_url('hrd/pegawai')?>"
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