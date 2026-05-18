<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<div class="card">

<div class="card-header">

<h3>Tambah Obat</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Kode Obat</label>

<input type="text"
name="kode_obat"
class="form-control"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Nama Obat</label>

<input type="text"
name="nama_obat"
class="form-control"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Kategori</label>

<input type="text"
name="kategori"
class="form-control">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Stok</label>

<input type="number"
name="stok"
class="form-control">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Satuan</label>

<input type="text"
name="satuan"
class="form-control">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Harga Beli</label>

<input type="number"
name="harga_beli"
class="form-control">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Harga Jual</label>

<input type="number"
name="harga_jual"
class="form-control">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Expired Date</label>

<input type="date"
name="expired_date"
class="form-control">

</div>

</div>

<div class="col-md-12">

<button type="submit"
class="btn btn-primary">

Simpan

</button>

<a href="<?= base_url('farmasi')?>"
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