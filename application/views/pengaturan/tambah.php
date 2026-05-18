<?php
$this->load->view('template/header');
$this->load->view('template/navbar');
$this->load->view('template/sidebar');
?>

<div class="content-wrapper">

<section class="content p-3">

<div class="container-fluid">

<div class="card">

<div class="card-header bg-primary">

<h3 class="card-title">

Tambah Pengaturan

</h3>

</div>

<div class="card-body">

<form method="POST"
action="<?= base_url('pengaturan/tambah')?>"
enctype="multipart/form-data">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Nama Klinik</label>

<input type="text"
name="nama_klinik"
class="form-control"
required>

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

<label>Alamat</label>

<textarea
name="alamat"
class="form-control"
rows="3"></textarea>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Email</label>

<input type="email"
name="email"
class="form-control">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Tema</label>

<select
name="tema"
class="form-control">

<option value="primary">

Primary

</option>

<option value="success">

Success

</option>

<option value="danger">

Danger

</option>

</select>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Dark Mode</label>

<select
name="dark_mode"
class="form-control">

<option value="TIDAK">

TIDAK

</option>

<option value="YA">

YA

</option>

</select>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Sidebar</label>

<select
name="sidebar"
class="form-control">

<option value="FULL">

FULL

</option>

<option value="MINI">

MINI

</option>

</select>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Logo</label>

<input type="file"
name="logo"
class="form-control">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Favicon</label>

<input type="file"
name="favicon"
class="form-control">

</div>

</div>

<div class="col-md-12">

<button type="submit"
class="btn btn-primary">

<i class="fas fa-save"></i>

Simpan

</button>

<a href="<?= base_url('pengaturan')?>"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</form>

</div>

</div>

</div>

</section>

</div>

<?php
$this->load->view('template/footer');
$this->load->view('template/script');
?>