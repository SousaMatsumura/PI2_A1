var menusCard = $('#menus-card .bg-white')
var noResults = $('#no-results')
var noResultsDay = $('#no-results-day')
var today = new Date()

let datepicker = $('#menu-created-at').datepicker({
    language: 'pt-BR',
    autoclose: true,
    showOnFocus: false,
    endDate: today,
})

datepicker.val(today.toLocaleDateString('pt-BR', {timeZone: 'America/Sao_Paulo'}))

$('#menu-created-at-datepicker-icon').click(function() {
    datepicker.datepicker('show')
})

function addLeftZero(input) {
    
    input = input ? parseInt(input) : 0

    if(input <= 9 && input.toString().length < 2) return `0${input.toString()}`

    return input
}

datepicker.on('changeDate', fetchMenus)

function fetchMenus() {
    menusCard.hide()
    noResults.hide()

    $('[id^="mealtime-"]').text('')

    $.ajax({
        url: datepicker.data('url'),
        data: {
            menu: {
                created_at: datepicker.val()
            }
        },
        success:function(response){
            
            if(response.length > 0) {
                
                response.forEach(function(menu){
                    $(`#mealtime-${menu.mealtime}-description`).text(menu.description)
                    $(`#mealtime-${menu.mealtime}-amount`).text(addLeftZero(menu.amount))
                    $(`#mealtime-${menu.mealtime}-repeat`).text(addLeftZero(menu.repeat))
                })
                
                $('#menus-card .row:not(:first-child)').addClass('mt-3')
                menusCard.fadeIn()

            } else {
                $('#menus-card .row:not(:first-child)').removeClass('mt-3')
                noResultsDay.text(datepicker.val())
                noResults.fadeIn()
                

            }

        },
        error:function(error){
            // console.log(error)
        }
    })
}

if(datepicker.val()) fetchMenus()