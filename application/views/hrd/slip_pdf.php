<h2>Slip Gaji Pegawai</h2>

<hr>

<p>

Nama:
<?= $detail->nama_pegawai ?>

</p>

<p>

Jabatan:
<?= $detail->jabatan ?>

</p>

<table border="1"
width="100%"
cellpadding="5">

<tr>

<td>Gaji Pokok</td>

<td>

Rp <?= number_format($detail->gaji_pokok) ?>

</td>

</tr>

<tr>

<td>Insentif</td>

<td>

Rp <?= number_format($detail->insentif) ?>

</td>

</tr>

<tr>

<td>Bonus</td>

<td>

Rp <?= number_format($detail->bonus) ?>

</td>

</tr>

<tr>

<td>Potongan</td>

<td>

Rp <?= number_format($detail->potongan) ?>

</td>

</tr>

<tr>

<td><b>Total</b></td>

<td>

<b>

Rp <?= number_format($detail->total_gaji) ?>

</b>

</td>

</tr>

</table>