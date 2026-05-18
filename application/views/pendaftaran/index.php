<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">

<h1 class="m-0">

<i class="fas fa-user-clock text-primary"></i>
Pendaftaran Pasien

</h1>

<a href="<?= base_url('pendaftaran/tambah') ?>"
class="btn btn-primary">

<i class="fas fa-plus"></i>
Tambah Pendaftaran

</a>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow-lg border-0">

<div class="card-header bg-gradient-primary">

<h3 class="card-title text-white">

Data Registrasi Pasien

</h3>

</div>

<div class="card-body table-responsive">

<table class="table table-hover table-bordered">

<thead class="bg-primary text-white">

<tr>

<th>No</th>
<th>Antrian</th>
<th>No RM</th>
<th>Nama Pasien</th>
<th>Poli</th>
<th>Dokter</th>
<th>Jenis</th>
<th>Status</th>
<th width="24%">Aksi</th>

</tr>

</thead>

<tbody>

<?php $no=1; foreach($pendaftaran as $p): ?>

<tr>

<td>
<?= $no++ ?>
</td>

<td>

<span class="badge badge-info p-2">

A-<?= $p->nomor_antrian ?>

</span>

</td>

<td>

<?= $p->no_rm ?>

</td>

<td>

<strong>

<?= $p->nama_pasien ?>

</strong>

<br>

<small class="text-muted">

<?= $p->telepon ?>

</small>

</td>

<td>

<?= $p->nama_poli ?>

</td>

<td>

<?= $p->nama_dokter ?>

</td>

<td>

<?php if($p->jenis_pasien == 'BPJS'): ?>

<span class="badge badge-success">

BPJS

</span>

<?php elseif($p->jenis_pasien == 'ASURANSI'): ?>

<span class="badge badge-warning">

ASURANSI

</span>

<?php else: ?>

<span class="badge badge-primary">

UMUM

</span>

<?php endif; ?>

</td>

<td>

<?php

$status = $p->status;

if($status == 'MENUNGGU'){

    echo '<span class="badge badge-warning p-2">MENUNGGU</span>';

}elseif($status == 'DIPERIKSA'){

    echo '<span class="badge badge-info p-2">DIPERIKSA</span>';

}elseif($status == 'SELESAI'){

    echo '<span class="badge badge-success p-2">SELESAI</span>';

}else{

    echo '<span class="badge badge-secondary p-2">'.$status.'</span>';

}

?>

</td>

<td>

<a href="<?= base_url('pendaftaran/detail/'.$p->id) ?>"
class="btn btn-info btn-sm">

<i class="fas fa-eye"></i>

</a>

<a href="<?= base_url('pendaftaran/edit/'.$p->id) ?>"
class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>

</a>

<a href="<?= base_url('rekam_medis/periksa/'.$p->id) ?>"
class="btn btn-primary btn-sm">

<i class="fas fa-stethoscope"></i>

</a>

<a href="<?= base_url('billing/pasien/'.$p->id) ?>"
class="btn btn-success btn-sm">

<i class="fas fa-cash-register"></i>

</a>

<a href="<?= base_url('pendaftaran/hapus/'.$p->id) ?>"
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