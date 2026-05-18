<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<div class="row">

<div class="col-md-3">

<div class="small-box bg-info">

<div class="inner">

<h3><?= $pasien ?></h3>

<p>Total Pasien</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="small-box bg-success">

<div class="inner">

<h3><?= $dokter ?></h3>

<p>Total Dokter</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="small-box bg-warning">

<div class="inner">

<h3><?= $rekammedis ?></h3>

<p>Rekam Medis</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="small-box bg-danger">

<div class="inner">

<h3>

Rp <?= number_format($billing->total_bayar) ?>

</h3>

<p>Total Pendapatan</p>

</div>

</div>

</div>

</div>

<div class="card">

<div class="card-header">

<h3>Laporan SIMRS Klinik Rozan</h3>

</div>

<div class="card-body">

<a href="<?= base_url('laporan/pasien')?>"
class="btn btn-primary">

Laporan Pasien

</a>

<a href="<?= base_url('laporan/billing')?>"
class="btn btn-success">

Laporan Billing

</a>

<a href="<?= base_url('laporan/pdf_pasien')?>"
class="btn btn-danger">

Export PDF Pasien

</a>

<a href="<?= base_url('laporan/pdf_billing')?>"
class="btn btn-warning">

Export PDF Billing

</a>

</div>

</div>

<div class="card">

<div class="card-header">

<h3>Chart Statistik</h3>

</div>

<div class="card-body">

<div style="height:300px">

<canvas id="chartLaporan"></canvas>

</div>

</div>

</div>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>

<script>

var ctx = document.getElementById('chartLaporan');

new Chart(ctx, {

    type:'bar',

    data:{

        labels:[
            'Pasien',
            'Dokter',
            'Rekam Medis'
        ],

        datasets:[{

            label:'SIMRS Klinik Rozan',

            data:[
                <?= $pasien ?>,
                <?= $dokter ?>,
                <?= $rekammedis ?>
            ]

        }]
    },

    options:{
        responsive:true,
        maintainAspectRatio:false
    }
});

</script>