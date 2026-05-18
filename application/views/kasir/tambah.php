<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content p-3">

<div class="container-fluid">

<div class="card card-primary">

<div class="card-header">

<h3 class="card-title">

Tambah Billing

</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="form-group">

<label>Pasien</label>

<select
name="pasien_id"
class="form-control"
required>

<option value="">

-- Pilih Pasien --

</option>

<?php foreach($pasien as $p): ?>

<option value="<?= $p->id ?>">

<?= $p->no_rm ?>

- <?= $p->nama_pasien ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="form-group">

<label>Jenis Pembayaran</label>

<select
name="jenis_pembayaran"
class="form-control">

<option value="UMUM">

UMUM

</option>

<option value="BPJS">

BPJS

</option>

<option value="ASURANSI">

ASURANSI

</option>

</select>

</div>

<div class="form-group">

<label>Subtotal</label>

<input type="number"
name="subtotal"
id="subtotal"
class="form-control"
required>

</div>

<div class="form-group">

<label>Diskon</label>

<input type="number"
name="diskon"
id="diskon"
class="form-control"
value="0">

</div>

<div class="form-group">

<label>Total Bayar</label>

<input type="number"
name="total_bayar"
id="total_bayar"
class="form-control"
readonly>

</div>

<button type="submit"
class="btn btn-primary">

Simpan Billing

</button>

<a href="<?= base_url('kasir')?>"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>

<script>

function hitungTotal(){

    var subtotal =
    parseInt($('#subtotal').val()) || 0;

    var diskon =
    parseInt($('#diskon').val()) || 0;

    var total =
    subtotal - diskon;

    $('#total_bayar').val(total);
}

$('#subtotal').keyup(hitungTotal);

$('#diskon').keyup(hitungTotal);

</script>