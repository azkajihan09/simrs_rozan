<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<div class="card card-primary">

<div class="card-header">

<h3 class="card-title">

Tambah Permintaan Radiologi

</h3>

</div>

<div class="card-body">

<?php if(validation_errors()): ?>

<div class="alert alert-danger">

<?= validation_errors(); ?>

</div>

<?php endif; ?>

<form method="POST">

<input type="hidden"

name="<?= $this->security->get_csrf_token_name(); ?>"

value="<?= $this->security->get_csrf_hash(); ?>">

<div class="row">

<div class="col-md-12">

<div class="form-group">

<label>Pilih Pasien Rekam Medis</label>

<select
name="rekam_medis_id"
id="rekam_medis_id"
class="form-control"
required>

<option value="">

-- Pilih Pasien --

</option>

<?php foreach($rekammedis as $r): ?>

<option
value="<?= $r->id ?>"
data-pasien="<?= $r->pasien_id ?>"
data-dokter="<?= $r->dokter_id ?>">

<?= $r->no_rm ?>

- <?= $r->nama_pasien ?>

- <?= $r->nama_dokter ?>

</option>

<?php endforeach; ?>

</select>

</div>

</div>

<input type="hidden"
name="pasien_id"
id="pasien_id">

<input type="hidden"
name="dokter_id"
id="dokter_id">

<div class="col-md-12">

<div class="form-group">

<label>Jenis Pemeriksaan Radiologi</label>

<select
name="jenis_pemeriksaan"
class="form-control"
required>

<option value="">

-- Pilih Pemeriksaan --

</option>

<option value="Rontgen Thorax">

Rontgen Thorax

</option>

<option value="CT Scan Kepala">

CT Scan Kepala

</option>

<option value="USG Abdomen">

USG Abdomen

</option>

<option value="USG Kandungan">

USG Kandungan

</option>

<option value="MRI">

MRI

</option>

<option value="Rontgen Tulang">

Rontgen Tulang

</option>

</select>

</div>

</div>

<div class="col-md-12">

<div class="form-group">

<label>Catatan Permintaan</label>

<textarea
name="hasil"
class="form-control"
rows="5"
placeholder="Catatan dokter / indikasi pemeriksaan"></textarea>

</div>

</div>

<div class="col-md-12">

<button type="submit"
class="btn btn-primary">

Simpan Permintaan

</button>

<a href="<?= base_url('radiologi')?>"
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

<script>

$('#rekam_medis_id').change(function(){

    let pasien = $(this).find(':selected').data('pasien');

    let dokter = $(this).find(':selected').data('dokter');

    $('#pasien_id').val(pasien);

    $('#dokter_id').val(dokter);

});

</script>