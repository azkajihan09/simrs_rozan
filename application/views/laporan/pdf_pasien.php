<h2>Laporan Data Pasien</h2>

<table border="1"
width="100%"
cellpadding="5"
cellspacing="0">

<tr>

<th>No RM</th>
<th>Nama</th>
<th>NIK</th>
<th>Telepon</th>

</tr>

<?php foreach($pasien as $p): ?>

<tr>

<td><?= $p->no_rm ?></td>

<td><?= $p->nama_pasien ?></td>

<td><?= $p->nik ?></td>

<td><?= $p->telepon ?></td>

</tr>

<?php endforeach; ?>

</table>