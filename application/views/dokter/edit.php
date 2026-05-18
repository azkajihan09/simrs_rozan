<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

    <section class="content-header">

        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h1 class="m-0 text-dark">

                    <i class="fas fa-user-md text-primary"></i>
                    Edit Dokter

                </h1>

                <a href="<?= base_url('dokter') ?>"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>
                    Kembali

                </a>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card shadow border-0">

                <div class="card-header bg-primary">

                    <h3 class="card-title text-white">

                        Form Edit Dokter

                    </h3>

                </div>

                <form method="POST">

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Poliklinik</label>

                                    <select name="poli_id"
                                            class="form-control"
                                            required>

                                        <option value="">
                                            -- Pilih Poliklinik --
                                        </option>

                                        <?php foreach($poli as $p): ?>

                                            <option value="<?= $p->id ?>"
                                                <?= $dokter->poli_id == $p->id ? 'selected' : '' ?>>

                                                <?= $p->nama_poli ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Nama Dokter</label>

                                    <input type="text"
                                           name="nama_dokter"
                                           class="form-control"
                                           value="<?= $dokter->nama_dokter ?>"
                                           required>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Spesialis</label>

                                    <input type="text"
                                           name="spesialis"
                                           class="form-control"
                                           value="<?= $dokter->spesialis ?>">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>No SIP</label>

                                    <input type="text"
                                           name="sip"
                                           class="form-control"
                                           value="<?= $dokter->sip ?>">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>STR Dokter</label>

                                    <input type="text"
                                           name="str_dokter"
                                           class="form-control"
                                           value="<?= $dokter->str_dokter ?>">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Telepon</label>

                                    <input type="text"
                                           name="telepon"
                                           class="form-control"
                                           value="<?= $dokter->telepon ?>">

                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>Jadwal Praktik</label>

                                    <textarea name="jadwal"
                                              class="form-control"
                                              rows="3"><?= $dokter->jadwal ?></textarea>

                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>Alamat</label>

                                    <textarea name="alamat"
                                              class="form-control"
                                              rows="3"><?= $dokter->alamat ?></textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer text-right">

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="fas fa-save"></i>
                            Update Dokter

                        </button>

                        <a href="<?= base_url('dokter') ?>"
                           class="btn btn-secondary">

                            Batal

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>