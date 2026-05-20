<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<section class="content-header">
<div class="container-fluid">
<div class="d-flex justify-content-between align-items-center mb-3">
<h1 class="m-0"><i class="fas fa-bed text-primary"></i> Master Bed</h1>
<a href="<?= base_url('bed/tambah') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Bed</a>
</div>
</div>
</section>

<section class="content">
<div class="container-fluid">

<?php if($this->session->flashdata('error')): ?>
<div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
<?php endif; ?>

<div class="card shadow-lg border-0">
<div class="card-header bg-gradient-primary">
<h3 class="card-title text-white">Data Bed</h3>
</div>
<div class="card-body table-responsive">
<table class="table table-hover table-bordered datatable">
<thead class="bg-primary text-white">
<tr>
<th>No</th>
<th>Kamar</th>
<th>Kelas</th>
<th>Nomor Bed</th>
<th>Status</th>
<th width="18%">Aksi</th>
</tr>
</thead>
<tbody>
<?php $no = 1; foreach($bed as $item): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= !empty($item->nama_kamar) ? $item->nama_kamar : '-' ?></td>
<td><?= !empty($item->kelas) ? $item->kelas : '-' ?></td>
<td><?= $item->nomor_bed ?></td>
<td>
<?php if($item->status === 'TERISI'): ?>
<span class="badge badge-danger p-2">TERISI</span>
<?php else: ?>
<span class="badge badge-success p-2">KOSONG</span>
<?php endif; ?>
</td>
<td>
<a href="<?= base_url('bed/edit/'.$item->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
<a href="<?= base_url('bed/hapus/'.$item->id) ?>" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash"></i></a>
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