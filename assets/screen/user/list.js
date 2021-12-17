$(() => {
    $('#listUser').DataTable({
        dom: "<'float-start'l><'float-end'f>tipr"
        ,responsive: true
        ,orderCellsTop: true
        ,fixedHeader: true
        ,"pagingType": "full"
        ,"aaSorting": []
        ,"ajax": {
            'url': routeGetUser,
            type: "POST",
            dataSrc: '',
        }
        ,"columns": [
            { "data": "name" },
            { "data": "role" },
            { "data": "dateLog" },
            { "data": "action" },
        ]
        ,"columnDefs": [
            {
                "targets": [3],
                "orderable": false,
            }]
        ,"rowId": "id"
        ,"language": {
            "emptyTable": "No data to display",
            "infoFiltered": "-  Filtred from _MAX_ lignes",
            "search": "",
            "searchPlaceholder": "Search...",
            "lengthMenu": " _MENU_",
            "infoEmpty": "No data to display",
            "info": "Display page _PAGE_ of _PAGES_",
            "sScrollY":"0px",
            "paginate": {
                "previous": "<",
                "next": ">",
                "first": "<<",
                "last": ">>"
            }
        }
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
     
