<h2>Laporan Billing Klinik Rozan</h2>

<table border="1"
width="100%"
cellpadding="5"
cellspacing="0">

<tr>

<th>Tanggal</th>
<th>Pasien</th>
<th>Total</th>

</tr>

<?php foreach($billing as $b): ?>

<tr>

<td><?= $b->tanggal_bayar ?></td>

<td><?= $b->nama_pasien ?></td>

<td>

Rp <?= number_format($b->total_bayar) ?>

</td>

</tr>

<?php endforeach; ?>

</table>