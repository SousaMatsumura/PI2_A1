$('#inventory-table').DataTable({
    ajax: location.href,
    bLengthChange: false,
    processing: true,
    serverSide: true,
    columns: [
        { data: 'food_id', name: 'foods.id' },
        { data: 'food_name', name: 'foods.name' },
        { data: 'food_unit', name: 'foods.unit', className: 'text-center' },
        { data: 'amount_remaining', className: 'text-center', searchable: false }
    ]
})