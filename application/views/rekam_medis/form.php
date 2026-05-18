<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>
    Pemeriksaan Pasien
</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow">

<div class="card-body">

<form method="post"
      action="<?= base_url('rekam_medis/update/'.$rekam_medis->id) ?>">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>No RM</label>

<input type="text"
       class="form-control"
       value="<?= $rekam_medis->no_rm ?>"
       readonly>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Nama Pasien</label>

<input type="text"
       class="form-control"
       value="<?= $rekam_medis->nama_pasien ?>"
       readonly>

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Keluhan</label>

<textarea
name="keluhan"
class="form-control"
rows="3"><?= $rekam_medis->keluhan ?? '' ?></textarea>

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Anamnesa</label>

<textarea
name="anamnesa"
class="form-control"
rows="3"><?= $rekam_medis->anamnesa ?? '' ?></textarea>

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Diagnosa</label>

<textarea
name="diagnosa"
class="form-control"
rows="3"><?= $rekam_medis->diagnosa ?? '' ?></textarea>

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Tindakan</label>

<textarea
name="tindakan"
class="form-control"
rows="3"><?= $rekam_medis->tindakan ?? '' ?></textarea>

</div>

</div>

<div class="col-md-12">

<div class="form-group">
    <div class="form-group">

<label>Tindakan Medis</label>

<select
name="tindakan_id[]"
class="form-control"
multiple>

<?php foreach($master_tindakan as $t): ?>

<option value="<?= $t->id ?>">

<?= $t->nama_tindakan ?>
- Rp <?= number_format($t->tarif) ?>

</option>

<?php endforeach; ?>

</select>

</div>

<label>Catatan Dokter</label>

<textarea
name="catatan"
class="form-control"
rows="3"><?= $rekam_medis->catatan ?? '' ?></textarea>

</div>

</div>

<div class="col-md-12">

<button type="submit"
        class="btn btn-primary">

    <i class="fas fa-save"></i>
    Simpan Pemeriksaan

</button>

<a href="<?= base_url('rekam_medis') ?>"
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

<?php $this->load->view('template/footer'); ?>