$(() => {
    $('#listCourse').DataTable({
        dom: "lftiprBRSP",
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true,
        'ajax': {
            'url': route,
            type: "POST",
            dataSrc: '',
        },
        "pagingType": "full",
        "aaSorting": [],
        "lengthMenu": [[10, 25, 50, -1], ["Display 10 lines", "Display 25 lines", "Display 50 lines", "Display all"]],
        buttons: [
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
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
        "language": {
            "emptyTable": "No data to display",
            "infoFiltered": "-  Filtered from _MAX_ lignes",
            "search": "",
            "searchPlaceholder": "Search...",
            "lengthMenu": " _MENU_",
            "infoEmpty": "No data to display",
            "info": "Display page _PAGE_ on _PAGES_",
            "sScrollY": "0px",
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