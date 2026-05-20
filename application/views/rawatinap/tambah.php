<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

    <div class="card card-primary">

        <div class="card-header">

            <h3 class="card-title">

                Tambah Rawat Inap

            </h3>

        </div>

        <div class="card-body">

            <?php if ($this->session->flashdata('error')): ?>

                <div class="alert alert-danger">

                    <?= $this->session->flashdata('error') ?>

                </div>

            <?php endif; ?>

            <form method="POST">

                <input type="hidden"

                    name="<?= $this->security->get_csrf_token_name(); ?>"

                    value="<?= $this->security->get_csrf_hash(); ?>">

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Pasien</label>

                            <select
                                name="pasien_id"
                                class="form-control"
                                required>

                                <option value="">

                                    -- Pilih Pasien --

                                </option>

                                <?php foreach ($pasien as $p): ?>

                                    <option value="<?= $p->id_pasien ?>">

                                        <?= $p->no_rm ?>

                                        - <?= $p->nama_pasien ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Dokter</label>

                            <select
                                name="dokter_id"
                                class="form-control"
                                required>

                                <option value="">

                                    -- Pilih Dokter --

                                </option>

                                <?php foreach ($dokter as $d): ?>

                                    <option value="<?= $d->id ?>">

                                        <?= $d->nama_dokter ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label>Pilih Bed</label>

                            <select
                                name="bed_id"
                                class="form-control"
                                <?= empty($bed) ? 'disabled' : '' ?>
                                required>

                                <option value="">

                                    -- Pilih Bed --

                                </option>

                                <?php foreach ($bed as $b): ?>

                                    <option value="<?= $b->id ?>">

                                        <?= $b->nama_kamar ?>

                                        - Bed <?= $b->nomor_bed ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                            <?php if (empty($bed)): ?>

                                <small class="text-danger d-block mt-2">

                                    Belum ada data kamar atau bed kosong. Isi tabel kamar dan bed terlebih dahulu.

                                </small>

                            <?php endif; ?>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label>Diagnosa</label>

                            <textarea
                                name="diagnosa"
                                class="form-control"
                                rows="4"
                                required></textarea>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label>Kondisi Pasien</label>

                            <textarea
                                name="kondisi_pasien"
                                class="form-control"
                                rows="4"></textarea>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <button type="submit"
                            class="btn btn-primary">
                            <?= empty($bed) ? 'disabled' : '' ?>>

                            Simpan Rawat Inap

                        </button>

                        <a href="<?= base_url('rawatinap') ?>"
                            class="btn btn-secondary">

                            Kembali

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>