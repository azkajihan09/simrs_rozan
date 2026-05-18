<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>

                        <i class="fas fa-file-medical-alt"></i>
                        Detail Rekam Medis

                    </h1>

                </div>

                <div class="col-sm-6 text-right">

                    <a href="<?= base_url('rekam_medis'); ?>"
                       class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>
                        Kembali

                    </a>

                    <button
                        onclick="window.print()"
                        class="btn btn-primary">

                        <i class="fas fa-print"></i>
                        Print

                    </button>

                </div>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <!-- DATA PASIEN -->
            <div class="card card-primary card-outline">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-user"></i>
                        Informasi Pasien

                    </h3>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-3">

                            <strong>No RM</strong>

                            <p>
                                <?= $detail->no_rm; ?>
                            </p>

                        </div>

                        <div class="col-md-3">

                            <strong>NIK</strong>

                            <p>
                                <?= $detail->nik; ?>
                            </p>

                        </div>

                        <div class="col-md-3">

                            <strong>Nama Pasien</strong>

                            <p>
                                <?= $detail->nama_pasien; ?>
                            </p>

                        </div>

                        <div class="col-md-3">

                            <strong>Jenis Kelamin</strong>

                            <p>
                                <?= $detail->jenis_kelamin; ?>
                            </p>

                        </div>

                        <div class="col-md-3">

                            <strong>Tanggal Lahir</strong>

                            <p>

                                <?= date(
                                    'd-m-Y',
                                    strtotime(
                                        $detail->tanggal_lahir
                                    )
                                ); ?>

                            </p>

                        </div>

                        <div class="col-md-3">

                            <strong>Telepon</strong>

                            <p>
                                <?= $detail->telepon; ?>
                            </p>

                        </div>

                        <div class="col-md-6">

                            <strong>Alamat</strong>

                            <p>
                                <?= $detail->alamat; ?>
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PEMERIKSAAN -->
            <div class="card card-success card-outline">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-stethoscope"></i>
                        Hasil Pemeriksaan

                    </h3>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">

                            <strong>Dokter</strong>

                            <p>
                                <?= $detail->nama_dokter; ?>
                            </p>

                        </div>

                        <div class="col-md-4">

                            <strong>Poliklinik</strong>

                            <p>
                                <?= $detail->nama_poli; ?>
                            </p>

                        </div>

                        <div class="col-md-4">

                            <strong>Tanggal Pemeriksaan</strong>

                            <p>

                                <?= date(
                                    'd-m-Y H:i',
                                    strtotime(
                                        $detail->created_at
                                    )
                                ); ?>

                            </p>

                        </div>

                    </div>

                    <hr>

                    <!-- VITAL SIGN -->
                    <div class="row">

                        <div class="col-md-3">

                            <div class="small-box bg-info">

                                <div class="inner">

                                    <h5>

                                        <?= $detail->tekanan_darah ?: '-'; ?>

                                    </h5>

                                    <p>
                                        Tekanan Darah
                                    </p>

                                </div>

                                <div class="icon">

                                    <i class="fas fa-heartbeat"></i>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="small-box bg-success">

                                <div class="inner">

                                    <h5>

                                        <?= $detail->suhu ?: '-'; ?>

                                    </h5>

                                    <p>
                                        Suhu Tubuh
                                    </p>

                                </div>

                                <div class="icon">

                                    <i class="fas fa-thermometer-half"></i>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="small-box bg-warning">

                                <div class="inner">

                                    <h5>

                                        <?= $detail->berat_badan ?: '-'; ?>

                                    </h5>

                                    <p>
                                        Berat Badan
                                    </p>

                                </div>

                                <div class="icon">

                                    <i class="fas fa-weight"></i>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="small-box bg-danger">

                                <div class="inner">

                                    <h5>

                                        <?= $detail->tinggi_badan ?: '-'; ?>

                                    </h5>

                                    <p>
                                        Tinggi Badan
                                    </p>

                                </div>

                                <div class="icon">

                                    <i class="fas fa-ruler-vertical"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- KELUHAN -->
                    <div class="mb-3">

                        <strong>Keluhan</strong>

                        <div class="border p-3 rounded">

                            <?= nl2br($detail->keluhan); ?>

                        </div>

                    </div>

                    <!-- PEMERIKSAAN -->
                    <div class="mb-3">

                        <strong>Pemeriksaan</strong>

                        <div class="border p-3 rounded">

                            <?= nl2br($detail->pemeriksaan); ?>

                        </div>

                    </div>

                    <!-- DIAGNOSA -->
                    <div class="mb-3">

                        <strong>Diagnosa</strong>

                        <div class="border p-3 rounded bg-light">

                            <?= nl2br($detail->diagnosa); ?>

                        </div>

                    </div>

                    <!-- TINDAKAN -->
                    <div class="mb-3">

                        <strong>Tindakan</strong>

                        <div class="border p-3 rounded">

                            <?= nl2br($detail->tindakan); ?>

                        </div>

                    </div>

                    <!-- CATATAN -->
                    <div class="mb-3">

                        <strong>Catatan Dokter</strong>

                        <div class="border p-3 rounded">

                            <?= nl2br($detail->catatan); ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<style>

@media print {

    .main-sidebar,
    .main-header,
    .content-header .btn,
    .main-footer {

        display: none !important;
    }

    .content-wrapper {

        margin-left: 0 !important;
    }
}

</style>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>