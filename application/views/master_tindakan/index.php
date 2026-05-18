<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center">

<h1>

<i class="fas fa-notes-medical text-primary"></i>
Master Tindakan

</h1>

<a href="<?= base_url('master_tindakan/tambah') ?>"
class="btn btn-primary">

<i class="fas fa-plus"></i>
Tambah

</a>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow border-0">

<div class="card-body table-responsive">

<table class="table table-bordered table-hover">

<thead class="bg-primary text-white">

<tr>

<th>No</th>
<th>Kode</th>
<th>Nama Tindakan</th>
<th>Tarif</th>
<th>Jasa Dokter</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php $no=1; foreach($tindakan as $t): ?>

<tr>

<td><?= $no++ ?></td>

<td><?= $t->kode_tindakan ?></td>

<td><?= $t->nama_tindakan ?></td>

<td>
Rp <?= number_format($t->tarif,0,',','.') ?>
</td>

<td>
Rp <?= number_format($t->jasa_dokter,0,',','.') ?>
</td>

<td>

<?php if($t->status == 'AKTIF'): ?>

<span class="badge badge-success">
AKTIF
</span>

<?php else: ?>

<span class="badge badge-danger">
NONAKTIF
</span>

<?php endif; ?>

</td>

<td>
<a href="<?= base_url('master_tindakan/detail/'.$t->id) ?>"
class="btn btn-info btn-sm">

<i class="fas fa-eye"></i>

</a>
<a href="<?= base_url('master_tindakan/edit/'.$t->id) ?>"
class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>

</a>

<a href="<?= base_url('master_tindakan/hapus/'.$t->id) ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data?')">

<i class="fas fa-trash"></i>

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>