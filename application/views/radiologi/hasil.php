<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

    <section class="content-header">

        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h1 class="m-0">

                    <i class="fas fa-x-ray text-primary"></i>
                    Hasil Radiologi

                </h1>

                <a href="<?= base_url('radiologi') ?>"
                    class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>
                    Kembali

                </a>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-4">

                    <div class="card shadow-sm border-0">

                        <div class="card-header bg-gradient-primary">

                            <h3 class="card-title text-white">Informasi Pemeriksaan</h3>

                        </div>

                        <div class="card-body">

                            <div class="mb-3">
                                <small class="text-muted d-block">ID Radiologi</small>
                                <strong>#<?= $detail->id ?></strong>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block">No RM</small>
                                <strong><?= !empty($detail->no_rm) ? $detail->no_rm : '-' ?></strong>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block">Pasien</small>
                                <strong><?= !empty($detail->nama_pasien) ? $detail->nama_pasien : '-' ?></strong>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block">Dokter</small>
                                <strong><?= !empty($detail->nama_dokter) ? $detail->nama_dokter : '-' ?></strong>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block">Jenis Pemeriksaan</small>
                                <strong><?= !empty($detail->jenis_pemeriksaan) ? $detail->jenis_pemeriksaan : '-' ?></strong>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block">Tanggal Permintaan</small>
                                <strong><?= !empty($detail->tanggal) ? date('d-m-Y H:i', strtotime($detail->tanggal)) : '-' ?></strong>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block">Status</small>
                                <?php if (isset($detail->status) && strtoupper((string) $detail->status) === 'SELESAI'): ?>
                                    <span class="badge badge-success p-2">SELESAI</span>
                                <?php else: ?>
                                    <span class="badge badge-warning p-2">MENUNGGU</span>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($detail->file_hasil)): ?>
                                <div>
                                    <small class="text-muted d-block">File Hasil Saat Ini</small>
                                    <a href="<?= base_url('uploads/radiologi/' . $detail->file_hasil) ?>" target="_blank">
                                        <?= $detail->file_hasil ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                        </div>

                    </div>

                </div>

                <div class="col-md-8">

                    <div class="card shadow-lg border-0">

                        <div class="card-header bg-gradient-primary">

                            <h3 class="card-title text-white">Input Hasil Radiologi</h3>

                        </div>

                        <div class="card-body">

                            <form method="POST"
                                enctype="multipart/form-data">

                                <div class="form-group">

                                    <label>Hasil Radiologi</label>

                                    <textarea
                                        name="hasil"
                                        class="form-control"
                                        rows="8"
                                        required
                                        placeholder="Tulis hasil pemeriksaan radiologi di sini"><?= !empty($detail->hasil) ? $detail->hasil : '' ?></textarea>

                                </div>

                                <div class="form-group">

                                    <label>Upload File Hasil</label>

                                    <div class="custom-file">
                                        <input type="file"
                                            name="file_hasil"
                                            class="custom-file-input"
                                            id="file_hasil">
                                        <label class="custom-file-label" for="file_hasil">Pilih file hasil</label>
                                    </div>

                                    <small class="form-text text-muted">
                                        Format yang didukung: JPG, JPEG, PNG, PDF. Maksimal 5 MB.
                                    </small>

                                </div>

                                <div class="d-flex justify-content-between align-items-center">

                                    <a href="<?= base_url('radiologi') ?>"
                                        class="btn btn-light border">

                                        Batal

                                    </a>

                                    <button type="submit"
                                        class="btn btn-success">

                                        <i class="fas fa-save"></i>
                                        Simpan Hasil

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>

<script>
    $(document).ready(function() {

        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass('selected').html(fileName || 'Pilih file hasil');
        });

    });
</script>