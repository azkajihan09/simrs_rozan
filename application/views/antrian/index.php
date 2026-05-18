<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<div class="card">

<div class="card-header">

<h3>Data Antrian Pasien</h3>

</div>

<div class="card-body">

<form action="<?= base_url('antrian/tambah')?>"
method="POST">

<div class="row">

<div class="col-md-5">

<div class="form-group">

<label>Pasien</label>

<select name="pasien_id"
class="form-control"
required>

<option value="">-- Pilih Pasien --</option>

<?php foreach($pasien as $p): ?>

<option value="<?= $p->id ?>">

<?= $p->nama_pasien ?>

</option>

<?php endforeach; ?>

</select>

</div>

</div>

<div class="col-md-5">

<div class="form-group">

<label>Dokter</label>

<select name="dokter_id"
class="form-control"
required>

<option value="">-- Pilih Dokter --</option>

<?php foreach($dokter as $d): ?>

<option value="<?= $d->id ?>">

<?= $d->nama_dokter ?>

</option>

<?php endforeach; ?>

</select>

</div>

</div>

<div class="col-md-2">

<div class="form-group">

<label>&nbsp;</label>

<button type="submit"
class="btn btn-primary btn-block">

Tambah

</button>

</div>

</div>

</div>

</form>

<hr>

<div class="table-responsive">

<table class="table table-bordered table-striped"
id="tableAntrian">

<thead>

<tr>

<th>Kode</th>
<th>Pasien</th>
<th>Dokter</th>
<th>Tanggal</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($antrian as $a): ?>

<tr>

<td><?= $a->kode_antrian ?></td>

<td><?= $a->nama_pasien ?></td>

<td><?= $a->nama_dokter ?></td>

<td><?= $a->tanggal ?></td>

<td>

<?php if($a->status=='MENUNGGU'): ?>

<span class="badge badge-warning">

MENUNGGU

</span>

<?php elseif($a->status=='DIPANGGIL'): ?>

<span class="badge badge-primary">

DIPANGGIL

</span>

<?php elseif($a->status=='SELESAI'): ?>

<span class="badge badge-success">

SELESAI

</span>

<?php else: ?>

<span class="badge badge-danger">

BATAL

</span>

<?php endif; ?>

</td>

<td>

<a href="<?= base_url('antrian/panggil/'.$a->id)?>"
class="btn btn-info btn-sm">

Panggil

</a>

<a href="<?= base_url('antrian/selesai/'.$a->id)?>"
class="btn btn-success btn-sm">

Selesai

</a>

<a href="<?= base_url('antrian/batal/'.$a->id)?>"
class="btn btn-danger btn-sm">

Batal

<a href="<?= base_url('antrian/cetak/'.$a->id)?>"
target="_blank"
class="btn btn-secondary btn-sm">

Print

</a>

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>

<script>

$(document).ready(function(){

    $('#tableAntrian').DataTable({

        responsive:true

    });

});

</script>