<footer class="main-footer">
SIMRS Klinik Rozan
</footer>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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


<script>
$('#tablePasien').DataTable({

    responsive:true,

    processing:true,

    pageLength:10,

    autoWidth:false,

    language:{
        search:"Cari:"
    }

});</script>

<script>

$(document).ready(function(){

    /*
    |--------------------------------------------------------------------------
    | SELECT2
    |--------------------------------------------------------------------------
    */

    $('.select2').select2({

        theme: 'bootstrap4'

    });

    /*
    |--------------------------------------------------------------------------
    | TAMBAH OBAT
    |--------------------------------------------------------------------------
    */

    $('#tambah-obat').click(function(){

        let html =
            $('.resep-item:first')
            .clone();

        html.find('input').val('');

        html.find('select').val('');

        $('#resep-wrapper')
            .append(html);

        $('.select2').select2({

            theme:'bootstrap4'

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

            if(
                $('.resep-item').length > 1
            ){

                $(this)
                .closest('.resep-item')
                .remove();

            }

        }
    );

});

</script>
</body>
</html>
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js')?>"></script>

<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>


<script src="<?= base_url('assets/dist/js/adminlte.min.js')?>"></script>
