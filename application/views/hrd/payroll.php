<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<div class="card">

<div class="card-header">

<h3 class="card-title">

Payroll Pegawai

</h3>

<div class="card-tools">

<a href="<?= base_url('hrd/generate_payroll')?>"
class="btn btn-success btn-sm"
onclick="return confirm('Generate payroll bulan ini?')">

Generate Payroll

</a>

</div>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-striped"
id="tablePayroll">

<thead>

<tr>

<th>Nama</th>
<th>Jabatan</th>
<th>Bulan</th>
<th>Gaji Pokok</th>
<th>Insentif</th>
<th>Bonus</th>
<th>Potongan</th>
<th>Total</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($payroll as $p): ?>

<tr>

<td><?= $p->nama_pegawai ?></td>

<td><?= $p->jabatan ?></td>

<td>

<?= $p->bulan ?>

<?= $p->tahun ?>

</td>

<td>

Rp <?= number_format($p->gaji_pokok) ?>

</td>

<td>

Rp <?= number_format($p->insentif) ?>

</td>

<td>

Rp <?= number_format($p->bonus) ?>

</td>

<td>

Rp <?= number_format($p->potongan) ?>

</td>

<td>

<b>

Rp <?= number_format($p->total_gaji) ?>

</b>

</td>

<td>

<?php if($p->status=='BELUM_DIBAYAR'): ?>

<span class="badge badge-danger">

BELUM DIBAYAR

</span>

<?php else: ?>

<span class="badge badge-success">

SUDAH DIBAYAR

</span>

<?php endif; ?>

</td>

<td>

<a href="<?= base_url('hrd/slip/'.$p->id)?>"
target="_blank"
class="btn btn-info btn-sm">

Slip Gaji

</a>

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

    $('#tablePayroll').DataTable({

        responsive:true

    });

});

</script>