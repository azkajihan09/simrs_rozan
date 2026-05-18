<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-4 futuristic-bg">

<section class="content-header">

<div class="d-flex justify-content-between align-items-center mb-4">

<h1 class="text-white">

<i class="fas fa-prescription-bottle-alt text-info"></i>
Resep Obat Pasien

</h1>

</div>

</section>

<section class="content">

<div class="card glass-card">

<div class="card-body table-responsive">

<table class="table table-dark table-hover">

<thead>

<tr>

<th>No</th>
<th>Pasien</th>
<th>Dokter</th>
<th>Tanggal</th>

</tr>

</thead>

<tbody>

<?php $no=1; foreach($resep as $r): ?>

<tr>

<td><?= $no++ ?></td>

<td><?= $r->nama_pasien ?></td>

<td><?= $r->nama_dokter ?></td>

<td><?= date('d-m-Y',strtotime($r->tanggal)) ?></td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</section>

</div>

<style>

.futuristic-bg{
background:#0f172a;
min-height:100vh;
}

.glass-card{
background:rgba(255,255,255,0.05);
border:none;
border-radius:20px;
backdrop-filter:blur(10px);
box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

</style>

<?php $this->load->view('template/footer'); ?>