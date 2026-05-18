<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<div class="card card-info">

<div class="card-header">

<h3 class="card-title">

Detail Rawat Inap

</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<table class="table table-bordered">

<tr>

<th>No RM</th>

<td><?= $detail->no_rm ?></td>

</tr>

<tr>

<th>Nama Pasien</th>

<td><?= $detail->nama_pasien ?></td>

</tr>

<tr>

<th>Dokter</th>

<td><?= $detail->nama_dokter ?></td>

</tr>

<tr>

<th>Kamar</th>

<td><?= $detail->nama_kamar ?></td>

</tr>

<tr>

<th>Kelas</th>

<td><?= $detail->kelas ?></td>

</tr>

<tr>

<th>Nomor Bed</th>

<td><?= $detail->nomor_bed ?></td>

</tr>

<tr>

<th>Status</th>

<td>

<?php if($detail->status=='DIRAWAT'): ?>

<span class="badge badge-warning">

DIRAWAT

</span>

<?php else: ?>

<span class="badge badge-success">

PULANG

</span>

<?php endif; ?>

</td>

</tr>

</table>

</div>

<div class="col-md-6">

<table class="table table-bordered">

<tr>

<th>Tanggal Masuk</th>

<td>

<?= date(
'd-m-Y H:i',
strtotime($detail->tanggal_masuk)
) ?>

</td>

</tr>

<tr>

<th>Tanggal Keluar</th>

<td>

<?php if($detail->tanggal_keluar): ?>

<?= date(
'd-m-Y H:i',
strtotime($detail->tanggal_keluar)
) ?>

<?php else: ?>

-

<?php endif; ?>

</td>

</tr>

<tr>

<th>Diagnosa</th>

<td><?= nl2br($detail->diagnosa) ?></td>

</tr>

<tr>

<th>Kondisi Pasien</th>

<td><?= nl2br($detail->kondisi_pasien) ?></td>

</tr>

</table>

</div>

</div>

<hr>

<a href="<?= base_url('rawatinap')?>"
class="btn btn-secondary">

Kembali

</a>

<?php if($detail->status=='DIRAWAT'): ?>

<a href="<?= base_url('rawatinap/pulang/'.$detail->id)?>"
class="btn btn-success"
onclick="return confirm('Pasien sudah pulang?')">

Pasien Pulang

</a>

<?php endif; ?>

</div>

</div>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>