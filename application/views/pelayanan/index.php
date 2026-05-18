<!-- application/views/pelayanan/index.php -->

<?php
$this->load->view('template/header');
$this->load->view('template/navbar');
$this->load->view('template/sidebar');
?>

<style>

.content-wrapper{
    background:#f4f6f9;
}

.page-header{
    background:linear-gradient(
        135deg,
        #007bff,
        #0056b3
    );
    border-radius:25px;
    padding:30px;
    color:white;
    margin-bottom:25px;
    box-shadow:0 8px 25px rgba(0,0,0,0.1);
}

.page-header h2{
    font-weight:700;
    margin-bottom:10px;
}

.page-header p{
    opacity:0.9;
}

.card-modern{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.07);
}

.nav-tabs-modern{
    border:none;
    margin-bottom:20px;
}

.nav-tabs-modern .nav-link{
    border:none;
    background:#f1f1f1;
    color:#444;
    margin-right:10px;
    border-radius:15px;
    padding:12px 25px;
    font-weight:600;
}

.nav-tabs-modern .nav-link.active{
    background:#007bff;
    color:white;
}

.info-card{
    border-radius:20px;
    padding:20px;
    color:white;
    position:relative;
    overflow:hidden;
    margin-bottom:20px;
}

.info-card i{
    position:absolute;
    right:20px;
    bottom:10px;
    font-size:55px;
    opacity:0.2;
}

.bg-poli{
    background:linear-gradient(
        135deg,
        #00b09b,
        #96c93d
    );
}

.bg-igd{
    background:linear-gradient(
        135deg,
        #ff416c,
        #ff4b2b
    );
}

.bg-rujukan{
    background:linear-gradient(
        135deg,
        #8e2de2,
        #4a00e0
    );
}

.table-modern{
    border-radius:15px;
    overflow:hidden;
}

.table-modern thead{
    background:#007bff;
    color:white;
}

.table-modern tbody tr{
    transition:0.3s;
}

.table-modern tbody tr:hover{
    background:#f1f7ff;
}

.patient-box{
    display:flex;
    align-items:center;
}

.patient-avatar{
    width:45px;
    height:45px;
    border-radius:50%;
    background:#007bff;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:bold;
    margin-right:10px;
}

.badge-modern{
    border-radius:30px;
    padding:8px 15px;
    font-size:12px;
}

.btn-modern{
    border-radius:30px;
    padding:7px 15px;
    font-size:12px;
    font-weight:600;
}

.search-box{
    border-radius:30px;
}

</style>

<div class="content-wrapper">

<section class="content p-3">

<div class="container-fluid">

<!-- HEADER -->

<div class="page-header">

<div class="d-flex justify-content-between align-items-center">

<div>

<h2>

<i class="fas fa-hospital-user"></i>

Pelayanan Pasien

</h2>

<p>

Sistem pelayanan pasien modern dan terintegrasi SIMRS Klinik Rozan

</p>

</div>

<div>

<a href="<?= base_url('pasien/tambah')?>"
class="btn btn-light btn-modern">

<i class="fas fa-user-plus"></i>

Tambah Pasien

</a>

</div>

</div>

</div>

<!-- INFO CARD -->

<div class="row">

<div class="col-md-4">

<div class="info-card bg-poli">

<h3>

<?= count($pasien_poli) ?>

</h3>

<h5>Pasien Poli</h5>

<p>Pelayanan rawat jalan aktif</p>

<i class="fas fa-user-injured"></i>

</div>

</div>

<div class="col-md-4">

<div class="info-card bg-igd">

<h3>

<?= count($pasien_igd) ?>

</h3>

<h5>Pasien IGD</h5>

<p>Pelayanan gawat darurat</p>

<i class="fas fa-ambulance"></i>

</div>

</div>

<div class="col-md-4">

<div class="info-card bg-rujukan">

<h3>

<?= count($rujukan_internal) ?>

</h3>

<h5>Rujukan Internal</h5>

<p>Rujukan antar poli</p>

<i class="fas fa-random"></i>

</div>

</div>

</div>

<!-- MAIN CARD -->

<div class="card card-modern">

<div class="card-body">

<!-- TAB -->

<ul class="nav nav-tabs nav-tabs-modern">

<li class="nav-item">

<a class="nav-link active"
data-toggle="tab"
href="#tab-poli">

<i class="fas fa-stethoscope"></i>

Pasien Poli

</a>

</li>

<li class="nav-item">

<a class="nav-link"
data-toggle="tab"
href="#tab-igd">

<i class="fas fa-ambulance"></i>

Pasien IGD

</a>

</li>

<li class="nav-item">

<a class="nav-link"
data-toggle="tab"
href="#tab-rujukan">

<i class="fas fa-random"></i>

Rujukan Internal

</a>

</li>

</ul>

<div class="tab-content">

<!-- TAB POLI -->

<div class="tab-pane fade show active"
id="tab-poli">

<div class="table-responsive">

<table class="table table-bordered table-hover table-modern datatable">

<thead>

<tr>

<th>Pasien</th>
<th>No RM</th>
<th>Poliklinik</th>
<th>Dokter</th>
<th>No Antrian</th>
<th>Status</th>
<th width="20%">Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($pasien_poli as $p): ?>

<tr>

<td>

<div class="patient-box">

<div class="patient-avatar">

<?= strtoupper(substr($p->nama_pasien,0,1)) ?>

</div>

<div>

<b>

<?= isset($p->nama_pasien)
? $p->nama_pasien
: '-' ?>

</b>

<br>

<small class="text-muted">

<?= isset($p->telepon)
? $p->telepon
: '-' ?>

</small>

</div>

</div>

</td>

<td>

<?= isset($p->no_rm)
? $p->no_rm
: '-' ?>

</td>

<td>

<span class="badge badge-primary badge-modern">

<?= isset($p->nama_poli)
? $p->nama_poli
: '-' ?>

</span>

</td>

<td>

<?= isset($p->nama_dokter)
? $p->nama_dokter
: '-' ?>

</td>

<td>

<span class="badge badge-info badge-modern">

<?php

if(isset($p->nomor_antrian)){

    echo $p->nomor_antrian;

}elseif(isset($p->no_antrian)){

    echo $p->no_antrian;

}else{

    echo '-';
}

?>

</span>

</td>

<td>

<?php

$status = isset($p->status)
? $p->status
: 'Menunggu';

?>

<?php if($status=='Sudah'): ?>

<span class="badge badge-success badge-modern">

Sudah

</span>

<?php else: ?>

<span class="badge badge-warning badge-modern">

Menunggu

</span>

<?php endif; ?>

</td>

<td>

<a href="<?= base_url('rekammedis/tambah/'.$p->id)?>"
class="btn btn-primary btn-sm btn-modern">

<i class="fas fa-stethoscope"></i>

Periksa

</a>

<a href="<?= base_url('pasien/detail/'.$p->pasien_id)?>"
class="btn btn-info btn-sm btn-modern">

<i class="fas fa-eye"></i>

Detail

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

<!-- TAB IGD -->

<div class="tab-pane fade"
id="tab-igd">

<div class="table-responsive">

<table class="table table-bordered table-hover table-modern datatable">

<thead>

<tr>

<th>Pasien</th>
<th>No RM</th>
<th>Dokter</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($pasien_igd as $i): ?>

<tr>

<td>

<?= isset($i->nama_pasien)
? $i->nama_pasien
: '-' ?>

</td>

<td>

<?= isset($i->no_rm)
? $i->no_rm
: '-' ?>

</td>

<td>

<?= isset($i->nama_dokter)
? $i->nama_dokter
: '-' ?>

</td>

<td>

<span class="badge badge-danger badge-modern">

IGD

</span>

</td>

<td>

<a href="<?= base_url('rekammedis/tambah/'.$i->id)?>"
class="btn btn-danger btn-sm btn-modern">

<i class="fas fa-heartbeat"></i>

Tangani

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

<!-- TAB RUJUKAN -->

<div class="tab-pane fade"
id="tab-rujukan">

<div class="table-responsive">

<table class="table table-bordered table-hover table-modern datatable">

<thead>

<tr>

<th>Pasien</th>
<th>Asal Poli</th>
<th>Tujuan Poli</th>
<th>Dokter</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($rujukan_internal as $r): ?>

<tr>

<td>

<?= isset($r->nama_pasien)
? $r->nama_pasien
: '-' ?>

</td>

<td>

<span class="badge badge-warning badge-modern">

<?= isset($r->asal_poli)
? $r->asal_poli
: '-' ?>

</span>

</td>

<td>

<span class="badge badge-success badge-modern">

<?= isset($r->tujuan_poli)
? $r->tujuan_poli
: '-' ?>

</span>

</td>

<td>

<?= isset($r->nama_dokter)
? $r->nama_dokter
: '-' ?>

</td>

<td>

<a href="<?= base_url('rekammedis/detail/'.$r->id)?>"
class="btn btn-info btn-sm btn-modern">

<i class="fas fa-file-medical"></i>

Lihat

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

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

<script>

$(function(){

    if ($.fn.DataTable.isDataTable('.datatable')) {

        $('.datatable').DataTable().destroy();

    }

    $('.datatable').DataTable({

        responsive:true,

        autoWidth:false,

        pageLength:10,

        ordering:true,

        language:{

            search:"Cari Data :",

            lengthMenu:"Tampilkan _MENU_ data",

            zeroRecords:"Data tidak ditemukan",

            info:"Menampilkan _START_ sampai _END_ dari _TOTAL_ data",

            paginate:{

                previous:"<",

                next:">"

            }

        }

    });

});

</script>