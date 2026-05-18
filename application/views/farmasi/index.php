<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<div class="card">

<div class="card-header">

<a href="<?= base_url('farmasi/tambah')?>"
class="btn btn-primary">

Tambah Obat

</a>

</div>

<div class="card-body table-responsive">

<table class="table table-bordered table-striped"
id="tableObat">

<thead>

<tr>

<th>Kode</th>
<th>Nama Obat</th>
<th>Kategori</th>
<th>Stok</th>
<th>Satuan</th>
<th>Harga Jual</th>
<th>Expired</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($obat as $o): ?>

<tr>

<td><?= $o->kode_obat ?></td>

<td><?= $o->nama_obat ?></td>

<td><?= $o->kategori ?></td>

<td>

<?php if($o->stok < 10): ?>

<span class="badge badge-danger">

<?= $o->stok ?>

</span>

<?php else: ?>

<span class="badge badge-success">

<?= $o->stok ?>

</span>

<?php endif; ?>

</td>

<td><?= $o->satuan ?></td>

<td><?= number_format($o->harga_jual) ?></td>

<td><?= $o->expired_date ?></td>

<td>

<a href="<?= base_url('farmasi/edit/'.$o->id)?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="<?= base_url('farmasi/hapus/'.$o->id)?>"
class="btn btn-danger btn-sm">

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

    $('#tableObat').DataTable({

        responsive:true

    });

});

</script>