$(() => {
    $('#listUser').DataTable({
        "ajax": {
            'url': routeGetUser,
            type: "POST",
            dataSrc: '',
        },
        "columns": [
            { "data": "name" },
            { "data": "role" },
            { "data": "dateLog" },
            { "data": "action" },
        ],
        "columnDefs": [
            {
                "targets": [3],
                "orderable": false,
            }],
        "rowId": "id",
    });

    setInterval(() => { $('#listUser').DataTable().ajax.reload(); }, 300000);
});


$('#listUser tbody').on('click', '.activeButton', function(e) {
    if ($(e.target).parents('tr').attr('id') == undefined){
        // responsive case
        var idUser = $(e.target).parents('tr').prev().attr('id');
    } else {
        // desktop case
        var idUser = $(e.target).parents('tr').attr('id');
    }
    $.post(routeChangeActive, {id: idUser}, () => {
        $('#listUser').DataTable().ajax.reload();
    });
});
     
