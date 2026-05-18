<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>

                        <i class="fas fa-stethoscope"></i>
                        Pemeriksaan Rekam Medis

                    </h1>

                </div>

                <div class="col-sm-6 text-right">

                    <a href="<?= base_url('pendaftaran'); ?>"
                       class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>
                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <!-- VALIDASI -->
            <?php if(validation_errors()) : ?>

                <div class="alert alert-danger">

                    <?= validation_errors(); ?>

                </div>

            <?php endif; ?>

            <!-- INFORMASI PASIEN -->
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
                                <?= $pendaftaran->no_rm; ?>
                            </p>

                        </div>

                        <div class="col-md-3">

                            <strong>Nama Pasien</strong>

                            <p>
                                <?= $pendaftaran->nama_pasien; ?>
                            </p>

                        </div>

                        <div class="col-md-3">

                            <strong>Dokter</strong>

                            <p>
                                <?= $pendaftaran->nama_dokter; ?>
                            </p>

                        </div>

                        <div class="col-md-3">

                            <strong>Poliklinik</strong>

                            <p>
                                <?= $pendaftaran->nama_poli; ?>
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- FORM PEMERIKSAAN -->
            <div class="card card-success card-outline">

                <div class="card-header">

                    <h3 class="card-title">

                        Form Pemeriksaan

                    </h3>

                </div>

                <form method="POST">

                    <div class="card-body">

                        <div class="row">

                            <!-- KELUHAN -->
                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>
                                        Keluhan
                                    </label>

                                    <textarea
                                        name="keluhan"
                                        class="form-control"
                                        rows="3"
                                        required><?= $pendaftaran->keluhan_awal; ?></textarea>

                                </div>

                            </div>

                            <!-- PEMERIKSAAN -->
                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>
                                        Pemeriksaan
                                    </label>

                                    <textarea
                                        name="pemeriksaan"
                                        class="form-control"
                                        rows="4"
                                        placeholder="Hasil pemeriksaan dokter..."
                                        required></textarea>

                                </div>

                            </div>

                            <!-- DIAGNOSA -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Diagnosa
                                    </label>

                                    <textarea
                                        name="diagnosa"
                                        class="form-control"
                                        rows="4"
                                        placeholder="Masukkan diagnosa..."
                                        required></textarea>

                                </div>

                            </div>

                            <!-- TINDAKAN -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Tindakan
                                    </label>

                                    <textarea
                                        name="tindakan"
                                        class="form-control"
                                        rows="4"
                                        placeholder="Tindakan medis..."></textarea>

                                </div>

                            </div>

                            <!-- TEKANAN DARAH -->
                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>
                                        Tekanan Darah
                                    </label>

                                    <input type="text"
                                           name="tekanan_darah"
                                           class="form-control"
                                           placeholder="120/80">

                                </div>

                            </div>

                            <!-- SUHU -->
                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>
                                        Suhu Tubuh
                                    </label>

                                    <input type="text"
                                           name="suhu"
                                           class="form-control"
                                           placeholder="36.5">

                                </div>

                            </div>

                            <!-- BERAT BADAN -->
                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>
                                        Berat Badan
                                    </label>

                                    <input type="text"
                                           name="berat_badan"
                                           class="form-control"
                                           placeholder="60 Kg">

                                </div>

                            </div>

                            <!-- TINGGI BADAN -->
                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>
                                        Tinggi Badan
                                    </label>

                                    <input type="text"
                                           name="tinggi_badan"
                                           class="form-control"
                                           placeholder="170 Cm">

                                </div>

                            </div>

                            <!-- CATATAN -->
                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>
                                        Catatan Dokter
                                    </label>

                                    <textarea
                                        name="catatan"
                                        class="form-control"
                                        rows="3"
                                        placeholder="Catatan tambahan dokter..."></textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer">

                        <button type="submit"
                                class="btn btn-success">

                            <i class="fas fa-save"></i>
                            Simpan Rekam Medis

                        </button>

                        <button type="reset"
                                class="btn btn-warning">

                            <i class="fas fa-redo"></i>
                            Reset

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

</div>

<!-- SWEET ALERT -->
<?php if($this->session->flashdata('success')) : ?>

<script>

Swal.fire({

    icon: 'success',

    title: 'Berhasil',

    text: '<?= $this->session->flashdata('success'); ?>',

    timer: 2500,

    showConfirmButton: false
});

</script>

<?php endif; ?>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>