<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-4 futuristic-bg">

<section class="content-header mb-4">

<h1 class="text-white">

<i class="fas fa-notes-medical text-success"></i>
Input Resep Obat

</h1>

</section>

<section class="content">

<form method="POST">

<div class="card glass-card">

<div class="card-body">

<div class="alert alert-info">

<strong>Pasien:</strong>
<?= $rm->nama_pasien ?>

<br>

<strong>Dokter:</strong>
<?= $rm->nama_dokter ?>

</div>

<div id="obat-wrapper">

<div class="row obat-item mb-3">

<div class="col-md-5">

<select name="obat_id[]"
class="form-control"
required>

<option value="">
-- Pilih Obat --
</option>

<?php foreach($obat as $o): ?>

<option value="<?= $o->id_obat ?>">

<?= $o->nama_obat ?>
(Stok: <?= $o->stok ?>)

</option>

<?php endforeach; ?>

</select>

</div>

<div class="col-md-2">

<input type="number"
name="qty[]"
class="form-control"
placeholder="Qty"
required>

</div>

<div class="col-md-5">

<input type="text"
name="aturan_pakai[]"
class="form-control"
placeholder="Aturan Pakai"
required>

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

<label class="text-white">

Catatan

</label>

<textarea name="catatan"
class="form-control"></textarea>

</div>

<button type="submit"
class="btn btn-success btn-lg btn-block">

<i class="fas fa-save"></i>
Simpan Resep

</button>

</div>

</div>

</form>

</section>

</div>

<script>

$('#tambah-obat').click(function(){

let html = $('.obat-item:first').clone();

html.find('input').val('');

html.find('select').val('');

$('#obat-wrapper').append(html);

});

</script>

<style>

.futuristic-bg{
background:#0f172a;
min-height:100vh;
}

.glass-card{
background:rgba(255,255,255,0.05);
border:none;
border-radius:20px;
backdrop-filter:blur(10px);
box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

</style>

<?php $this->load->view('template/footer'); ?>