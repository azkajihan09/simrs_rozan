<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content-wrapper p-3">

<section class="content-header">

<div class="container-fluid">

<h1>

<i class="fas fa-stethoscope text-primary"></i>
Pemeriksaan Pasien

</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<form method="POST">

<div class="row">

<!-- IDENTITAS -->

<div class="col-md-4">

<div class="card shadow border-0">

<div class="card-header bg-primary text-white">

Data Pasien

</div>

<div class="card-body">

<p>
<strong>No RM:</strong><br>
<?= $daftar->no_rm ?>
</p>

<p>
<strong>Nama:</strong><br>
<?= $daftar->nama_pasien ?>
</p>

<p>
<strong>Dokter:</strong><br>
<?= $daftar->nama_dokter ?>
</p>

<p>
<strong>Poli:</strong><br>
<?= $daftar->nama_poli ?>
</p>

</div>

</div>

</div>

<!-- PEMERIKSAAN -->

<div class="col-md-8">

<div class="card shadow border-0">

<div class="card-header bg-info text-white">

Form Pemeriksaan

</div>

<div class="card-body">

<div class="form-group">

<label>Keluhan</label>

<textarea name="keluhan"
class="form-control"
rows="2"></textarea>

</div>

<div class="form-group">

<label>Anamnesa</label>

<textarea name="anamnesa"
class="form-control"
rows="3"></textarea>

</div>

<div class="row">

<div class="col-md-4">

<div class="form-group">

<label>Tekanan Darah</label>

<input type="text"
name="tekanan_darah"
class="form-control">

</div>

</div>

<div class="col-md-4">

<div class="form-group">

<label>Berat Badan</label>

<input type="text"
name="berat_badan"
class="form-control">

</div>

</div>

<div class="col-md-4">

<div class="form-group">

<label>Suhu</label>

<input type="text"
name="suhu"
class="form-control">

</div>

</div>

</div>

<div class="form-group">

<label>Diagnosa</label>

<select name="diagnosa_id"
class="form-control select2"
required>

<option value="">
-- Pilih Diagnosa --
</option>

<?php foreach($diagnosa as $d): ?>

<option value="<?= $d->id ?>">

<?= $d->kode_icd ?>
-
<?= $d->nama_diagnosa ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="form-group">

<label>Tindakan</label>

<select name="tindakan_id[]"
class="form-control select2"
multiple>

<?php foreach($tindakan as $t): ?>

<option value="<?= $t->id ?>">

<?= $t->nama_tindakan ?>
-
Rp <?= number_format($t->tarif,0,',','.') ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="form-group">

<label>Catatan Dokter</label>

<textarea name="catatan"
class="form-control"
rows="3"></textarea>

</div>

<hr>

<h4 class="mb-3 text-primary">

<i class="fas fa-pills"></i>
Resep Obat

</h4>

<div id="resep-wrapper">

<div class="row resep-item mb-3 align-items-end">

    <div class="col-md-5">

        <label>Obat</label>

        <select
        name="obat_id[]"
        class="form-control select-obat">

            <option value="">
            -- Pilih Obat --
            </option>

            <?php foreach($obat as $o): ?>

            <option value="<?= $o->id ?>">

                <?= $o->nama_obat ?>

                (Stok: <?= $o->stok ?>)

            </option>

            <?php endforeach; ?>

        </select>

    </div>

    <div class="col-md-2">

        <label>Qty</label>

        <input
        type="number"
        name="qty[]"
        class="form-control"
        min="1"
        placeholder="Qty">

    </div>

    <div class="col-md-4">

        <label>Aturan Pakai</label>

        <input
        type="text"
        name="aturan_pakai[]"
        class="form-control"
        placeholder="3x1 sehari">

    </div>

    <div class="col-md-1">

        <button
        type="button"
        class="btn btn-danger remove-obat">

            <i class="fas fa-trash"></i>

        </button>

    </div>

</div>

</div>
<button
type="button"
id="tambah-obat"
class="btn btn-info mb-4">

<i class="fas fa-plus"></i>
Tambah Obat

</button>

<div class="form-group">

<label>

Catatan Resep

</label>

<textarea
name="catatan_resep"
class="form-control"
rows="3"
placeholder="Catatan tambahan resep..."></textarea>

</div>

</div>

<div class="card-footer text-right">

<button type="submit"
class="btn btn-primary btn-lg">

<i class="fas fa-save"></i>
Simpan Pemeriksaan

</button>

</div>

</div>

</div>

</div>

</form>

</div>

</section>

</div>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/script'); ?>
<script>

$(document).ready(function(){

    /*
    |--------------------------------------------------------------------------
    | INIT SELECT2
    |--------------------------------------------------------------------------
    */

    $('.select-obat').select2({

        theme:'bootstrap4',
        width:'100%'

    });

    /*
    |--------------------------------------------------------------------------
    | TEMPLATE RESEP
    |--------------------------------------------------------------------------
    */

    function resepTemplate(){

        return `

        <div class="row resep-item mb-3 align-items-end">

            <div class="col-md-5">

                <label>Obat</label>

                <select
                name="obat_id[]"
                class="form-control select-obat"
                required>

                    <option value="">
                    -- Pilih Obat --
                    </option>

                    <?php foreach($obat as $o): ?>

                    <option value="<?= $o->id ?>">

                        <?= $o->nama_obat ?>

                        (Stok: <?= $o->stok ?>)

                    </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="col-md-2">

                <label>Qty</label>

                <input
                type="number"
                min="1"
                name="qty[]"
                class="form-control"
                placeholder="Qty"
                required>

            </div>

            <div class="col-md-4">

                <label>Aturan Pakai</label>

                <input
                type="text"
                name="aturan_pakai[]"
                class="form-control"
                placeholder="3x1 sehari"
                required>

            </div>

            <div class="col-md-1">

                <button
                type="button"
                class="btn btn-danger remove-obat">

                    <i class="fas fa-trash"></i>

                </button>

            </div>

        </div>

        `;

    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH OBAT
    |--------------------------------------------------------------------------
    */

    $('#tambah-obat').click(function(){

        $('#resep-wrapper')
        .append(resepTemplate());

        $('.select-obat').select2({

            theme:'bootstrap4',
            width:'100%'

        });

    });

    /*
    |--------------------------------------------------------------------------
    | HAPUS OBAT
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.remove-obat',
        function(){

            $(this)
            .closest('.resep-item')
            .remove();

        }
    );

});

</script>

<script>

$(document).ready(function(){

    /*
    |--------------------------------------------------------------------------
    | INIT SELECT2
    |--------------------------------------------------------------------------
    */

    $('.select-obat').select2({

        theme:'bootstrap4',
        width:'100%'

    });

    /*
    |--------------------------------------------------------------------------
    | TEMPLATE
    |--------------------------------------------------------------------------
    */

    function resepTemplate(){

        return `
        <div class="row resep-item mb-3 align-items-end">

            <div class="col-md-5">

                <label>Obat</label>

                <select
                name="obat_id[]"
                class="form-control select-obat">

                    <option value="">
                    -- Pilih Obat --
                    </option>

                    <?php foreach($obat as $o): ?>

                    <option value="<?= $o->id ?>">

                        <?= $o->nama_obat ?>

                        (Stok: <?= $o->stok ?>)

                    </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="col-md-2">

                <label>Qty</label>

                <input
                type="number"
                name="qty[]"
                class="form-control"
                min="1"
                placeholder="Qty">

            </div>

            <div class="col-md-4">

                <label>Aturan Pakai</label>

                <input
                type="text"
                name="aturan_pakai[]"
                class="form-control"
                placeholder="3x1 sehari">

            </div>

            <div class="col-md-1">

                <button
                type="button"
                class="btn btn-danger remove-obat">

                    <i class="fas fa-trash"></i>

                </button>

            </div>

        </div>
        `;
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH OBAT
    |--------------------------------------------------------------------------
    */

    $('#tambah-obat').click(function(){

        $('#resep-wrapper')
        .append(resepTemplate());

        $('.select-obat').select2({

            theme:'bootstrap4',
            width:'100%'

        });

    });

    /*
    |--------------------------------------------------------------------------
    | HAPUS OBAT
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.remove-obat',
        function(){

            $(this)
            .closest('.resep-item')
            .remove();

        }
    );

});

</script>

<script>
$('.select2').select2();
</script>