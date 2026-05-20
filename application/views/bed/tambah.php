<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">
<div class="card card-primary">
<div class="card-header"><h3 class="card-title">Tambah Bed</h3></div>
<div class="card-body">

<?php if($this->session->flashdata('error')): ?>
<div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
<?php endif; ?>

<?php if(empty($kamar)): ?>
<div class="alert alert-warning">Belum ada data kamar. Tambahkan kamar terlebih dahulu sebelum membuat bed.</div>
<?php endif; ?>

<form method="POST">
<div class="row">
<div class="col-md-6"><div class="form-group"><label>Kamar</label><select name="kamar_id" class="form-control" <?= empty($kamar) ? 'disabled' : '' ?> required><option value="">-- Pilih Kamar --</option><?php foreach($kamar as $item): ?><option value="<?= $item->id ?>"><?= $item->nama_kamar ?> - <?= $item->kelas ?></option><?php endforeach; ?></select></div></div>
<div class="col-md-3"><div class="form-group"><label>Nomor Bed</label><input type="text" name="nomor_bed" class="form-control" required></div></div>
<div class="col-md-3"><div class="form-group"><label>Status</label><select name="status" class="form-control" required><option value="KOSONG">KOSONG</option><option value="TERISI">TERISI</option></select></div></div>
<div class="col-md-12"><button type="submit" class="btn btn-primary" <?= empty($kamar) ? 'disabled' : '' ?>>Simpan</button> <a href="<?= base_url('bed') ?>" class="btn btn-secondary">Kembali</a></div>
</div>
</form>
</div>
</div>
</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>