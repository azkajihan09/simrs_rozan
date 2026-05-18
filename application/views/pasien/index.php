<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-3">

                <div class="col-sm-6">
                    <h1><?= $title ?></h1>
                </div>

                <div class="col-sm-6 text-right">

                    <a href="<?= base_url('pasien/tambah') ?>"
                       class="btn btn-primary">

                        <i class="fas fa-plus"></i>
                        Tambah Pasien

                    </a>

                </div>

            </div>

        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

            <!-- FLASHDATA -->

            <?php if($this->session->flashdata('success')): ?>

                <div class="alert alert-success alert-dismissible fade show">

                    <?= $this->session->flashdata('success') ?>

                    <button type="button"
                            class="close"
                            data-dismiss="alert">

                        <span>&times;</span>

                    </button>

                </div>

            <?php endif; ?>

            <!-- CARD -->

            <div class="card shadow">

                <div class="card-header bg-primary">

                    <h3 class="card-title text-white">

                        Data Pasien

                    </h3>

                </div>

                <div class="card-body table-responsive">

                    <table id="tablePasien"
                           class="table table-bordered table-striped table-hover">

                        <thead class="thead-dark">

                            <tr>

                                <th width="5%">No</th>
                                <th>No RM</th>
                                <th>NIK</th>
                                <th>Nama Pasien</th>
                                <th>JK</th>
                                <th>Telepon</th>
                                <th width="20%">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if(!empty($pasien)): ?>

                                <?php $no = 1; ?>

                                <?php foreach($pasien as $p): ?>

                                    <tr>

                                        <td><?= $no++ ?></td>

                                        <td>
                                            <?= $p->no_rm ?>
                                        </td>

                                        <td>
                                            <?= $p->nik ?>
                                        </td>

                                        <td>
                                            <?= $p->nama_pasien ?>
                                        </td>

                                        <td>

                                            <?php if($p->jenis_kelamin == 'L'): ?>

                                                <span class="badge badge-primary">
                                                    Laki-laki
                                                </span>

                                            <?php else: ?>

                                                <span class="badge badge-pink">
                                                    Perempuan
                                                </span>

                                            <?php endif; ?>

                                        </td>

                                        <td>
                                            <?= $p->telepon ?>
                                        </td>

                                        <td>

                                            <a href="<?= base_url('pasien/detail/'.$p->id_pasien) ?>"
                                               class="btn btn-info btn-sm">

                                                <i class="fas fa-eye"></i>

                                            </a>

                                            <a href="<?= base_url('pasien/edit/'.$p->id_pasien) ?>"
                                               class="btn btn-warning btn-sm">

                                                <i class="fas fa-edit"></i>

                                            </a>

                                            <button
                                                class="btn btn-danger btn-sm btn-hapus"
                                                data-hapus="<?= base_url('pasien/hapus/'.$p->id_pasien) ?>">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td colspan="7"
                                        class="text-center">

                                        Tidak ada data pasien

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>

<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>

$(document).ready(function(){

    $('#tablePasien').DataTable();

    $('.btn-hapus').click(function(){

        let url = $(this).data('hapus');

        Swal.fire({

            title: 'Yakin hapus data?',
            text: 'Data pasien akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus'

        }).then((result) => {

            if(result.isConfirmed){

                window.location.href = url;

            }

        });

    });

});

</script>