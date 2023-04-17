<script type="text/javascript">
    flatpickr("#datepicker-range", {mode: "range", dateFormat: "d-m-Y"});
    $("#search").click(function () {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ms-2 mt-2",
            buttonsStyling: !1,
        }).then(function (e) {
            e.value
                    ? Swal.fire({title: "Deleted!", text: "Your file has been deleted.", icon: "success", confirmButtonColor: "#5156be"})
                    : e.dismiss === Swal.DismissReason.cancel && Swal.fire({title: "Cancelled", text: "Your imaginary file is safe :)", icon: "error", confirmButtonColor: "#5156be"});
        });
    });
    $("#search").click(function () {
        alertify.prompt(
                "This is a prompt dialog.",
                "Default value",
                function (e, t) {
                    alertify.success("Ok: " + t);
                },
                function () {
                    alertify.error("Cancel");
                }
        );
    });

    $(document).ready(function () {
        $("#datatable").DataTable();
        new Choices("#choices-multiple-remove-button", { removeItemButton: !0 });
    });


</script>