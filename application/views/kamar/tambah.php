<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">
<div class="card card-primary">
<div class="card-header"><h3 class="card-title">Tambah Kamar</h3></div>
<div class="card-body">
<form method="POST">
<div class="row">
<div class="col-md-6"><div class="form-group"><label>Kode Kamar</label><input type="text" name="kode_kamar" class="form-control" required></div></div>
<div class="col-md-6"><div class="form-group"><label>Nama Kamar</label><input type="text" name="nama_kamar" class="form-control" required></div></div>
<div class="col-md-4"><div class="form-group"><label>Kelas</label><select name="kelas" class="form-control" required><option value="">-- Pilih Kelas --</option><option value="VIP">VIP</option><option value="Kelas I">Kelas I</option><option value="Kelas II">Kelas II</option><option value="Kelas III">Kelas III</option></select></div></div>
<div class="col-md-4"><div class="form-group"><label>Tarif Harian</label><input type="number" name="tarif_harian" class="form-control" min="0" required></div></div>
<div class="col-md-4"><div class="form-group"><label>Kapasitas</label><input type="number" name="kapasitas" class="form-control" min="1" required></div></div>
<div class="col-md-6"><div class="form-group"><label>Status</label><select name="status" class="form-control" required><option value="TERSEDIA">TERSEDIA</option><option value="PENUH">PENUH</option></select></div></div>
<div class="col-md-12"><button type="submit" class="btn btn-primary">Simpan</button> <a href="<?= base_url('kamar') ?>" class="btn btn-secondary">Kembali</a></div>
</div>
</form>
</div>
</div>
</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>