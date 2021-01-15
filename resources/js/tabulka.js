var dataTable;

$(document).ready(function(){   
    loadDataTable();
});

function loadDataTable() {
    dataTable = $('#DT_load').DataTable({
        "ajax": {
            "url" : "./views/users/users",
            "type" : "GET",
            "datatype" : "json"
        },
        "columns":[
            {"data": "id", "width": "20%"},
            {"data": "name", "width": "20%"},
            {"data": "email", "width": "20%"},
            {
                "data" : "id",
                "render" : function(data){
                    return `<div class="text-center">
                    
                    `
                }, "width":"20%"
            }
        ],
        "language":{
            "emptyTable" : "no data found"
        },
        "width":"70%"
    })
}