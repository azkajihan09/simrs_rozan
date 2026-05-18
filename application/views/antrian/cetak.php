<!DOCTYPE html>
<html>
<head>

<title>Cetak Antrian</title>

<style>

body{

    font-family:Arial;

    text-align:center;

    width:300px;

}

.nomor{

    font-size:70px;

    font-weight:bold;

}

</style>

</head>

<body onload="window.print()">

<h3>KLINIK ROZAN</h3>

<hr>

<p>Nomor Antrian</p>

<div class="nomor">

<?= $antrian->kode_antrian ?>

</div>

<p>

<?= $antrian->nama_pasien ?>

</p>

<p>

Dokter:
<br>

<?= $antrian->nama_dokter ?>

</p>

<p>

<?= date('d-m-Y') ?>

</p>

</body>
</html>