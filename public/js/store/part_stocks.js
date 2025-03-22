$(document).ready(function() {
    page.init();
});

var table = '';
var file_name = "part_stocks_list";
var pdf_title = "Part Stock List";

const page = {
    init: function() {
        this.dataTable();
    },
    dataTable: function() {
        table = $('#part_stocks').DataTable();
    }
};
