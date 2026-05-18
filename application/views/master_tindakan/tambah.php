<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center">

<h1 class="m-0">

<i class="fas fa-plus-circle text-primary"></i>
Tambah Tindakan

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

<div class="card border-0 shadow-lg rounded-lg">

<div class="card-header bg-gradient-primary">

<h3 class="card-title text-white">

Form Master Tindakan

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
placeholder="Contoh: TDK001"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Status</label>

<select name="status"
class="form-control form-control-lg">

<option value="AKTIF">AKTIF</option>
<option value="NONAKTIF">NONAKTIF</option>

</select>

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Nama Tindakan</label>

<input type="text"
name="nama_tindakan"
class="form-control form-control-lg"
placeholder="Masukkan nama tindakan"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Tarif Tindakan</label>

<input type="number"
name="tarif"
class="form-control form-control-lg"
placeholder="0"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Jasa Dokter</label>

<input type="number"
name="jasa_dokter"
class="form-control form-control-lg"
placeholder="0"
required>

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Keterangan</label>

<textarea name="keterangan"
class="form-control"
rows="4"
placeholder="Keterangan tindakan..."></textarea>

</div>

</div>

</div>

</div>

<div class="card-footer text-right">

<button type="submit"
class="btn btn-primary btn-lg">

<i class="fas fa-save"></i>
Simpan Data

</button>

</div>

</form>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>