$('#inventory-table').DataTable({
    ajax: location.href,
    bLengthChange: false,
    processing: true,
    serverSide: true,
    columns: [
        { data: 'id', name: 'id' },
        { data: 'food.name' },
        { data: 'food.unit', className: 'text-center' },
        { data: 'quantity', className: 'text-center' }
    ]
})