 var form = $('#report-form')
var today = new Date()

let datepickerBegin = $('#report-begin').datepicker({
    language: 'pt-BR',
    autoclose: true,
    showOnFocus: false,
    endDate: today,
})

let datepickerEnd = $('#report-end').datepicker({
    language: 'pt-BR',
    autoclose: true,
    showOnFocus: false,
    endDate: today
})

function submitForm() {
    if(datepickerBegin.val() && datepickerEnd.val()) {
        form.submit()
    }
}

$('#report-begin-datepicker-icon').click(function() {
    datepickerBegin.datepicker('show')
})

$('#report-end-datepicker-icon').click(function() {
    datepickerEnd.datepicker('show')
})

datepickerBegin.on('changeDate', function(e){
    datepickerEnd.datepicker('setStartDate', datepickerBegin.datepicker('getDate'))
    submitForm()
})

datepickerEnd.on('changeDate', function(e){
    datepickerBegin.datepicker('setEndDate', datepickerEnd.datepicker('getDate'))
    submitForm()
})

if(datepickerBegin.val()) {
    datepickerEnd.datepicker('setStartDate', datepickerBegin.datepicker('getDate'))
}

if(datepickerEnd.val()) {
    datepickerBegin.datepicker('setEndDate', datepickerEnd.datepicker('getDate'))
}

$('#btn-print').click(function(){
    window.print()
})