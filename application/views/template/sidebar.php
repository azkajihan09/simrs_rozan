<?php

$role =
    $this->session->userdata('role');
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?= base_url('dashboard') ?>"
        class="brand-link text-center">

        <span class="brand-text font-weight-light">

            <b>SIMRS</b> Klinik Rozan

        </span>

    </a>

    <div class="sidebar">

        <nav class="mt-3">

            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <!-- DASHBOARD -->

                <li class="nav-item">

                    <a href="<?= base_url('dashboard') ?>"
                        class="nav-link">

                        <i class="nav-icon fas fa-tachometer-alt"></i>

                        <p>Dashboard</p>

                    </a>

                </li>

                <!-- MASTER DATA -->

                <li class="nav-header">

                    MASTER DATA

                </li>

                <li class="nav-item has-treeview">

                    <a href="#"
                        class="nav-link">

                        <i class="nav-icon fas fa-database"></i>

                        <p>

                            Master Data

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">

                            <a href="<?= base_url('pasien') ?>"
                                class="nav-link">

                                <i class="far fa-user nav-icon"></i>

                                <p>Data Pasien</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= base_url('dokter') ?>"
                                class="nav-link">

                                <i class="fas fa-user-md nav-icon"></i>

                                <p>Data Dokter</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= base_url('poliklinik') ?>"
                                class="nav-link">

                                <i class="fas fa-hospital nav-icon"></i>

                                <p>Poliklinik</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= base_url('kamar') ?>"
                                class="nav-link">

                                <i class="fas fa-door-open nav-icon"></i>

                                <p>Master Kamar</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= base_url('bed') ?>"
                                class="nav-link">

                                <i class="fas fa-bed nav-icon"></i>

                                <p>Master Bed</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= base_url('obat') ?>"
                                class="nav-link">

                                <i class="fas fa-capsules nav-icon"></i>

                                <p>Master Obat</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= base_url('master_tindakan') ?>"
                                class="nav-link">

                                <i class="fas fa-stethoscope nav-icon"></i>

                                <p>Master Tindakan</p>

                            </a>

                        </li>

                    </ul>

                </li>

                <!-- PENDAFTARAN -->

                <li class="nav-header">

                    PENDAFTARAN

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('pendaftaran') ?>"
                        class="nav-link">

                        <i class="nav-icon fas fa-address-card"></i>

                        <p>Pendaftaran Pasien</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('antrian') ?>"
                        class="nav-link">

                        <i class="nav-icon fas fa-list-ol"></i>

                        <p>Antrian Pasien</p>

                    </a>

                </li>

                <!-- PELAYANAN -->

                <li class="nav-header">

                    PELAYANAN MEDIS

                </li>

                <li class="nav-item has-treeview">

                    <a href="#"
                        class="nav-link">

                        <i class="nav-icon fas fa-procedures"></i>

                        <p>

                            Pelayanan Medis

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                        <?php if (
                            in_array(
                                $role,
                                ['super_admin', 'admin', 'dokter']
                            )
                        ): ?>

                            <li class="nav-item">

                                <a href="<?= base_url('rekam_medis') ?>"
                                    class="nav-link">

                                    <i class="fas fa-notes-medical nav-icon"></i>

                                    <p>Rekam Medis</p>

                                </a>

                            </li>

                        <?php endif; ?>

                        <li class="nav-item">

                            <a href="<?= base_url('laboratorium') ?>"
                                class="nav-link">

                                <i class="fas fa-vials nav-icon"></i>

                                <p>Laboratorium</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= base_url('radiologi') ?>"
                                class="nav-link">

                                <i class="fas fa-x-ray nav-icon"></i>

                                <p>Radiologi</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= base_url('rawatinap') ?>"
                                class="nav-link">

                                <i class="fas fa-bed nav-icon"></i>

                                <p>Rawat Inap</p>

                            </a>

                        </li>

                    </ul>

                </li>

                <!-- FARMASI -->

                <li class="nav-header">

                    FARMASI

                </li>

                <li class="nav-item has-treeview">

                    <a href="#"
                        class="nav-link">

                        <i class="nav-icon fas fa-pills"></i>

                        <p>

                            Farmasi

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                        <?php if (
                            in_array(
                                $role,
                                ['super_admin', 'admin', 'farmasi']
                            )
                        ): ?>

                            <li class="nav-item">

                                <a href="<?= base_url('farmasi') ?>"
                                    class="nav-link">

                                    <i class="fas fa-pills nav-icon"></i>

                                    <p>Farmasi</p>

                                </a>

                            </li>

                        <?php endif; ?>

                        <li class="nav-item">

                            <a href="<?= base_url('resep') ?>"
                                class="nav-link">

                                <i class="fas fa-file-medical nav-icon"></i>

                                <p>Resep Obat</p>

                            </a>

                        </li>

                    </ul>

                </li>

                <!-- BILLING -->

                <li class="nav-header">

                    TRANSAKSI

                </li>

                <?php if (
                    in_array(
                        $role,
                        ['super_admin', 'admin', 'kasir']
                    )
                ): ?>

                    <li class="nav-item">

                        <a href="<?= base_url('billing') ?>"
                            class="nav-link">

                            <i class="fas fa-cash-register nav-icon"></i>

                            <p>Billing</p>

                        </a>

                    </li>

                <?php endif; ?>

                <!-- LAPORAN -->

                <li class="nav-header">

                    LAPORAN

                </li>

                <li class="nav-item has-treeview">

                    <a href="#"
                        class="nav-link">

                        <i class="nav-icon fas fa-chart-bar"></i>

                        <p>

                            Laporan

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">

                            <a href="<?= base_url('laporan/pendapatan') ?>"
                                class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Laporan Pendapatan</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= base_url('laporan/jasa_dokter') ?>"
                                class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Jasa Dokter</p>

                            </a>

                        </li>

                    </ul>

                </li>

                <!-- HRD -->

                <li class="nav-header">

                    HRD & KEUANGAN

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('hrd/payroll') ?>"
                        class="nav-link">

                        <i class="nav-icon fas fa-user-tie"></i>

                        <p>Payroll</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('keuangan') ?>"
                        class="nav-link">

                        <i class="nav-icon fas fa-chart-line"></i>

                        <p>Keuangan</p>

                    </a>

                </li>

                <!-- PENGATURAN -->

                <li class="nav-header">

                    PENGATURAN

                </li>

                <li class="nav-item has-treeview">

                    <a href="#"
                        class="nav-link">

                        <i class="nav-icon fas fa-cogs"></i>

                        <p>

                            Pengaturan

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">

                            <a href="<?= base_url('pengaturan') ?>"
                                class="nav-link">

                                <i class="fas fa-sliders-h nav-icon"></i>

                                <p>Pengaturan Sistem</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= base_url('pengaturan/backup_database') ?>"
                                class="nav-link">

                                <i class="fas fa-database nav-icon"></i>

                                <p>Backup Database</p>

                            </a>

                        </li>

                    </ul>

                </li>

            </ul>

        </nav>

    </div>

</aside>