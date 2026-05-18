<?php
$this->load->view('template/header');
$this->load->view('template/navbar');
$this->load->view('template/sidebar');
?>

<style>

.edit-wrapper{
    padding:20px;
}

.edit-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

.edit-header{
    background:linear-gradient(
        135deg,
        #007bff,
        #0056b3
    );

    color:white;
    padding:30px;
}

.edit-header h3{
    margin:0;
    font-weight:700;
}

.edit-header p{
    margin-top:8px;
    opacity:0.9;
}

.form-section{
    background:white;
    border-radius:15px;
    padding:25px;
    margin-bottom:20px;
    border:1px solid #f1f1f1;
}

.form-section-title{
    font-size:18px;
    font-weight:700;
    margin-bottom:20px;
    color:#007bff;
}

.form-control{
    border-radius:12px;
    min-height:45px;
    border:1px solid #ddd;
}

.form-control:focus{
    border-color:#007bff;
    box-shadow:none;
}

.form-group label{
    font-weight:600;
    color:#444;
}

.logo-preview{
    width:180px;
    height:180px;
    border-radius:20px;
    object-fit:cover;
    border:5px solid #f1f1f1;
}

.preview-card{
    background:#f8f9fa;
    border-radius:20px;
    padding:25px;
    text-align:center;
    border:1px solid #eee;
}

.btn-modern{
    border-radius:30px;
    padding:10px 25px;
    font-weight:600;
}

.info-box{
    background:#f8f9fa;
    border-radius:15px;
    padding:15px;
    margin-top:20px;
}

.theme-preview{
    width:35px;
    height:35px;
    border-radius:50%;
    display:inline-block;
    margin-right:10px;
}

.badge-modern{
    padding:8px 15px;
    border-radius:30px;
    font-size:12px;
}

</style>

<div class="content-wrapper">

<section class="content edit-wrapper">

<div class="container-fluid">

<div class="card edit-card">

<!-- HEADER -->

<div class="edit-header">

<div class="d-flex justify-content-between align-items-center">

<div>

<h3>

<i class="fas fa-cogs"></i>

Edit Pengaturan SIMRS

</h3>

<p>

Kelola konfigurasi sistem, tema, branding dan identitas klinik

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

<?php if(validation_errors()): ?>

<div class="alert alert-danger">

<?= validation_errors() ?>

</div>

<?php endif; ?>

<?php if($this->session->flashdata('success')): ?>

<div class="alert alert-success">

<?= $this->session->flashdata('success') ?>

</div>

<?php endif; ?>

<form method="POST"

action="<?= base_url('pengaturan/update/'.$detail->id)?>"

enctype="multipart/form-data">

<div class="row">

<!-- LEFT SIDE -->

<div class="col-md-4">

<div class="preview-card">

<?php if($detail->logo!=''): ?>

<img src="<?= base_url('upload/logo/'.$detail->logo)?>"
class="logo-preview">

<?php else: ?>

<img src="<?= base_url('assets/logo.png')?>"
class="logo-preview">

<?php endif; ?>

<h4 class="mt-3">

<?= $detail->nama_klinik ?>

</h4>

<p class="text-muted">

SIMRS Modern Enterprise System

</p>

<hr>

<div class="text-left">

<div class="form-group">

<label>

Upload Logo Baru

</label>

<input type="file"
name="logo"
class="form-control">

</div>

<div class="form-group">

<label>

Upload Favicon

</label>

<input type="file"
name="favicon"
class="form-control">

</div>

</div>

<div class="info-box">

<div class="d-flex justify-content-between">

<span>Status Sistem</span>

<span class="badge badge-success badge-modern">

AKTIF

</span>

</div>

<hr>

<div class="d-flex justify-content-between">

<span>Dark Mode</span>

<span>

<?= $detail->dark_mode ?>

</span>

</div>

</div>

</div>

</div>

<!-- RIGHT SIDE -->

<div class="col-md-8">

<!-- IDENTITAS -->

<div class="form-section">

<div class="form-section-title">

<i class="fas fa-hospital"></i>

Identitas Klinik

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
rows="4"
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

</div>

<!-- TAMPILAN -->

<div class="form-section">

<div class="form-section-title">

<i class="fas fa-palette"></i>

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

<option value="dark"
<?= $detail->tema=='dark' ? 'selected':'' ?>>

⚫ Dark Black

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

<option value="YA"
<?= $detail->dark_mode=='YA' ? 'selected':'' ?>>

🌙 Aktif

</option>

<option value="TIDAK"
<?= $detail->dark_mode=='TIDAK' ? 'selected':'' ?>>

☀ Nonaktif

</option>

</select>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>

Sidebar

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

</div>

<!-- SISTEM -->

<div class="form-section">

<div class="form-section-title">

<i class="fas fa-server"></i>

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

Timezone

</label>

<select
class="form-control">

<option>

Asia/Jakarta

</option>

<option>

Asia/Makassar

</option>

<option>

Asia/Jayapura

</option>

</select>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>

Bahasa Sistem

</label>

<select
class="form-control">

<option>

Indonesia

</option>

<option>

English

</option>

</select>

</div>

</div>

</div>

</div>

<!-- BUTTON -->

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