$(document).ready(function() {
    page.init();
});

var table = '';
var file_name = "final_inspection";
var pdf_title = "final_inspection";

const page = {
    init: function() {
        this.dataTable();
    },
    dataTable: function() {
        table = $('#final_inspection').DataTable();
    }
};
