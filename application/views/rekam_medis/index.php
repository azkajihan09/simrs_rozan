<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-3">

            <div class="col-sm-6">

                <h1 class="font-weight-bold">

                    <i class="fas fa-notes-medical text-primary"></i>
                    Rekam Medis

                </h1>

            </div>

        </div>

    </div>

</section>

<section class="content">

    <div class="container-fluid">

        <div class="card shadow border-0">

            <div class="card-header bg-primary">

                <h3 class="card-title text-white">

                    Data Rekam Medis

                </h3>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table id="table-rm"
                           class="table table-bordered table-striped table-hover">

                        <thead class="thead-dark">

                            <tr>

                                <th width="5%">
                                    No
                                </th>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    No RM
                                </th>

                                <th>
                                    Nama Pasien
                                </th>

                                <th>
                                    Poli
                                </th>

                                <th>
                                    Dokter
                                </th>

                                <th>
                                    Diagnosa
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php if(!empty($rekam_medis)): ?>

                            <?php $no = 1; ?>

                            <?php foreach($rekam_medis as $row): ?>

                                <tr>

                                    <td>

                                        <?= $no++; ?>

                                    </td>

                                    <td>

                                        <?php if(!empty($row->created_at)): ?>

                                            <?= date(
                                                'd-m-Y H:i',
                                                strtotime(
                                                    $row->created_at
                                                )
                                            ); ?>

                                        <?php else: ?>

                                            -

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <span class="badge badge-info p-2">

                                            <?= (isset($row->no_rm) ? $row->no_rm : '-' ?>)

                                        </span>

                                    </td>

                                    <td>

                                        <strong>

                                            <?= (isset($row->nama_pasien) ? $row->nama_pasien : '-' ?>)

                                        </strong>

                                    </td>

                                    <td>

                                        <?= (isset($row->nama_poli) ? $row->nama_poli : '-' ?>)

                                    </td>

                                    <td>

                                        <?= (isset($row->nama_dokter) ? $row->nama_dokter : '-' ?>)

                                    </td>

                                    <td>

                                        <?= (isset($row->diagnosa) ? $row->diagnosa : '-' ?>)

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td colspan="7"
                                    class="text-center text-muted">

                                    Tidak ada data rekam medis

                                </td>

                            </tr>

                        <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</section>

</div>

<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>

$(document).ready(function(){

    $('#table-rm').DataTable({

        responsive: true,
        autoWidth: false

    });

});

</script>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>