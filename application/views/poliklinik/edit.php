<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content p-3">

<div class="container-fluid">

<div class="card card-warning">

<div class="card-header">

<h3 class="card-title">

Edit Poliklinik

</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="form-group">

<label>Kode Poli</label>

<input type="text"
name="kode_poli"
class="form-control"
value="<?= $detail->kode_poli ?>"
required>

</div>

<div class="form-group">

<label>Nama Poli</label>

<input type="text"
name="nama_poli"
class="form-control"
value="<?= $detail->nama_poli ?>"
required>

</div>

<div class="form-group">

<label>Keterangan</label>

<textarea
name="keterangan"
class="form-control"
rows="4"><?= $detail->keterangan ?></textarea>

</div>

<button type="submit"
class="btn btn-warning">

Update

</button>

<a href="<?= base_url('poliklinik')?>"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>