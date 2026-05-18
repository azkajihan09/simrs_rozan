<table class="table table-bordered table-striped"
id="tableRadiologi">

<thead>

<tr>

<th>No RM</th>
<th>Pasien</th>
<th>Dokter</th>
<th>Pemeriksaan</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($radiologi as $r): ?>

<tr>

<td><?= $r->no_rm ?></td>

<td><?= $r->nama_pasien ?></td>

<td><?= $r->nama_dokter ?></td>

<td><?= $r->jenis_pemeriksaan ?></td>

<td>

<?php if($r->status=='MENUNGGU'): ?>

<span class="badge badge-warning">

MENUNGGU

</span>

<?php else: ?>

<span class="badge badge-success">

SELESAI

</span>

<?php endif; ?>

</td>

<td>

<a href="<?= base_url('radiologi/detail/'.$r->id)?>"
class="btn btn-info btn-sm">

Detail

</a>

<a href="<?= base_url('radiologi/hasil/'.$r->id)?>"
class="btn btn-primary btn-sm">

Input Hasil

</a>

<a href="<?= base_url('radiologi/hapus/'.$r->id)?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin hapus data?')">

Hapus

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>