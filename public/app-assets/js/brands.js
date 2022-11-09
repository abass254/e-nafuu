$('document').ready(function () {
    //Display the list of brands using DataTables
    var dataListView = $('.data-list-view').DataTable({
        responsive: false,
        columnDefs: [
            {
                orderable: true,
                targets: 0,
                checkboxes: { selectRow: false }
            }
        ],
        oLanguage: {
            sLengthMenu: "_MENU_",
            sSearch: ""
        },
        dom:
            '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"action">p>',
        aLengthMenu: [[10, 15, 20, 100], [10, 15, 20, 100]],
        order: [[1, "asc"]],
        bInfo: false,
        pageLength: 10,
        buttons: [
            {
                text: "<i class='feather icon-plus'></i> Add Brand",
                action: function () {
                    //Display add-brand modal when button is clicked
                },
                className: "btn-outline-primary boxed-shadow",

            }
        ],
        initComplete: function (settings, json) {
            $(".dt-buttons .btn").removeClass("btn-secondary")
        }
    });
    dataListView.on('draw.dt', function () {
        setTimeout(function () {
            if (navigator.userAgent.indexOf("Mac OS X") != -1) {
                $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
            }
        }, 50);
    });
})
