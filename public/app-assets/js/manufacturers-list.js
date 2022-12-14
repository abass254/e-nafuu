jq(document).ready(function() {
    tbl = $("#queue-table").DataTable({
        responsive: true,
        "order": [[ 3, "asc" ]],
        'columnDefs': [{
            "orderable": false,
            "targets": [0],
            "visible": false
        }, {
            className: "text-center",
            "orderable": false,
            "targets": [1],
        }, {
            className: "dt-nowrap",
            "targets": [2]
        }, {
            className: "dt-nowrap",
            "targets": [3]
        }, {
            className: "text-center",
            "orderable": false,
            "targets": [4]
        }, {
            className: "dt-nowrap",
            "targets": [7]
        }],
        "displayLength": 25,
        "language": {
            "emptyTable": "No Manufacturers Found",
            "zeroRecords": "No Manufacturers matched the criteria"
        }
    });

    jq('#search-form select').change(function(){
        jq('#queue-filter').keyup();
    });

    jq('#queue-filter').keyup(function(){
        var roles = (jq('select.roles').val() == "" ? "" : jq('select.roles :selected').text().trim());
        var stats = (jq('select.stats').val() == "" ? "" : jq('select.stats :selected').text().trim());
        var depts = (jq('select.depts').val() == "" ? "" : jq('select.depts :selected').text().trim());

        jq('div.dataTables_filter input').val(jq(this).val() + " " + roles + " " + stats + " " + depts);
        jq('div.dataTables_filter input').keyup();
    });

    jq('#queue-table').on('click', 'a.redirect-link', function(){
        toastr.info('This Action is currently disabled.', 'Action disabled');
    });

    jq('#queue-table').on('click', 'a.inline-filter-text', function(){
        jq('#queue-filter').val(jq(this).html().trim()).keyup();
    });

    jq('#btn-add-customer').click(function(){
        toastr.info('This Action is currently disabled.', 'Action disabled');
    });

    jq('.btn-add-man').click(function(){
        $('.new-user-modal').modal('show');
    });
});

$(document).ready(function(){
    $('#btn-add-customer').click(function(){
        $('#add-customer').modal('show');
    });
});
