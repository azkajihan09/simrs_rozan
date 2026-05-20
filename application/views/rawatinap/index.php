<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<?php
$total_rawat = is_array($rawat) ? count($rawat) : 0;
$dirawat = 0;
$pulang = 0;

foreach ($rawat as $item) {
    if (strtoupper((string) $item->status) === 'DIRAWAT') {
        $dirawat++;
    } else {
        $pulang++;
    }
}
?>

<div class="content-wrapper p-3">

    <section class="content-header">

        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h1 class="m-0">

                    <i class="fas fa-bed text-primary"></i>
                    Rawat Inap

                </h1>

                <a href="<?= base_url('rawatinap/tambah') ?>"
                    class="btn btn-primary">

                    <i class="fas fa-plus"></i>
                    Tambah Rawat Inap

                </a>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-4">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $total_rawat ?></h3>
                            <p>Total Data Rawat Inap</p>
                        </div>
                        <div class="icon"><i class="fas fa-procedures"></i></div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $dirawat ?></h3>
                            <p>Pasien Masih Dirawat</p>
                        </div>
                        <div class="icon"><i class="fas fa-bed"></i></div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $pulang ?></h3>
                            <p>Pasien Sudah Pulang</p>
                        </div>
                        <div class="icon"><i class="fas fa-home"></i></div>
                    </div>

                </div>

            </div>

            <div class="card shadow-lg border-0">

                <div class="card-header bg-gradient-primary">

                    <h3 class="card-title text-white">

                        Data Rawat Inap

                    </h3>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover table-bordered datatable">

                            <thead class="bg-primary text-white">

                                <tr>

                                    <th>No RM</th>
                                    <th>Pasien</th>
                                    <th>Dokter</th>
                                    <th>Kamar</th>
                                    <th>Bed</th>
                                    <th>Status</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Aksi</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach ($rawat as $r): ?>

                                    <tr>

                                        <td><?= $r->no_rm ?></td>

                                        <td><?= $r->nama_pasien ?></td>

                                        <td><?= $r->nama_dokter ?></td>

                                        <td><?= $r->nama_kamar ?></td>

                                        <td><?= $r->nomor_bed ?></td>

                                        <td>

                                            <?php if ($r->status == 'DIRAWAT'): ?>

                                                <span class="badge badge-warning">

                                                    DIRAWAT

                                                </span>

                                            <?php else: ?>

                                                <span class="badge badge-success">

                                                    PULANG

                                                </span>

                                            <?php endif; ?>

                                        </td>

                                        <td>

                                            <?= date(
                                                'd-m-Y H:i',
                                                strtotime($r->tanggal_masuk)
                                            ) ?>

                                        </td>

                                        <td>

                                            <a href="<?= base_url('rawatinap/detail/' . $r->id) ?>"
                                                class="btn btn-info btn-sm">

                                                Detail

                                            </a>

                                            <?php if ($r->status == 'DIRAWAT'): ?>

                                                <a href="<?= base_url('rawatinap/pulang/' . $r->id) ?>"
                                                    class="btn btn-success btn-sm"
                                                    onclick="return confirm('Pasien sudah pulang?')">

                                                    Pasien Pulang

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

    </section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>