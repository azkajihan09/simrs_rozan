<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<style>

.setting-card{
    border:none;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.setting-header{
    background:linear-gradient(
        45deg,
        #007bff,
        #0056b3
    );

    color:white;
    padding:25px;
}

.setting-header h3{
    font-weight:700;
    margin-bottom:5px;
}

.nav-pills .nav-link{
    border-radius:12px;
    margin-bottom:10px;
    color:#444;
    font-weight:600;
    transition:0.3s;
}

.nav-pills .nav-link.active{
    background:#007bff;
    color:white;
}

.form-control{
    border-radius:10px;
}

.form-group label{
    font-weight:600;
}

.info-box-custom{
    background:white;
    border-radius:15px;
    padding:20px;
    text-align:center;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
    transition:0.3s;
}

.info-box-custom:hover{
    transform:translateY(-5px);
}

.info-box-custom i{
    font-size:40px;
    margin-bottom:10px;
}

.logo-preview{
    width:120px;
    height:120px;
    border-radius:15px;
    object-fit:cover;
    border:4px solid #f1f1f1;
}

.btn-modern{
    border-radius:30px;
    padding:10px 20px;
    font-weight:600;
}

.bg-soft-primary{
    background:#eef5ff;
}

.bg-soft-success{
    background:#edfdf3;
}

.bg-soft-warning{
    background:#fff8e6;
}

.bg-soft-danger{
    background:#fff0f0;
}

.server-box{
    background:#f8f9fa;
    border-radius:12px;
    padding:15px;
    margin-bottom:15px;
}

.theme-preview{
    width:35px;
    height:35px;
    border-radius:50%;
    display:inline-block;
    margin-right:10px;
}

</style>

<div class="content-wrapper">

<section class="content p-3">

<div class="container-fluid">

<!-- HEADER -->

<div class="setting-card mb-4">

<div class="setting-header">

<div class="d-flex justify-content-between align-items-center">

<div>

<h3>

<i class="fas fa-cogs"></i>

Pengaturan SIMRS Klinik Rozan

</h3>

<p class="mb-0">

Konfigurasi sistem, tampilan, keamanan dan backup database

</p>

</div>

<div>

<a href="<?= base_url('pengaturan/backup_database')?>"
class="btn btn-light btn-modern">

<i class="fas fa-database"></i>

Backup Database

</a>

</div>

</div>

</div>

</div>

<!-- INFO BOX -->

<div class="row mb-4">

<div class="col-md-3">

<div class="info-box-custom bg-soft-primary">

<i class="fas fa-hospital text-primary"></i>

<h5>Klinik</h5>

<p class="mb-0">

<?= $setting[0]->nama_klinik ?>

</p>

</div>

</div>

<div class="col-md-3">

<div class="info-box-custom bg-soft-success">

<i class="fas fa-users text-success"></i>

<h5>User Online</h5>

<p class="mb-0">

<?= $this->db->count_all('users') ?>

Pengguna

</p>

</div>

</div>

<div class="col-md-3">

<div class="info-box-custom bg-soft-warning">

<i class="fas fa-server text-warning"></i>

<h5>Server</h5>

<p class="mb-0">

PHP <?= phpversion() ?>

</p>

</div>

</div>

<div class="col-md-3">

<div class="info-box-custom bg-soft-danger">

<i class="fas fa-network-wired text-danger"></i>

<h5>IP User</h5>

<p class="mb-0">

<?= $_SERVER['REMOTE_ADDR'] ?>

</p>

</div>

</div>

</div>

<!-- CONTENT -->

<div class="row">

<!-- MENU -->

<div class="col-md-3">

<div class="card setting-card">

<div class="card-body">

<div class="nav flex-column nav-pills"
id="v-pills-tab"
role="tablist">

<a class="nav-link active"
id="umum-tab"
data-toggle="pill"
href="#umum">

<i class="fas fa-building"></i>

Pengaturan Umum

</a>

<a class="nav-link"
id="tampilan-tab"
data-toggle="pill"
href="#tampilan">

<i class="fas fa-palette"></i>

Tampilan Sistem

</a>

<a class="nav-link"
id="server-tab"
data-toggle="pill"
href="#server">

<i class="fas fa-server"></i>

Informasi Server

</a>

<a class="nav-link"
id="backup-tab"
data-toggle="pill"
href="#backup">

<i class="fas fa-database"></i>

Backup Database

</a>

<a class="nav-link"
id="security-tab"
data-toggle="pill"
href="#security">

<i class="fas fa-shield-alt"></i>

Keamanan Sistem

</a>

</div>

</div>

</div>

</div>

<!-- CONTENT -->

<div class="col-md-9">

<div class="card setting-card">

<div class="card-body">

<div class="tab-content">

<!-- UMUM -->

<div class="tab-pane fade show active"
id="umum">

<form method="POST"
action="<?= base_url('pengaturan/update')?>"
enctype="multipart/form-data">

<div class="row">

<div class="col-md-4 text-center">

<?php if($setting[0]->logo!=''): ?>

<img src="<?= base_url('upload/logo/'.$setting[0]->logo)?>"
class="logo-preview mb-3">

<?php else: ?>

<img src="<?= base_url('assets/logo.png')?>"
class="logo-preview mb-3">

<?php endif; ?>

<div class="form-group">

<input type="file"
name="logo"
class="form-control">

</div>

</div>

<div class="col-md-8">

<div class="form-group">

<label>Nama Klinik</label>

<input type="text"
name="nama_klinik"
class="form-control"
value="<?= $setting[0]->nama_klinik ?>">

</div>

<div class="form-group">

<label>Alamat</label>

<textarea
name="alamat"
class="form-control"
rows="3"><?= $setting[0]->alamat ?></textarea>

</div>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Telepon</label>

<input type="text"
name="telepon"
class="form-control"
value="<?= $setting[0]->telepon ?>">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Email</label>

<input type="email"
name="email"
class="form-control"
value="<?= $setting[0]->email ?>">

</div>

</div>

</div>

</div>

</div>

<button type="submit"
class="btn btn-primary btn-modern">

<i class="fas fa-save"></i>

Simpan Pengaturan

</button>

</form>

</div>

<!-- TAMPILAN -->

<div class="tab-pane fade"
id="tampilan">

<form method="POST"
action="<?= base_url('pengaturan/update')?>">

<div class="form-group">

<label>Tema Sistem</label>

<select
name="tema"
class="form-control">

<option value="primary">

🔵 Primary Blue

</option>

<option value="success">

🟢 Success Green

</option>

<option value="danger">

🔴 Danger Red

</option>

<option value="warning">

🟡 Warning Yellow

</option>

</select>

</div>

<div class="form-group">

<label>Dark Mode</label>

<select
name="dark_mode"
class="form-control">

<option value="TIDAK">

☀ Light Mode

</option>

<option value="YA">

🌙 Dark Mode

</option>

</select>

</div>

<div class="form-group">

<label>Sidebar Mode</label>

<select
name="sidebar"
class="form-control">

<option value="FULL">

FULL SIDEBAR

</option>

<option value="MINI">

MINI SIDEBAR

</option>

</select>

</div>

<button type="submit"
class="btn btn-success btn-modern">

<i class="fas fa-palette"></i>

Simpan Tampilan

</button>

</form>

</div>

<!-- SERVER -->

<div class="tab-pane fade"
id="server">

<div class="server-box">

<h5>

<i class="fas fa-server text-primary"></i>

Informasi Server

</h5>

<hr>

<p>

<b>PHP Version :</b>
<?= phpversion() ?>

</p>

<p>

<b>CodeIgniter :</b>
3.x

</p>

<p>

<b>Server Time :</b>
<?= date('Y-m-d H:i:s') ?>

</p>

<p>

<b>IP Address :</b>
<?= $_SERVER['REMOTE_ADDR'] ?>

</p>

<p>

<b>Operating System :</b>
<?= PHP_OS ?>

</p>

</div>

</div>

<!-- BACKUP -->

<div class="tab-pane fade"
id="backup">

<div class="alert alert-success">

<h5>

<i class="fas fa-database"></i>

Backup Database SIMRS

</h5>

<hr>

Backup akan menyimpan:

<ul>

<li>Data pasien</li>
<li>Rekam medis</li>
<li>Billing</li>
<li>Farmasi</li>
<li>Kasir</li>
<li>Pengaturan sistem</li>

</ul>

</div>

<a href="<?= base_url('pengaturan/backup_database')?>"
class="btn btn-success btn-modern">

<i class="fas fa-download"></i>

Download Backup

</a>

</div>

<!-- SECURITY -->

<div class="tab-pane fade"
id="security">

<div class="alert alert-info">

<h5>

<i class="fas fa-shield-alt"></i>

Keamanan Sistem

</h5>

<hr>

<p>

✔ Session Login Aktif

</p>

<p>

✔ User Authentication Enabled

</p>

<p>

✔ Database Protected

</p>

<p>

✔ Role Access Active

</p>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>