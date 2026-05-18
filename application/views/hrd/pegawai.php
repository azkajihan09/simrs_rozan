<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<div class="card">

<div class="card-header">

<h3 class="card-title">

Data Pegawai

</h3>

<div class="card-tools">

<a href="<?= base_url('hrd/tambah_pegawai')?>"
class="btn btn-primary btn-sm">

Tambah Pegawai

</a>

</div>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-striped"
id="tablePegawai">

<thead>

<tr>

<th>NIK</th>
<th>Nama</th>
<th>Jabatan</th>
<th>Jenis</th>
<th>Telepon</th>
<th>Gaji Pokok</th>

</tr>

</thead>

<tbody>

<?php foreach($pegawai as $p): ?>

<tr>

<td><?= $p->nik ?></td>

<td><?= $p->nama_pegawai ?></td>

<td><?= $p->jabatan ?></td>

<td>

<span class="badge badge-info">

<?= $p->jenis_pegawai ?>

</span>

</td>

<td><?= $p->telepon ?></td>

<td>

Rp <?= number_format($p->gaji_pokok) ?>

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

    $('#tablePegawai').DataTable({

        responsive:true

    });

});

</script>