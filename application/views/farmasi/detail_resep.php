<h3>Detail Resep</h3>

<table class="table table-bordered">

<tr>

<th>Obat</th>
<th>Qty</th>
<th>Aturan Pakai</th>
<th>Subtotal</th>

</tr>

<?php foreach($detail as $d): ?>

<tr>

<td><?= $d->nama_obat ?></td>

<td><?= $d->qty ?></td>

<td><?= $d->aturan_pakai ?></td>

<td>

Rp <?= number_format($d->subtotal) ?>

</td>

</tr>

<?php endforeach; ?>

</table>