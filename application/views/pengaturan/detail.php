<?php
$this->load->view('template/header');
$this->load->view('template/navbar');
$this->load->view('template/sidebar');
?>

<div class="content-wrapper">

<section class="content p-3">

<div class="container-fluid">

<div class="card">

<div class="card-header bg-info">

<h3 class="card-title">

Detail Pengaturan

</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-3 text-center">

<?php if($detail->logo!=''): ?>

<img src="<?= base_url('upload/logo/'.$detail->logo)?>"
class="img-fluid img-thumbnail">

<?php endif; ?>

</div>

<div class="col-md-9">

<table class="table table-bordered">

<tr>
<th width="30%">Nama Klinik</th>
<td><?= $detail->nama_klinik ?></td>
</tr>

<tr>
<th>Alamat</th>
<td><?= $detail->alamat ?></td>
</tr>

<tr>
<th>Telepon</th>
<td><?= $detail->telepon ?></td>
</tr>

<tr>
<th>Email</th>
<td><?= $detail->email ?></td>
</tr>

<tr>
<th>Tema</th>
<td><?= $detail->tema ?></td>
</tr>

<tr>
<th>Dark Mode</th>
<td><?= $detail->dark_mode ?></td>
</tr>

<tr>
<th>Sidebar</th>
<td><?= $detail->sidebar ?></td>
</tr>

<tr>
<th>Prefix RM</th>
<td><?= $detail->nomor_rm_prefix ?></td>
</tr>

<tr>
<th>Prefix Antrian</th>
<td><?= $detail->nomor_antrian_prefix ?></td>
</tr>

</table>

<a href="<?= base_url('pengaturan/edit/'.$detail->id)?>"
class="btn btn-warning">

<i class="fas fa-edit"></i>

Edit

</a>

<a href="<?= base_url('pengaturan')?>"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</div>

</div>

</div>

</section>

</div>

<?php
$this->load->view('template/footer');
$this->load->view('template/script');
?>