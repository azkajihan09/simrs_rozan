<h2>Invoice Klinik Rozan</h2>

<hr>

<table width="100%">

<tr>
<td>No RM</td>
<td><?= $detail->no_rm ?></td>
</tr>

<tr>
<td>Nama Pasien</td>
<td><?= $detail->nama_pasien ?></td>
</tr>

<tr>
<td>Tanggal</td>
<td><?= $detail->tanggal_bayar ?></td>
</tr>

</table>

<br>

<table border="1"
width="100%"
cellpadding="8"
cellspacing="0">

<tr>

<th>Item</th>
<th>Nominal</th>

</tr>

<tr>

<td>Biaya Pemeriksaan</td>

<td>

Rp <?= number_format($detail->biaya_pemeriksaan) ?>

</td>

</tr>

<tr>

<td>Biaya Obat</td>

<td>

Rp <?= number_format($detail->biaya_obat) ?>

</td>

</tr>

<tr>

<td><b>Total</b></td>

<td>

<b>

Rp <?= number_format($detail->total_bayar) ?>

</b>

</td>

</tr>

</table>

<br>

<p>

Metode Bayar:
<b><?= $detail->metode_bayar ?></b>

</p>

<p>

Status:
<b><?= $detail->status_bayar ?></b>

</p>