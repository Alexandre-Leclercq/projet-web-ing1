$(() => {
    $('#listChapter').DataTable({
        "ajax": {
            'url': routeGetChapter,
            type: "POST",
            dataSrc: '',
        },
        "columns": [
            { "data": "caption" },
            { "data": "number" },
            { "data": "action" },
        ],
        "columnDefs": [
            {
                "targets": [2],
                "orderable": false,
            }],
        "rowId": "id",
    });

    setInterval(() => { $('#listChapter').DataTable().ajax.reload(); }, 300000);
});


$('#listChapter tbody').on('click', '.activeButton', function(e) {
    if ($(e.target).parents('tr').attr('id') == undefined){
        // responsive case
        var idCourse = $(e.target).parents('tr').prev().attr('id');
    } else {
        // desktop case
        var idCourse = $(e.target).parents('tr').attr('id');
    }
    $.post('', {id: idCourse}, () => {
        $('#listChapter').DataTable().ajax.reload();
    });
});
     
