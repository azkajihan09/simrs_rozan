<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>

Detail Resep

</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-primary">

<h3 class="card-title text-white">

<?= $resep->kode_resep ?>

</h3>

</div>

<div class="card-body">

<div class="row mb-4">

<div class="col-md-6">

<table class="table table-bordered">

<tr>

<th width="40%">
Pasien
</th>

<td>
<?= $resep->nama_pasien ?>
</td>

</tr>

<tr>

<th>No RM</th>

<td>
<?= $resep->no_rm ?>
</td>

</tr>

<tr>

<th>Dokter</th>

<td>
<?= $resep->nama_dokter ?>
</td>

</tr>

<tr>

<th>Status</th>

<td>

<span class="badge badge-info">

<?= $resep->status ?>

</span>

</td>

</tr>

</table>

</div>

</div>

<div class="table-responsive">

<table class="table table-bordered">

<thead class="thead-dark">

<tr>

<th>No</th>
<th>Obat</th>
<th>Qty</th>
<th>Aturan Pakai</th>
<th>Harga</th>
<th>Subtotal</th>

</tr>

</thead>

<tbody>

<?php
$no = 1;
$total = 0;
?>

<?php foreach($detail_obat as $d): ?>

<?php
$total += $d->subtotal;
?>

<tr>

<td>
<?= $no++ ?>
</td>

<td>

<?= $d->nama_obat ?>

</td>

<td>

<?= $d->qty ?>

<?= $d->satuan ?>

</td>

<td>

<?= $d->aturan_pakai ?>

</td>

<td>

Rp <?= number_format($d->harga) ?>

</td>

<td>

Rp <?= number_format($d->subtotal) ?>

</td>

</tr>

<?php endforeach; ?>

<tr>

<th colspan="5"
    class="text-right">

Total

</th>

<th>

Rp <?= number_format($total) ?>

</th>

</tr>

</tbody>

</table>

</div>

<a href="<?= base_url('resep/cetak/'.$resep->id) ?>"
   class="btn btn-primary">

<i class="fas fa-print"></i>
Cetak Resep

</a>

<a href="<?= base_url('rekam_medis') ?>"
   class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>