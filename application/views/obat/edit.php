<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h1>Edit Obat</h1>

</div>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card card-warning">

<div class="card-header">

<h3 class="card-title">

Form Edit Obat

</h3>

</div>

<form method="POST">

<div class="card-body">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Kode Obat</label>

<input type="text"
name="kode_obat"
class="form-control"
value="<?= $detail->kode_obat ?>"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Nama Obat</label>

<input type="text"
name="nama_obat"
class="form-control"
value="<?= $detail->nama_obat ?>"
required>

</div>

</div>

</div>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Kategori</label>

<input type="text"
name="kategori"
class="form-control"
value="<?= $detail->kategori ?>">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Satuan</label>

<input type="text"
name="satuan"
class="form-control"
value="<?= $detail->satuan ?>">

</div>

</div>

</div>

<div class="row">

<div class="col-md-4">

<div class="form-group">

<label>Stok</label>

<input type="number"
name="stok"
class="form-control"
value="<?= $detail->stok ?>">

</div>

</div>

<div class="col-md-4">

<div class="form-group">

<label>Stok Minimal</label>

<input type="number"
name="stok_minimal"
class="form-control"
value="<?= $detail->stok_minimal ?>">

</div>

</div>

<div class="col-md-4">

<div class="form-group">

<label>Expired Date</label>

<input type="date"
name="expired_date"
class="form-control"
value="<?= $detail->expired_date ?>">

</div>

</div>

</div>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Harga Beli</label>

<input type="number"
name="harga_beli"
class="form-control"
value="<?= $detail->harga_beli ?>">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Harga Jual</label>

<input type="number"
name="harga_jual"
class="form-control"
value="<?= $detail->harga_jual ?>">

</div>

</div>

</div>

</div>

<div class="card-footer">

<button type="submit"
class="btn btn-warning">

<i class="fas fa-save"></i>

Update

</button>

<a href="<?= base_url('obat')?>"
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