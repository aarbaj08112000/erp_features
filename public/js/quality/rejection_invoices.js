$(document).ready(function() {
    page.init();
});

var table = '';
var file_name = "rejection_invoices";
var pdf_title = "rejection_invoices";

const page = {
    init: function() {
        this.dataTable();
    },
    dataTable: function() {
        table = $('#rejection_invoices').DataTable();
    }
};
