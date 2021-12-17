$(() => {
    $('#listCourse').DataTable({ 
        dom: "<'float-start'l><'float-end'f>tipr"
        ,responsive: true
        ,orderCellsTop: true
        ,fixedHeader: true
        ,"pagingType": "full"
        ,"aaSorting": []
        ,"ajax": {
            'url': routeGetCourse,
            type: "POST",
            dataSrc: '',
        }
        ,"columns": [
            { "data": "caption" },
            { "data": "category" },
            { "data": "qtyChapter" },
            { "data": "action" },
        ]
        ,"columnDefs": [
            {
                "targets": [3],
                "orderable": false,
            }
        ]
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
     
