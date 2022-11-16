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
                    $(this).removeClass("btn-secondary");
                    $(this).attr('id', "add-new-item");
                    $(".add-new-data").addClass("show");
                    $(".overlay-bg").addClass("show");
                    $("#").val(0);
                    $("#donor-name,#donor-initial,#donor-address,#donor-icon,#donor-notes").val("");
                },
                className: "btn-outline-primary btn-pill boxed-shadow",

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

    //Closing the sidebar
    $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on("click", function () {
        $(".add-new-data").removeClass("show")
        $(".overlay-bg").removeClass("show")
        $("#data-name, #data-price").val("")
        $("#data-category, #data-status").prop("selectedIndex", 0)
    })

    $('.add-data-btn').on('click', function () {
        var title_len = $('#title').val().trim().length;
        event.preventDefault();
        if (title_len == 0) {
            toastr.error('Error!', 'Title is missing');

            return;
        }

        else {

            var title = $('#title').val();
            var photo = $('#thumbnail').val();
            var description = $('#description').val();
            var token = $('#token').val();
            $.ajax({
                url: "/admin/brands/add",
                type: "POST",
                data: {
                    title: title,
                    _token: token,
                    description: description,
                    photo: photo,
                },
                success: function (result) {
                    toastr.success('Success', result.message);
                    window.location.href = "/admin/brands";
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                },
                complete: function () {
                    $.unblockUI();
                },
            })
        }


    });

})

function updateBrand(brand) {
    console.log(brand);

    $("#title").val(brand.title);
    $("#description").val(brand.description);
    $("#thumbnail").val(brand.photo);
    $('#brand-id').val(brand.id);

    const btn = document.getElementById("btn-save");
    btn.innerText = "Update";


    $(".add-new-data").addClass("show");
    $(".overlay-bg").addClass("show");
    $("#donor-idnt").val(0);
}
