$('#inventory-table').DataTable({
    ajax: location.href,
    bLengthChange: false,
    processing: true,
    serverSide: true,
    columns: [
        { data: 'id', name: 'id' },
        { data: 'food' },
        { data: 'unit', className: 'text-center' },
        { data: 'amount', className: 'text-center' }
    ]
})