<script>
    $(document).ready(function () {
        bindDatatable();
        $('#searchsubmit').click(function () {
            bindDatatable();
        });
        $('#addnew').click(function () {
            window.location.href = "<?= ADMINPATH ?>subcategory-add";
        });
        $('#download').click(function () {
            var categoryname = $("#categoryname").val();
            var segmentname = $("#segmentname").val();
            var subcategoryname = $("#subcategoryname").val();
            window.open("<?= ADMINPATH ?>download-subcategory-data?categoryname=" + categoryname + "&segmentname=" + segmentname + "&subcategoryname=" + subcategoryname, "_blank");
        });

    });


    function bindDatatable() {
        var categoryname = $("#categoryname").val();
        var segmentname = $("#segmentname").val();
        var subcategoryname = $("#subcategoryname").val();
        $('#example').DataTable().destroy();
        $('#example').DataTable({
            responsive: true,
            searching: false,
            processing: true,
            ordering: true,
            bLengthChange: false,
            serverSide: true,
            pageLength: 10,
            order: [[0, 'desc']],
            ajax: {
                method: "POST",
                url: '<?= ADMINPATH ?>subcategory-data',
                data: function (d) {
                    d.cname = categoryname;
                    d.sname = segmentname;
                    d.scname = subcategoryname;
                }
            }
        });
    }

    function updateSubcategoryStatus(id, status) {
        if (status == 1) {
            var message = "Do you want to activate this sub category!";
        }
        if (status == 2) {
            var message = "Do you want to block this sub category!";
        }
        Swal.fire({
            title: "Are you sure?",
            text: message,
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#2ab57d",
            cancelButtonColor: "#fd625e",
            confirmButtonText: "Yes, do it!"
        }).then(function (e) {
            if (e.isConfirmed == true) {
                $.ajax({
                    type: "POST",
                    url: '<?= ADMINPATH ?>update-segcatsubcat-status',
                    data: {enctableid: id, status: status, type: 3},
                    success: function (data) {
                        var jsonData = JSON.parse(data);
                        if (jsonData.status == 'success') {
                            var page = $('#example').DataTable().page.info().page;
                            bindDatatable(page);
                            Swal.fire("Updated!", jsonData.message, jsonData.status);
                        } else {
                            Swal.fire("Updated!", jsonData.message, jsonData.status);
                        }

                    }
                });
            }

        });
    }
</script>