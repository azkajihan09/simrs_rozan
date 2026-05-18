<table class="table table-bordered">

<tr>

<th>Kode</th>
<th>Akun</th>
<th>Debit</th>
<th>Kredit</th>

</tr>

<?php foreach($detail as $d): ?>

<tr>

<td><?= $d->kode_akun ?></td>

<td><?= $d->nama_akun ?></td>

<td>

Rp <?= number_format($d->debit) ?>

</td>

<td>

Rp <?= number_format($d->kredit) ?>

</td>

</tr>

<?php endforeach; ?>

</table>