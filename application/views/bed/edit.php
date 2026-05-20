<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">
<div class="card card-primary">
<div class="card-header"><h3 class="card-title">Edit Bed</h3></div>
<div class="card-body">
<form method="POST">
<div class="row">
<div class="col-md-6"><div class="form-group"><label>Kamar</label><select name="kamar_id" class="form-control" required><?php foreach($kamar as $item): ?><option value="<?= $item->id ?>" <?= $detail->kamar_id == $item->id ? 'selected' : '' ?>><?= $item->nama_kamar ?> - <?= $item->kelas ?></option><?php endforeach; ?></select></div></div>
<div class="col-md-3"><div class="form-group"><label>Nomor Bed</label><input type="text" name="nomor_bed" class="form-control" value="<?= $detail->nomor_bed ?>" required></div></div>
<div class="col-md-3"><div class="form-group"><label>Status</label><select name="status" class="form-control" required><option value="KOSONG" <?= $detail->status == 'KOSONG' ? 'selected' : '' ?>>KOSONG</option><option value="TERISI" <?= $detail->status == 'TERISI' ? 'selected' : '' ?>>TERISI</option></select></div></div>
<div class="col-md-12"><button type="submit" class="btn btn-primary">Update</button> <a href="<?= base_url('bed') ?>" class="btn btn-secondary">Kembali</a></div>
</div>
</form>
</div>
</div>
</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>