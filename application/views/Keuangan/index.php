<table class="table table-bordered">

<tr>

<th>Tanggal</th>
<th>Keterangan</th>
<th>Aksi</th>

</tr>

<?php foreach($jurnal as $j): ?>

<tr>

<td><?= $j->tanggal ?></td>

<td><?= $j->keterangan ?></td>

<td>

<a href="<?= base_url('keuangan/detail/'.$j->id)?>"
class="btn btn-info btn-sm">

Detail

</a>

</td>

</tr>

<?php endforeach; ?>

</table>