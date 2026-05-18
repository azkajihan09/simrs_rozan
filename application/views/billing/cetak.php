<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">

<title>
Invoice Billing
</title>

<style>

body{
    font-family: sans-serif;
    font-size: 12px;
}

table{
    width:100%;
    border-collapse: collapse;
}

table th,
table td{
    border:1px solid #000;
    padding:8px;
}

.text-center{
    text-align:center;
}

.text-right{
    text-align:right;
}

</style>

</head>

<body>

<h2 class="text-center">

INVOICE BILLING

</h2>

<hr>

<table>

<tr>
<td width="25%">Kode Billing</td>
<td><?= $billing->kode_billing ?></td>
</tr>

<tr>
<td>Pasien</td>
<td><?= $billing->nama_pasien ?></td>
</tr>

<tr>
<td>No RM</td>
<td><?= $billing->no_rm ?></td>
</tr>

<tr>
<td>Status</td>
<td><?= $billing->status ?></td>
</tr>

</table>

<br>

<table>

<thead>

<tr>

<th>No</th>
<th>Item</th>
<th>Qty</th>
<th>Harga</th>
<th>Subtotal</th>

</tr>

</thead>

<tbody>

<?php
$no = 1;
?>

<?php foreach($detail as $d): ?>

<tr>

<td class="text-center">

<?= $no++ ?>

</td>

<td>

<?= $d->nama_item ?>

</td>

<td class="text-center">

<?= $d->qty ?>

</td>

<td class="text-right">

Rp <?= number_format($d->harga) ?>

</td>

<td class="text-right">

Rp <?= number_format($d->subtotal) ?>

</td>

</tr>

<?php endforeach; ?>

<tr>

<th colspan="4"
class="text-right">

TOTAL

</th>

<th class="text-right">

Rp <?= number_format($billing->total_bayar) ?>

</th>

</tr>

</tbody>

</table>

<br><br>

<p>

Dicetak pada:
<?= date('d-m-Y H:i') ?>

</p>

</body>
</html>