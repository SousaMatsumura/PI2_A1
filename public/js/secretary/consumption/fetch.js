$(document).ready(function () {

    /*** Handle Datepicker */

    var today = new Date();
    var inputString = $('#consumption-created-at').val().split("/");
    var inputDate = new Date(inputString[2], inputString[1] - 1, inputString[0]);

    let datepicker = $('#consumption-created-at').datepicker({
        language: 'pt-BR',
        autoclose: true,
        showOnFocus: false,
        endDate: today,
    });

    $('#consumption-created-at-datepicker-icon').click(function() {
        datepicker.datepicker('show')
    })


    $('#consumption-created-at').on("cut copy paste",function(e) {
        e.preventDefault();
    });

    $('#consumption-created-at').keydown(function(event) {
        if (event.ctrlKey==true && (event.which == '118' || event.which == '86')) {
            event.preventDefault();
        }
    });

    $( "#consumption-created-at, #search" ).change(function() {
        fetch();
    });

    $("form").submit( function (e){
        e.preventDefault();
        //e.stopPropagation();
        fetch();
    });


    /*** END Handle Datepicker */


    /*** Handle Fetch */

    var institution = <?php echo json_encode($institution) ?>;

    fetch();

    function fetch(){
        $.ajax({
            type: "GET",
            url: '/secretaria/escola/' +institution.id+ '/fetch',
            dataType: 'json',
            success: function (response){
                $('tbody').html("");
                //console.log("FARINHA".toLowerCase() $('#search').val().toLowerCase());
                //console.log();
                $.each(response.consumptions, function (key, item){
                    if($('#consumption-created-at').val() === item.created_at &&
                        item.name.toLowerCase().includes($('#search').val().toLowerCase())){
                        
                        $('tbody').append('<tr>\
                            <td class="align-middle">'+
                                item.name
                            +'</td>\
                            <td class="align-middle text-center">'+
                                item.unit
                            +'</td>\
                            <td class="align-middle text-center">'+
                                item.amount
                            +'</td>\
                        </tr>');
                    }
                });
            },
        })
    };

    /*** END Handle Fetch */
});