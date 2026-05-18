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

                        <i class="fas fa-user-injured"></i>
                        Detail Pasien

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

                <div class="card-header bg-info">

                    <h3 class="card-title text-white">

                        Informasi Pasien

                    </h3>

                </div>

                <div class="card-body">

                    <?php if(!empty($pasien)): ?>

                    <div class="row">

                        <div class="col-md-8">

                            <table class="table table-bordered table-striped">

                                <tr>

                                    <th width="30%">

                                        No RM

                                    </th>

                                    <td>

                                        <?= $pasien->no_rm ?? '-' ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        NIK

                                    </th>

                                    <td>

                                        <?= $pasien->nik ?? '-' ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Nama Pasien

                                    </th>

                                    <td>

                                        <strong>

                                            <?= $pasien->nama_pasien ?? '-' ?>

                                        </strong>

                                    </td>

                                </tr>

                                <tr>

    <th>

        Jenis Kelamin

    </th>

    <td>

        <?php

            $jk = $pasien->jenis_kelamin
                ?? $pasien->jk
                ?? $pasien->gender
                ?? null;

            if($jk == 'L'){
                echo 'Laki-laki';
            } elseif($jk == 'P'){
                echo 'Perempuan';
            } elseif(!empty($jk)){
                echo $jk;
            } else {
                echo '-';
            }

        ?>

    </td>

</tr>

                                <tr>

                                    <th>

                                        Telepon

                                    </th>

                                    <td>

                                        <?= $pasien->telepon ?? '-' ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Alamat

                                    </th>

                                    <td>

                                        <?= $pasien->alamat ?? '-' ?>

                                    </td>

                                </tr>

                            </table>

                        </div>

                    </div>

                    <?php else: ?>

                    <div class="alert alert-danger">

                        Data pasien tidak ditemukan.

                    </div>

                    <?php endif; ?>

                </div>

                <div class="card-footer">

                    <a href="<?= base_url('pasien/edit/'.$pasien->id_pasien) ?>"
                       class="btn btn-warning">

                        <i class="fas fa-edit"></i>
                        Edit Pasien

                    </a>

                    <a href="<?= base_url('rekam_medis/pasien/'.$pasien->id_pasien) ?>"
                       class="btn btn-primary">

                        <i class="fas fa-notes-medical"></i>
                        Rekam Medis

                    </a>

                </div>

            </div>

        </div>

    </section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>