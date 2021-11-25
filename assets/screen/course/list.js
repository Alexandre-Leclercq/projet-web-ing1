$(() => {
    $('#listCourse').DataTable({
        "ajax": {
            'url': routeGetCourse,
            type: "POST",
            dataSrc: '',
        },
        "columns": [
            { "data": "caption" },
            { "data": "category" },
            { "data": "qtyChapter" },
            { "data": "action" },
        ],
        "columnDefs": [
            {
                "targets": [3],
                "orderable": false,
            }],
        "rowId": "id",
    });

    setInterval(() => { $('#listCourse').DataTable().ajax.reload(); }, 300000);
});


$('#listCourse tbody').on('click', '.activeButton', function(e) {
    if ($(e.target).parents('tr').attr('id') == undefined){
        // responsive case
        var idCourse = $(e.target).parents('tr').prev().attr('id');
    } else {
        // desktop case
        var idCourse = $(e.target).parents('tr').attr('id');
    }
    $.post(routeChangeActive, {id: idCourse}, () => {
        $('#listCourse').DataTable().ajax.reload();
    });
});
     
