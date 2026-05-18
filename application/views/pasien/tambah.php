<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

    <!-- HEADER -->
    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>

                        <i class="fas fa-user-plus"></i>
                        Tambah Pasien

                    </h1>

                </div>

                <div class="col-sm-6 text-right">

                    <a href="<?= base_url('pasien') ?>"
                       class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>
                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </section>

    <!-- CONTENT -->
    <section class="content">

        <div class="container-fluid">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-primary">

                    <h3 class="card-title text-white">

                        Form Data Pasien

                    </h3>

                </div>

                <form method="post"
                      action="<?= base_url('pasien/simpan') ?>">

                    <div class="card-body">

                        <div class="row">

                            <!-- NO RM -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>No RM</label>

                                    <input type="text"
                                           name="no_rm"
                                           class="form-control"
                                           value="<?= $kode_rm ?? '' ?>"
                                           readonly>

                                </div>

                            </div>

                            <!-- NIK -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>NIK</label>

                                    <input type="text"
                                           name="nik"
                                           class="form-control"
                                           required>

                                </div>

                            </div>

                            <!-- NAMA -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Nama Pasien</label>

                                    <input type="text"
                                           name="nama_pasien"
                                           class="form-control"
                                           required>

                                </div>

                            </div>

                            <!-- JK -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Jenis Kelamin</label>

                                    <select name="jenis_kelamin"
                                            class="form-control"
                                            required>

                                        <option value="">
                                            -- Pilih --
                                        </option>

                                        <option value="Laki-laki">
                                            Laki-laki
                                        </option>

                                        <option value="Perempuan">
                                            Perempuan
                                        </option>

                                    </select>

                                </div>

                            </div>

                            <!-- TGL LAHIR -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Tanggal Lahir</label>

                                    <input type="date"
                                           name="tanggal_lahir"
                                           class="form-control">

                                </div>

                            </div>

                            <!-- TELEPON -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Telepon</label>

                                    <input type="text"
                                           name="telepon"
                                           class="form-control">

                                </div>

                            </div>

                            <!-- ALAMAT -->
                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>Alamat</label>

                                    <textarea name="alamat"
                                              rows="4"
                                              class="form-control"></textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer">

                        <button type="submit"
                                class="btn btn-primary btn-submit">

                            <i class="fas fa-save"></i>
                            Simpan Pasien

                        </button>

                        <a href="<?= base_url('pasien') ?>"
                           class="btn btn-secondary">

                            <i class="fas fa-times"></i>
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

<script>

$('form').submit(function(){

    $('.btn-submit').prop('disabled', true);

    $('.btn-submit').html(

        '<i class="fas fa-spinner fa-spin"></i> Menyimpan...'

    );

});

</script>