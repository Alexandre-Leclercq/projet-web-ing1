$(() => {
    $('#listChapter').DataTable({
        "ajax": {
            'url': routeGetChapter,
            type: "POST",
            dataSrc: '',
        },
        "columns": [
            { "data": "caption" },
            { "data": "step" },
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
    console.log("test");
    if ($(e.target).parents('tr').attr('id') == undefined){
        // responsive case
        var idChapter = $(e.target).parents('tr').prev().attr('id');
    } else {
        // desktop case
        var idChapter = $(e.target).parents('tr').attr('id');
    }
    $.post(routeChangeActive, {id: idChapter}, () => {
        $('#listChapter').DataTable().ajax.reload();
    });
});

     
