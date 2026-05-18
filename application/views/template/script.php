<script src="<?= base_url('assets/plugins/jquery/jquery.min.js')?>"></script>

<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

<script src="<?= base_url('assets/dist/js/adminlte.min.js')?>"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- ===================================================== -->
<!-- DATATABLE -->
<!-- ===================================================== -->

<script>

$(document).ready(function(){

    $('.datatable').DataTable({

        responsive:true,

        processing:true,

        pageLength:10,

        autoWidth:false,

        language:{
            search:"Cari:"
        }

    });

});

</script>

<!-- ===================================================== -->
<!-- SWEET ALERT DELETE -->
<!-- ===================================================== -->

<script>

$('.btn-delete').click(function(e){

    e.preventDefault();

    let url = $(this).attr('href');

    Swal.fire({

        title:'Hapus Data?',

        text:'Data tidak bisa dikembalikan',

        icon:'warning',

        showCancelButton:true

    }).then((result)=>{

        if(result.isConfirmed){

            window.location.href = url;
        }

    });

});

</script>

<!-- ===================================================== -->
<!-- TOAST NOTIFICATION -->
<!-- ===================================================== -->

<?php if($this->session->flashdata('success')): ?>

<script>

Swal.fire({

    toast:true,

    position:'top-end',

    icon:'success',

    title:'<?= $this->session->flashdata('success')?>',

    showConfirmButton:false,

    timer:3000

});

</script>

<?php endif; ?>