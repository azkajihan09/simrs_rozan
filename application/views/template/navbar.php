<?php

$user = $this->session->userdata('nama');

$role = $this->session->userdata('role');

$ip = $_SERVER['REMOTE_ADDR'];

?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">

<!-- LEFT -->

<ul class="navbar-nav">

<li class="nav-item">

<a class="nav-link"
data-widget="pushmenu"
href="#">

<i class="fas fa-bars"></i>

</a>

</li>

<li class="nav-item d-none d-sm-inline-block">

<a href="<?= base_url('dashboard')?>"
class="nav-link">

Dashboard

</a>

</li>

<li class="nav-item d-none d-sm-inline-block">

<a href="<?= base_url('rekammedis')?>"
class="nav-link">

Rekam Medis

</a>

</li>

<li class="nav-item d-none d-sm-inline-block">

<a href="<?= base_url('billing')?>"
class="nav-link">

Billing

</a>

</li>

</ul>

<!-- RIGHT -->

<ul class="navbar-nav ml-auto">

<!-- REALTIME CLOCK -->

<li class="nav-item mr-3 mt-2">

<span id="clock"
class="text-primary font-weight-bold"></span>

</li>

<!-- USER MENU -->

<li class="nav-item dropdown user-menu">

<a href="#"
class="nav-link dropdown-toggle"
data-toggle="dropdown">

<img src="<?= base_url('assets/dist/img/user2-160x160.jpg')?>"
class="user-image img-circle elevation-2"
alt="User Image">

<span class="d-none d-md-inline">

<?= $user ?>

</span>

</a>

<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

<!-- HEADER -->

<li class="user-header bg-primary">

<img src="<?= base_url('assets/dist/img/user2-160x160.jpg')?>"
class="img-circle elevation-2"
alt="User Image">

<p>

<?= $user ?>

<br>

<small>

<?= $role ?>

</small>

</p>

</li>

<!-- BODY -->

<li class="user-body">

<div class="row text-center">

<div class="col-12">

<div class="mb-2">

<i class="fas fa-network-wired text-primary"></i>

</div>

<strong>IP Address</strong>

<br>

<small>

<?= $ip ?>

</small>

</div>

</div>

<hr>

<div class="row text-center">

<div class="col-6">

<strong>Status</strong>

<br>

<span class="badge badge-success">

Online

</span>

</div>

<div class="col-6">

<strong>Role</strong>

<br>

<span class="badge badge-info">

<?= $role ?>

</span>

</div>

</div>

</li>

<!-- FOOTER -->

<li class="user-footer">

<a href="<?= base_url('profile')?>"
class="btn btn-default btn-flat">

<i class="fas fa-user"></i>

Profile

</a>

<a href="<?= base_url('auth/logout')?>"
class="btn btn-danger btn-flat float-right">

<i class="fas fa-sign-out-alt"></i>

Logout

</a>

</li>

</ul>

</li>

<!-- FULLSCREEN -->

<li class="nav-item">

<a class="nav-link"
data-widget="fullscreen"
href="#">

<i class="fas fa-expand-arrows-alt"></i>

</a>

</li>

</ul>

</nav>

<script>

function updateClock(){

    const now = new Date();

    const time = now.toLocaleTimeString();

    document.getElementById(
        'clock'
    ).innerHTML = time;
}

setInterval(updateClock,1000);

updateClock();

</script>