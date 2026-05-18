<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<div class="card">

<div class="card-header">

<h3 class="card-title">

Data Rawat Inap

</h3>

<div class="card-tools">

<a href="<?= base_url('rawatinap/tambah')?>"
class="btn btn-primary btn-sm">

Tambah Rawat Inap

</a>

</div>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-striped"
id="tableRawatInap">

<thead>

<tr>

<th>No RM</th>
<th>Pasien</th>
<th>Dokter</th>
<th>Kamar</th>
<th>Bed</th>
<th>Status</th>
<th>Tanggal Masuk</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($rawat as $r): ?>

<tr>

<td><?= $r->no_rm ?></td>

<td><?= $r->nama_pasien ?></td>

<td><?= $r->nama_dokter ?></td>

<td><?= $r->nama_kamar ?></td>

<td><?= $r->nomor_bed ?></td>

<td>

<?php if($r->status=='DIRAWAT'): ?>

<span class="badge badge-warning">

DIRAWAT

</span>

<?php else: ?>

<span class="badge badge-success">

PULANG

</span>

<?php endif; ?>

</td>

<td>

<?= date(
'd-m-Y H:i',
strtotime($r->tanggal_masuk)
) ?>

</td>

<td>

<a href="<?= base_url('rawatinap/detail/'.$r->id)?>"
class="btn btn-info btn-sm">

Detail

</a>

<?php if($r->status=='DIRAWAT'): ?>

<a href="<?= base_url('rawatinap/pulang/'.$r->id)?>"
class="btn btn-success btn-sm"
onclick="return confirm('Pasien sudah pulang?')">

Pasien Pulang

</a>

<?php endif; ?>

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

    $('#tableRawatInap').DataTable({

        responsive:true

    });

});

</script>