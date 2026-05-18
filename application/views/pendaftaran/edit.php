<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">

<h1 class="m-0">

<i class="fas fa-edit text-warning"></i>
Edit Pendaftaran Pasien

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

<div class="card-header bg-warning">

<h3 class="card-title text-white">

Form Edit Pendaftaran

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
class="form-control select2"
required>

<option value="">
-- Pilih Pasien --
</option>

<?php foreach($pasien as $p): ?>

<option
value="<?= $p->id_pasien ?>"

<?= ($row->pasien_id == $p->id_pasien)
? 'selected'
: '' ?>>

<?= $p->no_rm ?>
-
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

<?php foreach($poli as $pl): ?>

<option
value="<?= $pl->id ?>"

<?= ($row->poli_id == $pl->id)
? 'selected'
: '' ?>>

<?= $pl->nama_poli ?>

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

data-poli="<?= $d->poli_id ?>"

<?= ($row->dokter_id == $d->id)
? 'selected'
: '' ?>>

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

<option value="UMUM"
<?= ($row->jenis_pasien == 'UMUM')
? 'selected'
: '' ?>>

UMUM

</option>

<option value="BPJS"
<?= ($row->jenis_pasien == 'BPJS')
? 'selected'
: '' ?>>

BPJS

</option>

<option value="ASURANSI"
<?= ($row->jenis_pasien == 'ASURANSI')
? 'selected'
: '' ?>>

ASURANSI

</option>

</select>

</div>

</div>

<!-- STATUS -->

<div class="col-md-6">

<div class="form-group">

<label>Status</label>

<select name="status"
class="form-control"
required>

<option value="MENUNGGU"
<?= ($row->status == 'MENUNGGU')
? 'selected'
: '' ?>>

MENUNGGU

</option>

<option value="DIPERIKSA"
<?= ($row->status == 'DIPERIKSA')
? 'selected'
: '' ?>>

DIPERIKSA

</option>

<option value="SELESAI"
<?= ($row->status == 'SELESAI')
? 'selected'
: '' ?>>

SELESAI

</option>

</select>

</div>

</div>

</div>

</div>

<div class="card-footer text-right">

<button type="submit"
class="btn btn-warning btn-lg">

<i class="fas fa-save"></i>
Update Pendaftaran

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

    function filterDokter(){

        let poli_id =
            $('#poli_id').val();

        $('#dokter_id option').hide();

        $('#dokter_id option:first').show();

        $('#dokter_id option').each(function(){

            if(
                $(this).data('poli') ==
                poli_id
            ){

                $(this).show();

            }

        });

    }

    filterDokter();

    $('#poli_id').change(function(){

        filterDokter();

        $('#dokter_id').val('');

    });

});

</script>