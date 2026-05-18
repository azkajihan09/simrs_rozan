<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<div class="card">

<div class="card-header">

<h3>Presensi User</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<video id="video"
width="100%"
height="300"
autoplay
class="border rounded"></video>

<canvas id="canvas"
style="display:none"></canvas>

</div>

<div class="col-md-6">

<form method="POST"
action="<?= base_url('presensi/simpan')?>">

<input type="hidden"
name="foto"
id="foto">

<input type="hidden"
name="latitude"
id="latitude">

<input type="hidden"
name="longitude"
id="longitude">

<button type="button"
onclick="ambilFoto()"
class="btn btn-primary">

Ambil Foto

</button>

<button type="submit"
class="btn btn-success">

Absen Masuk

</button>

</form>

<hr>

<div id="preview"></div>

<div class="alert alert-info">

Lokasi GPS:
<span id="lokasi"></span>

</div>

</div>

</div>

<hr>

<div class="table-responsive">

<table class="table table-bordered table-striped"
id="tablePresensi">

<thead>

<tr>

<th>Tanggal</th>
<th>User</th>
<th>Jam Masuk</th>
<th>Jam Pulang</th>
<th>Foto</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($presensi as $p): ?>

<tr>

<td><?= $p->tanggal ?></td>

<td><?= $p->user_id ?></td>

<td><?= $p->jam_masuk ?></td>

<td><?= $p->jam_pulang ?></td>

<td>

<img src="<?= base_url('uploads/presensi/'.$p->foto)?>"
width="80">

</td>

<td>

<span class="badge badge-success">

<?= $p->status ?>

</span>

</td>

<td>

<?php if($p->status=='MASUK'): ?>

<a href="<?= base_url('presensi/pulang/'.$p->id)?>"
class="btn btn-danger btn-sm">

Absen Pulang

</a>

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>

<script>

const video = document.getElementById('video');

navigator.mediaDevices.getUserMedia({

    video:true

})

.then(stream => {

    video.srcObject = stream;

});

function ambilFoto(){

    let canvas = document.getElementById('canvas');

    canvas.width = video.videoWidth;

    canvas.height = video.videoHeight;

    let ctx = canvas.getContext('2d');

    ctx.drawImage(
        video,
        0,
        0
    );

    let foto = canvas.toDataURL('image/png');

    document.getElementById('foto').value = foto;

    document.getElementById('preview').innerHTML =

    '<img src="'+foto+'" width="200" class="img-thumbnail">';
}

navigator.geolocation.getCurrentPosition(

    function(position){

        document.getElementById('latitude').value =

            position.coords.latitude;

        document.getElementById('longitude').value =

            position.coords.longitude;

        document.getElementById('lokasi').innerHTML =

            position.coords.latitude +

            ',' +

            position.coords.longitude;
    }

);

$(document).ready(function(){

    $('#tablePresensi').DataTable({

        responsive:true

    });

});

</script>