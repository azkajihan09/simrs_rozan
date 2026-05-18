<h2>Resume Medis Pasien</h2>

<hr>

<p>

<b>No RM:</b>

<?= $pasien->no_rm ?>

</p>

<p>

<b>Nama:</b>

<?= $pasien->nama_pasien ?>

</p>

<p>

<b>NIK:</b>

<?= $pasien->nik ?>

</p>

<hr>

<table border="1"
width="100%"
cellpadding="5"
cellspacing="0">

<tr>

<th>Tanggal</th>
<th>Dokter</th>
<th>Diagnosa</th>
<th>Tindakan</th>

</tr>

<?php foreach($riwayat as $r): ?>

<tr>

<td><?= $r->tanggal_periksa ?></td>

<td><?= $r->nama_dokter ?></td>

<td><?= $r->nama_diagnosa ?></td>

<td><?= $r->tindakan ?></td>

</tr>

<?php endforeach; ?>

</table>