<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>

                        <i class="fas fa-cash-register"></i>
                        Billing / Kasir

                    </h1>

                </div>

                <div class="col-sm-6 text-right">

                    <a href="<?= base_url('billing'); ?>"
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

            <!-- INFO PASIEN -->
            <div class="card card-primary card-outline">

                <div class="card-header">

                    <h3 class="card-title">

                        Informasi Pasien

                    </h3>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-3">

                            <strong>No RM</strong>

                            <p>

                                <?= $rekam_medis->no_rm; ?>

                            </p>

                        </div>

                        <div class="col-md-3">

                            <strong>Nama Pasien</strong>

                            <p>

                                <?= $rekam_medis->nama_pasien; ?>

                            </p>

                        </div>

                        <div class="col-md-3">

                            <strong>Dokter</strong>

                            <p>

                                <?= $rekam_medis->nama_dokter; ?>

                            </p>

                        </div>

                        <div class="col-md-3">

                            <strong>Poli</strong>

                            <p>

                                <?= $rekam_medis->nama_poli; ?>

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- BILLING -->
            <div class="card card-success card-outline">

                <div class="card-header">

                    <h3 class="card-title">

                        Detail Pembayaran

                    </h3>

                </div>

                <form method="POST">

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-bordered">

                                <thead class="bg-success">

                                    <tr>

                                        <th>
                                            Item
                                        </th>

                                        <th width="25%">
                                            Biaya
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>

                                        <td>
                                            Biaya Pemeriksaan
                                        </td>

                                        <td>

                                            Rp
                                            <?= number_format(
                                                $biaya_pemeriksaan,
                                                0,
                                                ',',
                                                '.'
                                            ); ?>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>
                                            Biaya Tindakan
                                        </td>

                                        <td>

                                            Rp
                                            <?= number_format(
                                                $biaya_tindakan,
                                                0,
                                                ',',
                                                '.'
                                            ); ?>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>
                                            Biaya Obat
                                        </td>

                                        <td>

                                            Rp
                                            <?= number_format(
                                                $total_obat,
                                                0,
                                                ',',
                                                '.'
                                            ); ?>

                                        </td>

                                    </tr>

                                </tbody>

                                <tfoot>

                                    <tr>

                                        <th class="text-right">

                                            GRAND TOTAL

                                        </th>

                                        <th>

                                            Rp
                                            <?= number_format(
                                                $grand_total,
                                                0,
                                                ',',
                                                '.'
                                            ); ?>

                                        </th>

                                    </tr>

                                </tfoot>

                            </table>

                        </div>

                        <!-- TOTAL -->
                        <input type="hidden"
                               name="total"
                               value="<?= $grand_total; ?>">

                        <div class="row mt-4">

                            <!-- METODE -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Metode Pembayaran
                                    </label>

                                    <select
                                        name="metode_bayar"
                                        class="form-control"
                                        required>

                                        <option value="">
                                            -- Pilih Metode --
                                        </option>

                                        <option value="cash">
                                            Cash
                                        </option>

                                        <option value="transfer">
                                            Transfer
                                        </option>

                                        <option value="qris">
                                            QRIS
                                        </option>

                                        <option value="bpjs">
                                            BPJS
                                        </option>

                                    </select>

                                </div>

                            </div>

                            <!-- STATUS -->
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Status Pembayaran
                                    </label>

                                    <select
                                        name="status_bayar"
                                        class="form-control"
                                        required>

                                        <option value="">
                                            -- Pilih Status --
                                        </option>

                                        <option value="lunas">
                                            Lunas
                                        </option>

                                        <option value="belum">
                                            Belum Lunas
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer">

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="fas fa-save"></i>
                            Simpan Billing

                        </button>

                        <button type="button"
                                onclick="window.print()"
                                class="btn btn-success">

                            <i class="fas fa-print"></i>
                            Print Invoice

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

</div>

<!-- PRINT -->
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