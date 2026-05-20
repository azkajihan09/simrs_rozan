<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<?php
$total_radiologi = is_array($radiologi) ? count($radiologi) : 0;
$pending_radiologi = 0;
$selesai_radiologi = 0;

foreach ($radiologi as $item) {
    if (strtoupper((string) $item->status) === 'SELESAI') {
        $selesai_radiologi++;
    } else {
        $pending_radiologi++;
    }
}
?>

<div class="content-wrapper p-3">

    <section class="content-header">

        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h1 class="m-0">

                    <i class="fas fa-x-ray text-primary"></i>
                    Radiologi

                </h1>

                <a href="<?= base_url('radiologi/tambah') ?>"
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
                            <h3><?= $total_radiologi ?></h3>
                            <p>Total Permintaan Radiologi</p>
                        </div>
                        <div class="icon"><i class="fas fa-x-ray"></i></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $pending_radiologi ?></h3>
                            <p>Menunggu Hasil</p>
                        </div>
                        <div class="icon"><i class="fas fa-hourglass-half"></i></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $selesai_radiologi ?></h3>
                            <p>Selesai Diproses</p>
                        </div>
                        <div class="icon"><i class="fas fa-check-circle"></i></div>
                    </div>
                </div>

            </div>

            <div class="card shadow-lg border-0">

                <div class="card-header bg-gradient-primary">
                    <h3 class="card-title text-white">Daftar Pemeriksaan Radiologi</h3>
                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover table-bordered datatable">

                        <thead class="bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>No RM</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Pemeriksaan</th>
                                <th>Status</th>
                                <th width="22%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php $no = 1;
                            foreach ($radiologi as $r): ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $r->no_rm ?></td>
                                    <td><?= $r->nama_pasien ?></td>
                                    <td><?= $r->nama_dokter ?></td>
                                    <td><?= $r->jenis_pemeriksaan ?></td>
                                    <td>
                                        <?php if ($r->status == 'MENUNGGU'): ?>
                                            <span class="badge badge-warning p-2">MENUNGGU</span>
                                        <?php else: ?>
                                            <span class="badge badge-success p-2">SELESAI</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('radiologi/detail/' . $r->id) ?>"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="<?= base_url('radiologi/hasil/' . $r->id) ?>"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-notes-medical"></i>
                                        </a>

                                        <a href="<?= base_url('radiologi/hapus/' . $r->id) ?>"
                                            class="btn btn-danger btn-sm btn-delete">
                                            <i class="fas fa-trash"></i>
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