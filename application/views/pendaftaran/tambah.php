<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">

<h1 class="m-0">

<i class="fas fa-user-plus text-primary"></i>
Pendaftaran Pasien

</h1>

<a href="<?= base_url('pendaftaran') ?>"
class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>
Kembali

</a>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow-lg border-0">

<div class="card-header bg-gradient-primary">

<h3 class="card-title text-white">

Form Registrasi Pasien

</h3>

</div>

<form method="POST">

<div class="card-body">

<div class="row">

<!-- PASIEN -->

<div class="col-md-12">

<div class="form-group">

<label>Pilih Pasien</label>

<select name="pasien_id"
id="pasien_id"
class="form-control select2"
required>

<option value="">
-- Pilih Pasien --
</option>

<?php foreach($pasien as $p): ?>

<option value="<?= $p->id_pasien ?>">

<?= $p->no_rm ?> -
<?= $p->nama_pasien ?>

</option>

<?php endforeach; ?>

</select>

</div>

</div>

<!-- POLI -->

<div class="col-md-6">

<div class="form-group">

<label>Poliklinik</label>

<select name="poli_id"
id="poli_id"
class="form-control"
required>

<option value="">
-- Pilih Poli --
</option>

<?php foreach($poli as $row): ?>

<option value="<?= $row->id ?>">

<?= $row->nama_poli ?>

</option>

<?php endforeach; ?>

</select>

</div>

</div>

<!-- DOKTER -->

<div class="col-md-6">

<div class="form-group">

<label>Dokter</label>

<select name="dokter_id"
id="dokter_id"
class="form-control"
required>

<option value="">
-- Pilih Dokter --
</option>

<?php foreach($dokter as $d): ?>

<option
    value="<?= $d->id ?>"
    data-poli="<?= $d->poli_id ?>">

    <?= $d->nama_dokter ?>

</option>

<?php endforeach; ?>

</select>
</div>

</div>

<!-- JENIS PASIEN -->

<div class="col-md-6">

<div class="form-group">

<label>Jenis Pasien</label>

<select name="jenis_pasien"
class="form-control"
required>

<option value="UMUM">
UMUM
</option>

<option value="BPJS">
BPJS
</option>

<option value="ASURANSI">
ASURANSI
</option>

</select>

</div>

</div>

<!-- TANGGAL -->

<div class="col-md-6">

<div class="form-group">

<label>Tanggal Registrasi</label>

<input type="date"
class="form-control"
value="<?= date('Y-m-d') ?>"
readonly>

</div>

</div>

<!-- KELUHAN -->

<div class="col-md-12">

<div class="form-group">

<label>Keluhan Awal</label>

<textarea name="keluhan"
class="form-control"
rows="4"
placeholder="Masukkan keluhan pasien..."></textarea>

</div>

</div>

</div>

</div>

<div class="card-footer text-right">

<button type="submit"
class="btn btn-primary btn-lg">

<i class="fas fa-save"></i>
Daftarkan Pasien

</button>

</div>

</form>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>

<script>

$(document).ready(function(){

    $('.select2').select2({
        width:'100%'
    });

    $('#poli_id').change(function(){

        let poli_id = $(this).val();

        $('#dokter_id option').hide();

        $('#dokter_id option:first').show();

        $('#dokter_id option').each(function(){

            if($(this).data('poli') == poli_id){

                $(this).show();

            }

        });

        $('#dokter_id').val('');

    });

});

</script>