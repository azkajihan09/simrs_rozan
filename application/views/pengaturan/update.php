<?php
$this->load->view('template/header');
$this->load->view('template/navbar');
$this->load->view('template/sidebar');
?>

<style>

.update-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

.update-header{
    background:linear-gradient(
        45deg,
        #007bff,
        #0056b3
    );

    color:white;
    padding:25px;
}

.update-header h3{
    margin:0;
    font-weight:700;
}

.form-control{
    border-radius:12px;
    min-height:45px;
    border:1px solid #ddd;
}

.form-control:focus{
    box-shadow:none;
    border-color:#007bff;
}

.form-group label{
    font-weight:600;
    color:#444;
}

.logo-preview{
    width:150px;
    height:150px;
    object-fit:cover;
    border-radius:15px;
    border:4px solid #f1f1f1;
    margin-bottom:15px;
}

.preview-box{
    background:#f8f9fa;
    border-radius:15px;
    padding:20px;
    text-align:center;
}

.btn-modern{
    border-radius:30px;
    padding:10px 25px;
    font-weight:600;
}

.info-alert{
    border-radius:15px;
}

.section-title{
    font-size:18px;
    font-weight:700;
    margin-bottom:20px;
    color:#007bff;
}

</style>

<div class="content-wrapper">

<section class="content p-3">

<div class="container-fluid">

<div class="card update-card">

<!-- HEADER -->

<div class="update-header">

<div class="d-flex justify-content-between align-items-center">

<div>

<h3>

<i class="fas fa-cogs"></i>

Update Pengaturan SIMRS

</h3>

<p class="mb-0">

Konfigurasi modern sistem klinik dan enterprise dashboard

</p>

</div>

<div>

<a href="<?= base_url('pengaturan')?>"
class="btn btn-light btn-modern">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

</div>

</div>

</div>

<!-- BODY -->

<div class="card-body">

<!-- ERROR -->

<?php if(validation_errors()): ?>

<div class="alert alert-danger info-alert">

<?= validation_errors() ?>

</div>

<?php endif; ?>

<!-- SUCCESS -->

<?php if($this->session->flashdata('success')): ?>

<div class="alert alert-success info-alert">

<?= $this->session->flashdata('success') ?>

</div>

<?php endif; ?>

<!-- FORM -->

<form method="POST"

action="<?= base_url('pengaturan/update/'.$detail->id)?>"

enctype="multipart/form-data">

<div class="row">

<!-- LEFT -->

<div class="col-md-4">

<div class="preview-box">

<?php if($detail->logo!=''): ?>

<img src="<?= base_url('upload/logo/'.$detail->logo)?>"
class="logo-preview">

<?php else: ?>

<img src="<?= base_url('assets/logo.png')?>"
class="logo-preview">

<?php endif; ?>

<h5>

<?= $detail->nama_klinik ?>

</h5>

<p class="text-muted">

SIMRS Modern Enterprise

</p>

<hr>

<div class="form-group text-left">

<label>

Upload Logo Baru

</label>

<input type="file"
name="logo"
class="form-control">

</div>

<div class="form-group text-left">

<label>

Upload Favicon

</label>

<input type="file"
name="favicon"
class="form-control">

</div>

</div>

</div>

<!-- RIGHT -->

<div class="col-md-8">

<div class="section-title">

Informasi Klinik

</div>

<div class="row">

<div class="col-md-12">

<div class="form-group">

<label>

Nama Klinik

</label>

<input type="text"
name="nama_klinik"
class="form-control"
value="<?= $detail->nama_klinik ?>">

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>

Alamat Klinik

</label>

<textarea
name="alamat"
rows="3"
class="form-control"><?= $detail->alamat ?></textarea>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>

Telepon

</label>

<input type="text"
name="telepon"
class="form-control"
value="<?= $detail->telepon ?>">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>

Email

</label>

<input type="email"
name="email"
class="form-control"
value="<?= $detail->email ?>">

</div>

</div>

</div>

<hr>

<div class="section-title">

Pengaturan Tampilan

</div>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>

Tema Sistem

</label>

<select
name="tema"
class="form-control">

<option value="primary"
<?= $detail->tema=='primary' ? 'selected':'' ?>>

🔵 Primary Blue

</option>

<option value="success"
<?= $detail->tema=='success' ? 'selected':'' ?>>

🟢 Success Green

</option>

<option value="danger"
<?= $detail->tema=='danger' ? 'selected':'' ?>>

🔴 Danger Red

</option>

<option value="warning"
<?= $detail->tema=='warning' ? 'selected':'' ?>>

🟡 Warning Yellow

</option>

</select>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>

Dark Mode

</label>

<select
name="dark_mode"
class="form-control">

<option value="TIDAK"
<?= $detail->dark_mode=='TIDAK' ? 'selected':'' ?>>

☀ Light Mode

</option>

<option value="YA"
<?= $detail->dark_mode=='YA' ? 'selected':'' ?>>

🌙 Dark Mode

</option>

</select>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>

Sidebar Mode

</label>

<select
name="sidebar"
class="form-control">

<option value="FULL"
<?= $detail->sidebar=='FULL' ? 'selected':'' ?>>

FULL SIDEBAR

</option>

<option value="MINI"
<?= $detail->sidebar=='MINI' ? 'selected':'' ?>>

MINI SIDEBAR

</option>

</select>

</div>

</div>

</div>

<hr>

<div class="section-title">

Pengaturan Sistem

</div>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>

Prefix Nomor RM

</label>

<input type="text"
name="nomor_rm_prefix"
class="form-control"
value="<?= $detail->nomor_rm_prefix ?>">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>

Prefix Nomor Antrian

</label>

<input type="text"
name="nomor_antrian_prefix"
class="form-control"
value="<?= $detail->nomor_antrian_prefix ?>">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>

Status Sistem

</label>

<select
name="status"
class="form-control">

<option value="AKTIF">

AKTIF

</option>

<option value="NONAKTIF">

NONAKTIF

</option>

</select>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>

Timezone

</label>

<select
name="timezone"
class="form-control">

<option value="Asia/Jakarta">

Asia/Jakarta

</option>

<option value="Asia/Makassar">

Asia/Makassar

</option>

<option value="Asia/Jayapura">

Asia/Jayapura

</option>

</select>

</div>

</div>

</div>

<hr>

<div class="text-right">

<button type="submit"
class="btn btn-primary btn-modern">

<i class="fas fa-save"></i>

Update Pengaturan

</button>

<a href="<?= base_url('pengaturan')?>"
class="btn btn-secondary btn-modern">

Batal

</a>

</div>

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

<script>

$(document).ready(function(){

    $('.select2').select2();

});

</script>