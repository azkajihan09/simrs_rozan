<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<section class="content-header">
<div class="container-fluid">
<div class="d-flex justify-content-between align-items-center mb-3">
<h1 class="m-0"><i class="fas fa-door-open text-primary"></i> Master Kamar</h1>
<a href="<?= base_url('kamar/tambah') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Kamar</a>
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
<h3 class="card-title text-white">Data Kamar</h3>
</div>
<div class="card-body table-responsive">
<table class="table table-hover table-bordered datatable">
<thead class="bg-primary text-white">
<tr>
<th>No</th>
<th>Kode Kamar</th>
<th>Nama Kamar</th>
<th>Kelas</th>
<th>Tarif Harian</th>
<th>Kapasitas</th>
<th>Status</th>
<th width="18%">Aksi</th>
</tr>
</thead>
<tbody>
<?php $no = 1; foreach($kamar as $item): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $item->kode_kamar ?></td>
<td><?= $item->nama_kamar ?></td>
<td><?= $item->kelas ?></td>
<td>Rp <?= number_format((float) $item->tarif_harian, 0, ',', '.') ?></td>
<td><?= $item->kapasitas ?></td>
<td>
<?php if($item->status === 'PENUH'): ?>
<span class="badge badge-danger p-2">PENUH</span>
<?php else: ?>
<span class="badge badge-success p-2">TERSEDIA</span>
<?php endif; ?>
</td>
<td>
<a href="<?= base_url('kamar/edit/'.$item->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
<a href="<?= base_url('kamar/hapus/'.$item->id) ?>" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash"></i></a>
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