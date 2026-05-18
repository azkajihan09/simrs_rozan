<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

    <section class="content">

        <div class="container-fluid">

            <div class="card card-primary card-outline">

                <div class="card-header">

                    <h3 class="card-title">
                        <i class="fas fa-user-edit"></i>
                        Edit Pasien
                    </h3>

                </div>

                <div class="card-body">

                    <?php if(validation_errors()) : ?>

                        <div class="alert alert-danger">

                            <?= validation_errors(); ?>

                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="row">

                            <!-- NIK -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>NIK</label>

                                    <input type="text"
                                           name="nik"
                                           class="form-control"
                                           value="<?= $pasien->nik; ?>"
                                           required>

                                </div>

                            </div>

                            <!-- Nama -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Nama Pasien</label>

                                    <input type="text"
                                           name="nama_pasien"
                                           class="form-control"
                                           value="<?= $pasien->nama_pasien; ?>"
                                           required>

                                </div>

                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Jenis Kelamin</label>

                                    <select name="jenis_kelamin"
                                            class="form-control"
                                            required>

                                        <option value="">
                                            -- Pilih Jenis Kelamin --
                                        </option>

                                        <option value="L"
                                            <?= $pasien->jenis_kelamin == 'L' ? 'selected' : ''; ?>>

                                            Laki-laki

                                        </option>

                                        <option value="P"
                                            <?= $pasien->jenis_kelamin == 'P' ? 'selected' : ''; ?>>

                                            Perempuan

                                        </option>

                                    </select>

                                </div>

                            </div>

                            <!-- Tempat Lahir -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Tempat Lahir</label>

                                    <input type="text"
                                           name="tempat_lahir"
                                           class="form-control"
                                           value="<?= $pasien->tempat_lahir; ?>">

                                </div>

                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Tanggal Lahir</label>

                                    <input type="date"
                                           name="tanggal_lahir"
                                           class="form-control"
                                           value="<?= $pasien->tanggal_lahir; ?>">

                                </div>

                            </div>

                            <!-- Telepon -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Telepon</label>

                                    <input type="text"
                                           name="telepon"
                                           class="form-control"
                                           value="<?= $pasien->telepon; ?>">

                                </div>

                            </div>

                            <!-- Alamat -->
                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>Alamat</label>

                                    <textarea name="alamat"
                                              class="form-control"
                                              rows="4"><?= $pasien->alamat; ?></textarea>

                                </div>

                            </div>

                            <!-- Tombol -->
                            <div class="col-md-12">

                                <button type="submit"
                                        class="btn btn-primary">

                                    <i class="fas fa-save"></i>
                                    Update Pasien

                                </button>

                                <a href="<?= base_url('pasien'); ?>"
                                   class="btn btn-secondary">

                                    <i class="fas fa-arrow-left"></i>
                                    Kembali

                                </a>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>