$(document).ready(function ()
{

    $('.elimina').click(function (e)
    {
        e.preventDefault();
        var url = $(this).attr('href');

        swal({
            title: "Sei sicuro?",
            text: "Sarà impossibile recuperare il file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sì, elimina!",
            closeOnConfirm: false
        }, function ()
        {
            showPreloader();
            location.href = url;
        });
    });

    $('.onoffswitch-checkbox').change(function ()
    {
        $.ajax({
            type: "GET",
            url: $(this).attr('data-url'),
            dataType: "json",
            success: function (data){ alert(data.msg);},
            error: function (){ alert("Si è verificato un errore! Riprova!");}
        });
    });

});


function showPreloader()
{
    $('#loader-box').show();
}

function hidePreloader()
{
    $('#loader-box').hide();
}

function get_modal(url)
{
    $.ajax({
        type: "GET",
        url: url,
        dataType: "html",
        success: function (data)
        {
            $('#myModal').html(data)
            .modal('show');

        },
        error: function ()
        {
            alert("Si è verificato un errore! Riprova!");
        }
    });
}
