<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<?php
$total_lab = is_array($lab) ? count($lab) : 0;
$pending_lab = 0;
$selesai_lab = 0;

foreach ($lab as $item) {
    if (strtoupper((string) $item->status) === 'SELESAI') {
        $selesai_lab++;
    } else {
        $pending_lab++;
    }
}
?>

<div class="content-wrapper p-3">

    <section class="content-header">

        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h1 class="m-0">

                    <i class="fas fa-vials text-primary"></i>
                    Laboratorium

                </h1>

                <a href="<?= base_url('laboratorium/tambah') ?>"
                    class="btn btn-primary">

                    <i class="fas fa-plus"></i>
                    Tambah Permintaan

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
                            <h3><?= $total_lab ?></h3>
                            <p>Total Pemeriksaan Lab</p>
                        </div>
                        <div class="icon"><i class="fas fa-flask"></i></div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $pending_lab ?></h3>
                            <p>Menunggu Hasil</p>
                        </div>
                        <div class="icon"><i class="fas fa-hourglass-half"></i></div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $selesai_lab ?></h3>
                            <p>Selesai Diproses</p>
                        </div>
                        <div class="icon"><i class="fas fa-check-circle"></i></div>
                    </div>

                </div>

            </div>

            <div class="card shadow-lg border-0">

                <div class="card-header bg-gradient-primary">

                    <h3 class="card-title text-white">Daftar Pemeriksaan Laboratorium</h3>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover table-bordered datatable">

                        <thead class="bg-primary text-white">

                            <tr>
                                <th>No</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Pemeriksaan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th width="15%">Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php $no = 1;
                            foreach ($lab as $l): ?>

                                <?php $status = strtoupper((string) ($l->status ?: 'MENUNGGU')); ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <strong><?= $l->nama_pasien ?></strong>
                                    </td>
                                    <td><?= $l->nama_dokter ?></td>
                                    <td><?= $l->jenis_pemeriksaan ?></td>
                                    <td>
                                        <?php if ($status === 'SELESAI'): ?>
                                            <span class="badge badge-success p-2">SELESAI</span>
                                        <?php else: ?>
                                            <span class="badge badge-warning p-2">MENUNGGU</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= !empty($l->tanggal) ? date('d-m-Y H:i', strtotime($l->tanggal)) : '-' ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('laboratorium/hasil/' . $l->id) ?>"
                                            class="btn btn-primary btn-sm">

                                            <i class="fas fa-notes-medical"></i>
                                            <?= $status === 'SELESAI' ? 'Lihat Hasil' : 'Input Hasil' ?>

                                        </a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>