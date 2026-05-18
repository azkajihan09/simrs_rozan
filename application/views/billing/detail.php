<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<section class="content">

<div class="container-fluid">

<div class="row">

<div class="col-md-8">

<div class="card shadow-lg border-0">

<div class="card-header bg-success">

<h3 class="text-white">

<i class="fas fa-file-invoice-dollar"></i>
Invoice Billing

</h3>

</div>

<div class="card-body">

<h4>

<?= $billing->nama_pasien ?>

</h4>

<p>

<?= $billing->no_rm ?>

</p>

<hr>

<table class="table table-bordered">

<thead class="bg-light">

<tr>

<th>Item</th>
<th>Qty</th>
<th>Harga</th>
<th>Subtotal</th>

</tr>

</thead>

<tbody>

<?php foreach($detail as $d): ?>

<tr>

<td>

<?= $d->nama_item ?>

</td>

<td>

<?= $d->qty ?>

</td>

<td>

Rp
<?= number_format(
$d->harga,
0,
',',
'.'
) ?>

</td>

<td>

Rp
<?= number_format(
$d->subtotal,
0,
',',
'.'
) ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

<tfoot>

<tr>

<th colspan="3" class="text-right">

TOTAL

</th>

<th>

Rp
<?= number_format(
$billing->total_bayar,
0,
',',
'.'
) ?>

</th>

</tr>

</tfoot>

</table>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow-lg border-0">

<div class="card-header bg-dark">

<h4 class="text-white">

Pembayaran

</h4>

</div>

<div class="card-body">

<?php if($billing->status != 'LUNAS'): ?>

<form method="POST">

<div class="form-group">

<label>Total Tagihan</label>

<input type="text"
class="form-control form-control-lg"
readonly
value="Rp <?= number_format($billing->total_bayar,0,',','.') ?>">

</div>

<div class="form-group">

<label>Jumlah Bayar</label>

<input type="number"
name="bayar"
class="form-control form-control-lg"
required>

</div>

<button type="submit"
class="btn btn-success btn-lg btn-block">

<i class="fas fa-cash-register"></i>
Bayar Sekarang

</button>

</form>

<?php else: ?>

<div class="text-center">

<h2 class="text-success">

LUNAS

</h2>

<hr>

<p>

Dibayar:
<br>

<strong>

Rp
<?= number_format(
$billing->dibayar,
0,
',',
'.'
) ?>

</strong>

</p>

<p>

Kembalian:
<br>

<strong>

Rp
<?= number_format(
$billing->kembalian,
0,
',',
'.'
) ?>

</strong>

</p>

<?php

$wa = "
Halo ".$billing->nama_pasien."

Pembayaran Anda telah LUNAS.

Total :
Rp ".number_format(
$billing->total_bayar,
0,
',',
'.'
)."

Terima kasih.
";

?>

<a target="_blank"
href="https://wa.me/<?= preg_replace('/[^0-9]/','',$billing->telepon) ?>?text=<?= urlencode($wa) ?>"
class="btn btn-success btn-block">

<i class="fab fa-whatsapp"></i>
Kirim WhatsApp

</a>

</div>

<?php endif; ?>

</div>

</div>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>