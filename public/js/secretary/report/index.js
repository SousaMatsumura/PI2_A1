var endDate = new Date()
var beginString = $('#begin-created-at').val().split("/")
var inputBegintDate = new Date(beginString[2], beginString[1] - 1, beginString[0])
var endString = $('#end-created-at').val().split("/")
var inputEndDate = new Date(endString[2], endString[1] - 1, endString[0])

let beginDatepicker = $('#begin-created-at').datepicker({
    language: 'pt-BR',
    autoclose: true,
    showOnFocus: false,
    endDate: inputEndDate,
})

$( "#begin-created-at" ).change(function() {
    //console.log($( "#begin-created-at" ).val())
    //alert( "Handler for .change() called." );
    $('#end-created-at').datepicker('setStartDate', $('#begin-created-at').val())
});

let endDatepicker = $('#end-created-at').datepicker({
    language: 'pt-BR',
    autoclose: true,
    showOnFocus: false,
    startDate: inputBegintDate,
    endDate: endDate
})

$( "#end-created-at" ).change(function() {
    //console.log($( "#begin-created-at" ).val())
    //alert( "Handler for .change() called." );
    $('#begin-created-at').datepicker('setEndDate', $('#end-created-at').val())
});

$('#begin-created-at-datepicker-icon').click(function() {
    beginDatepicker.datepicker('show')
})

$('#end-created-at-datepicker-icon').click(function() {
    endDatepicker.datepicker('show')
})

$('#begin-created-at, #end-created-at').on("cut copy paste",function(e) {
    e.preventDefault();
 });

 $('#begin-created-at, #end-created-at').keydown(function(event) {
    if (event.ctrlKey==true && (event.which == '118' || event.which == '86')) {
        event.preventDefault();
     }
});