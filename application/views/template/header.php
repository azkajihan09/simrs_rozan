<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>SIMRS Klinik Rozan</title>

<link rel="stylesheet"
href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">

<link rel="stylesheet"
href="<?= base_url('assets/dist/css/adminlte.min.css')?>">

<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<link rel="stylesheet"
href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

<style>

body{
    font-family:'Poppins',sans-serif;
    background:#f4f6f9;
}

.brand-link{
    background:linear-gradient(
    135deg,
    #0ea5e9,
    #2563eb
    );
    color:white !important;
}

.main-sidebar{
    background:#111827 !important;
}

.nav-sidebar .nav-link{
    border-radius:10px;
    margin-bottom:5px;
}

.nav-sidebar .nav-link:hover{
    background:#2563eb;
    color:white !important;
}

.nav-sidebar .nav-link.active{
    background:#0ea5e9 !important;
    color:white !important;
}

.card{
    border:none;
    border-radius:18px;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

.small-box{
    border-radius:18px;
    overflow:hidden;
}

.content-wrapper{
    background:#f1f5f9;
}

.navbar{
    backdrop-filter:blur(10px);
}

.table{
    border-radius:10px;
    overflow:hidden;
}

.btn{
    border-radius:10px;
}

.card-header{
    border-bottom:none;
    background:white;
}

.preloader{
    background:white;
}

</style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

<!-- PRELOADER -->

<div class="preloader flex-column justify-content-center align-items-center">

<img
class="animation__shake"
src="<?= base_url('assets/logo.png')?>"
alt="SIMRS"
height="100">

</div>