<table class="table table-bordered">

<tr>

<th>Pasien</th>
<th>Dokter</th>
<th>Pemeriksaan</th>
<th>Status</th>
<th>Aksi</th>

</tr>

<?php foreach($lab as $l): ?>

<tr>

<td><?= $l->nama_pasien ?></td>

<td><?= $l->nama_dokter ?></td>

<td><?= $l->jenis_pemeriksaan ?></td>

<td><?= $l->status ?></td>

<td>

<a href="<?= base_url('laboratorium/hasil/'.$l->id)?>"
class="btn btn-primary btn-sm">

Input Hasil

</a>

</td>

</tr>

<?php endforeach; ?>

</table>