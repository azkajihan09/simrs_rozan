<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<div class="card">

<div class="card-header">

<a href="<?= base_url('dokter/tambah')?>"
class="btn btn-primary">

Tambah Dokter

</a>

</div>

<div class="card-body table-responsive">

<table class="table table-bordered table-striped"
id="tableDokter">

<thead>

<tr>

<th>Nama Dokter</th>
<th>Poliklinik</th>
<th>Spesialis</th>
<th>Telepon</th>
<th>Jadwal</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($dokter as $d): ?>

<tr>

<td><?= $d->nama_dokter ?></td>

<td><?= $d->nama_poli ?></td>

<td><?= $d->spesialis ?></td>

<td><?= $d->telepon ?></td>

<td><?= $d->jadwal ?></td>

<td>

<a href="<?= base_url('dokter/edit/'.$d->id)?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="<?= base_url('dokter/hapus/'.$d->id)?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin hapus data?')">

Hapus

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>

<script>

$(document).ready(function(){

    $('#tableDokter').DataTable({

        responsive:true

    });

});

</script>