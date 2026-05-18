<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<section class="content-header">

<div class="d-flex justify-content-between mb-3">

<h1>

<i class="fas fa-wallet text-success"></i>
Billing Pasien

</h1>

</div>

</section>

<section class="content">

<div class="card shadow-lg border-0">

<div class="card-body table-responsive">

<table class="table table-hover">

<thead class="bg-dark text-white">

<tr>

<th>No</th>
<th>Pasien</th>
<th>Dokter</th>
<th>Total</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php $no=1; foreach($billing as $b): ?>

<tr>

<td><?= $no++ ?></td>

<td>

<strong>

<?= $b->nama_pasien ?>

</strong>

<br>

<small>

<?= $b->no_rm ?>

</small>

</td>

<td>

<?= $b->nama_dokter ?>

</td>

<td>

Rp
<?= number_format(
$b->total_bayar,
0,
',',
'.'
) ?>

</td>

<td>

<?php if($b->status == 'LUNAS'): ?>

<span class="badge badge-success">

LUNAS

</span>

<?php else: ?>

<span class="badge badge-danger">

BELUM BAYAR

</span>

<?php endif; ?>

</td>

<td>

<a href="<?= base_url('billing/pasien/'.$b->id) ?>"
class="btn btn-primary btn-sm">

<i class="fas fa-eye"></i>

Detail

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>