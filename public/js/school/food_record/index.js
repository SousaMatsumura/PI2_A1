function addLeftZero(input) {
    
    input = input ? parseInt(input) : 0

    if(input <= 9 && input.toString().length < 2) return `0${input.toString()}`

    return input
}

$('.food-amount-remaining').each(function(){
    let value = $(this).text()

    $(this).text(addLeftZero(value))
})