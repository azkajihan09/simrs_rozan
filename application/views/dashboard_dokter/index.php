<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper futuristic-bg">

<section class="content-header p-4">

<div class="d-flex justify-content-between align-items-center flex-wrap">

<div>

<h1 class="dashboard-title">

<i class="fas fa-user-md"></i>
Dashboard Dokter

</h1>

<p class="dashboard-subtitle">

Monitoring Pemeriksaan Pasien Real Time

</p>

</div>

<div class="live-clock-box">

<div id="clockRealtime"></div>

<div class="live-status">

<i class="fas fa-circle text-success"></i>
SYSTEM ONLINE

</div>

</div>

</div>

</section>

<section class="content px-4 pb-4">

<div class="row">

<div class="col-lg-3 col-md-6 mb-4">

<div class="card stat-card bg-primary">

<div class="card-body">

<div class="stat-icon">

<i class="fas fa-user-injured"></i>

</div>

<h2>

<?= $pasien_hari_ini ?>

</h2>

<p>Pasien Hari Ini</p>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card stat-card bg-success">

<div class="card-body">

<div class="stat-icon">

<i class="fas fa-check-circle"></i>

</div>

<h2>

<?= $pemeriksaan_selesai ?>

</h2>

<p>Pemeriksaan Selesai</p>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card stat-card bg-warning">

<div class="card-body">

<div class="stat-icon">

<i class="fas fa-list"></i>

</div>

<h2>

<?= $antrian_aktif ?>

</h2>

<p>Antrian Aktif</p>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card stat-card bg-danger">

<div class="card-body">

<div class="stat-icon">

<i class="fas fa-prescription-bottle-alt"></i>

</div>

<h2>

<?= $resep_hari_ini ?>

</h2>

<p>Resep Hari Ini</p>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-lg-8">

<div class="card glass-card mb-4">

<div class="card-header border-0">

<h3 class="text-white">

<i class="fas fa-chart-line"></i>
Grafik Kunjungan Pasien

</h3>

</div>

<div class="card-body">

<canvas id="kunjunganChart"></canvas>

</div>

</div>

<div class="card glass-card">

<div class="card-header border-0 d-flex justify-content-between">

<h3 class="text-white">

<i class="fas fa-procedures"></i>
Antrian Pasien

</h3>

<span class="badge badge-success p-2">

LIVE

</span>

</div>

<div class="card-body table-responsive p-0">

<table class="table table-dark table-hover">

<thead>

<tr>

<th>No</th>
<th>Pasien</th>
<th>Poli</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($antrian as $a): ?>

<tr>

<td>

<span class="queue-number">

<?= $a->no_antrian ?>

</span>

</td>

<td>

<?= $a->nama_pasien ?>

</td>

<td>

<?= $a->nama_poli ?>

</td>

<td>

<?php

$status = 'secondary';

if($a->status == 'MENUNGGU'){
$status = 'warning';
}

if($a->status == 'DIPERIKSA'){
$status = 'info';
}

if($a->status == 'SELESAI'){
$status = 'success';
}

?>

<span class="badge badge-<?= $status ?>">

<?= $a->status ?>

</span>

</td>

<td>

<a href="<?= base_url('rekam_medis/periksa/'.$a->pendaftaran_id) ?>"
class="btn btn-info btn-sm">

<i class="fas fa-stethoscope"></i>
Periksa

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

<div class="col-lg-4">

<div class="card glass-card mb-4">

<div class="card-header border-0">

<h3 class="text-white">

<i class="fas fa-notes-medical"></i>
Diagnosa Terbanyak

</h3>

</div>

<div class="card-body">

<?php foreach($diagnosa_populer as $d): ?>

<div class="diagnosa-item">

<div>

<h6>

<?= $d->nama_diagnosa ?>

</h6>

</div>

<span class="badge badge-info">

<?= $d->total ?>

</span>

</div>

<?php endforeach; ?>

</div>

</div>

<div class="card glass-card">

<div class="card-header border-0">

<h3 class="text-white">

<i class="fas fa-capsules"></i>
Stok Obat Menipis

</h3>

</div>

<div class="card-body">

<?php foreach($obat_menipis as $o): ?>

<div class="obat-item">

<div>

<h6>

<?= $o->nama_obat ?>

</h6>

</div>

<span class="badge badge-danger">

<?= $o->stok ?>

</span>

</div>

<?php endforeach; ?>

</div>

</div>

</div>

</div>

</section>

</div>

<style>

.futuristic-bg{

background:
linear-gradient(
135deg,
#0f172a,
#111827,
#1e293b
);

min-height:100vh;

}

.dashboard-title{

color:white;
font-weight:700;
font-size:32px;

}

.dashboard-subtitle{

color:#94a3b8;

}

.live-clock-box{

background:rgba(255,255,255,0.08);

padding:15px 25px;

border-radius:20px;

backdrop-filter:blur(10px);

color:white;

}

#clockRealtime{

font-size:28px;
font-weight:bold;

}

.glass-card{

background:rgba(255,255,255,0.05);

border:none;

border-radius:24px;

backdrop-filter:blur(10px);

box-shadow:0 10px 30px rgba(0,0,0,0.3);

}

.stat-card{

border:none;

border-radius:24px;

overflow:hidden;

color:white;

box-shadow:0 10px 30px rgba(0,0,0,0.25);

}

.stat-icon{

font-size:40px;
opacity:0.3;
margin-bottom:10px;

}

.queue-number{

background:#06b6d4;

padding:10px 15px;

border-radius:12px;

font-weight:bold;

display:inline-block;

min-width:50px;

text-align:center;

}

.diagnosa-item,
.obat-item{

display:flex;

justify-content:space-between;

align-items:center;

padding:12px 0;

border-bottom:1px solid rgba(255,255,255,0.08);

color:white;

}

</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

function realtimeClock(){

const now = new Date();

$('#clockRealtime').html(
now.toLocaleTimeString()
);

}

setInterval(realtimeClock,1000);

realtimeClock();

const ctx =
document.getElementById(
'kunjunganChart'
);

new Chart(ctx,{

type:'line',

data:{

labels:
<?= json_encode($grafik_tanggal) ?>,

datasets:[{

label:'Pasien',

data:
<?= json_encode($grafik_jumlah) ?>,

borderColor:'#06b6d4',

backgroundColor:
'rgba(6,182,212,0.15)',

fill:true,

tension:0.4,

borderWidth:3

}]

},

options:{

responsive:true,

plugins:{
legend:{
labels:{
color:'white'
}
}
},

scales:{
x:{
ticks:{color:'white'}
},
y:{
ticks:{color:'white'}
}
}

}

});

</script>

<?php $this->load->view('template/footer'); ?>