<table class="table table-bordered">

<tr>

<th>Pasien</th>
<th>Dokter</th>
<th>Tanggal</th>
<th>Status</th>
<th>Aksi</th>

</tr>

<?php foreach($resep as $r): ?>

<tr>

<td><?= $r->nama_pasien ?></td>

<td><?= $r->nama_dokter ?></td>

<td><?= $r->tanggal ?></td>

<td><?= $r->status ?></td>

<td>

<a href="<?= base_url('farmasi/detail_resep/'.$r->id)?>"
class="btn btn-info btn-sm">

Detail

</a>

<a href="<?= base_url('farmasi/proses/'.$r->id)?>"
class="btn btn-success btn-sm">

Proses

</a>

</td>

</tr>

<?php endforeach; ?>

</table>