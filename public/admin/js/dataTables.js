$(document).ready( function () {
    $('#myTable').DataTable({
        "language": {
            "info": "Приказује се _PAGE_ од _PAGES_ страница/е",
            "emptyTable": "Нема података у табели",
            "aria": {
              "sortAscending": " - кликни/повратак на узлазно сортирање",
              "sortDescending": " - кликни/повратак на силазно сортирање"
            },
            "paginate": {
              "first": '<i class="fas fa-chevron-double-left"></i>',
              "last": '<i class="fas fa-chevron-double-right"></i>',
              "next": '<i class="fas fa-chevron-right"></i>',
              "previous": '<i class="fas fa-chevron-left"></i>'
            },
            "infoEmpty": "Нема података за приказ",
            "infoFiltered": " - Филтрирање из _MAX_ записа",
            "lengthMenu": 'Прикажи <select>'+
                          '<option value="5">5</option>'+
                          '<option value="10">10</option>'+
                          '<option value="20">20</option>'+
                          '<option value="30">30</option>'+
                          '<option value="40">40</option>'+
                          '<option value="50">50</option>'+
                          '</select> записа',
            "sSearch": "Претрага:",
            "sZeroRecords": "Није пронађен ни један одговарајући запис"
        }
    });
} );