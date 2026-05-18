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