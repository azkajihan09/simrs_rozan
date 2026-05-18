<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<div class="card card-warning">

<div class="card-header">

<h3 class="card-title">

Edit Rekam Medis

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

<label>Keluhan</label>

<textarea
name="keluhan"
class="form-control"
rows="3"
required><?= $detail->keluhan ?></textarea>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Tindakan</label>

<textarea
name="tindakan"
class="form-control"
rows="3"><?= $detail->tindakan ?></textarea>

</div>

</div>

<div class="col-md-3">

<div class="form-group">

<label>Tekanan Darah</label>

<input type="text"
name="tekanan_darah"
class="form-control"
value="<?= $detail->tekanan_darah ?>">

</div>

</div>

<div class="col-md-3">

<div class="form-group">

<label>Suhu</label>

<input type="text"
name="suhu"
class="form-control"
value="<?= $detail->suhu ?>">

</div>

</div>

<div class="col-md-3">

<div class="form-group">

<label>Berat Badan</label>

<input type="text"
name="berat_badan"
class="form-control"
value="<?= $detail->berat_badan ?>">

</div>

</div>

<div class="col-md-3">

<div class="form-group">

<label>Tinggi Badan</label>

<input type="text"
name="tinggi_badan"
class="form-control"
value="<?= $detail->tinggi_badan ?>">

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Diagnosa</label>

<select name="diagnosa_id"
class="form-control"
required>

<?php foreach($diagnosa as $d): ?>

<option value="<?= $d->id ?>"

<?php if($detail->diagnosa_id == $d->id) echo 'selected'; ?>>

<?= $d->kode_icd ?>

- <?= $d->nama_diagnosa ?>

</option>

<?php endforeach; ?>

</select>

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Resep Obat</label>

<textarea
name="resep_obat"
class="form-control"
rows="4"><?= $detail->resep_obat ?></textarea>

<div class="form-group">

<label>Cari Obat</label>

<input type="text"
id="searchObat"
class="form-control"
placeholder="Cari Obat...">

</div>

<div id="resultObat"></div>

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Catatan Dokter</label>

<textarea
name="catatan_dokter"
class="form-control"
rows="4"><?= $detail->catatan_dokter ?></textarea>

</div>

</div>

<div class="col-md-12">

<button type="submit"
class="btn btn-warning">

Update Rekam Medis

</button>

<a href="<?= base_url('rekam_medis')?>"
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