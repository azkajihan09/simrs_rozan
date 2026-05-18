<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="row mb-3">

<div class="col-sm-6">

<h1>

<i class="fas fa-pills text-success"></i>
Tambah Resep

</h1>

</div>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-success">

<h3 class="card-title text-white">

Form Resep Obat

</h3>

</div>

<div class="card-body">

<form method="post"
      action="<?= base_url('resep/simpan') ?>">

<input type="hidden"
       name="rekam_medis_id"
       value="<?= $rekam_medis->id ?>">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Nama Pasien</label>

<input type="text"
       class="form-control"
       value="<?= $rekam_medis->nama_pasien ?? '-' ?>"
       readonly>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>No RM</label>

<input type="text"
       class="form-control"
       value="<?= $rekam_medis->no_rm ?? '-' ?>"
       readonly>

</div>

</div>

</div>

<hr>

<div id="obat-wrapper">

<div class="row obat-item mb-3">

<div class="col-md-4">

<label>Obat</label>

<select name="obat_id[]"
        class="form-control"
        required>

<option value="">
    -- pilih obat --
</option>

<?php foreach($obat as $o): ?>

<option value="<?= $o->id ?>">

<?= $o->nama_obat ?>
(Stok: <?= $o->stok ?>)

</option>

<?php endforeach; ?>

</select>

</div>

<div class="col-md-2">

<label>Qty</label>

<input type="number"
       name="qty[]"
       class="form-control"
       required>

</div>

<div class="col-md-4">

<label>Aturan Pakai</label>

<input type="text"
       name="aturan[]"
       class="form-control"
       placeholder="3x1 sesudah makan">

</div>

<div class="col-md-2">

<label>&nbsp;</label>

<button type="button"
        class="btn btn-danger btn-block hapus-obat">

    Hapus

</button>

</div>

</div>

</div>

<button type="button"
        id="tambah-obat"
        class="btn btn-info">

<i class="fas fa-plus"></i>
Tambah Obat

</button>

<hr>

<div class="form-group">

<label>Catatan Resep</label>

<textarea
name="catatan"
class="form-control"
rows="3"></textarea>

</div>

<button type="submit"
        class="btn btn-success">

<i class="fas fa-save"></i>
Simpan Resep

</button>

<a href="<?= base_url('rekam_medis') ?>"
   class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</section>

</div>

<script>

$('#tambah-obat').click(function(){

    var html =
        $('.obat-item:first').clone();

    html.find('input').val('');
    html.find('select').val('');

    $('#obat-wrapper').append(html);

});

$(document).on(
    'click',
    '.hapus-obat',
    function(){

        if($('.obat-item').length > 1){

            $(this)
                .closest('.obat-item')
                .remove();

        }

    }
);

</script>

<?php $this->load->view('template/footer'); ?>