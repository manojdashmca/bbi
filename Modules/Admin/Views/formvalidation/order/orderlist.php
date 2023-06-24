<script>
    $(document).ready(function () {
        flatpickr("#daterange", {mode: "range", dateFormat: "d-m-Y"});
        //new Choices("#status", {removeItemButton: !0});
        GLightbox({selector: ".image-popup", title: !1});
        bindDatatable();
        $('#searchsubmit').click(function () {
            bindDatatable();
        });
        $('#download').click(function () {
            var name = $("#name").val();
            var mobile = '';
            var moduleid = $("#moduleid").val();
            var status = $("#pstatus").val();
            var daterange = $("#daterange").val();
            var username = $("#username").val();
            window.open("<?=ADMINPATH?>download-order-data?name="+name+"&mobile="+mobile+"&moduleid="+moduleid+"&status="+status+"&daterange="+daterange+"&username="+username, "_blank");
        });

    });


    function bindDatatable(page = 0) {
        if (page != 0) {
            var page = parseInt(page) * 10;
        }
        var name = $("#name").val();
        var mobile = '';
        var moduleid = $("#moduleid").val();
        var status = $("#pstatus").val();
        var daterange = $("#daterange").val();
        var username = $("#username").val();
        //var rderno = $("#rderno").val();
        $('#example').DataTable().destroy();
        $('#example').DataTable({
            responsive: true,
            searching: false,
            processing: true,
            ordering: true,
            bLengthChange: false,
            serverSide: true,
            displayStart: page,
            pageLength: 10,
            order: [[0, 'desc']],
            ajax: {
                method: "POST",
                url: '<?= ADMINPATH ?>payment-data',
                data: function (d) {
                    d.name = name;
                    d.mobile = mobile;
                    d.daterange = daterange;
                    d.username = username;
                    d.moduleid = moduleid;
                    d.status = status;
                }
            }
        });
    }

    function updateTrnStatus(id, status) {
        if (status == 2) {
            var message = "Do you want to approve this payment";
        }
        if (status == 3) {
            var message = "Do you want to reject this payment";
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
                    url: '<?= ADMINPATH ?>update-payment-status',
                    data: {encorderid: id, status: status},
                    success: function (data) {
                        var jsonData = JSON.parse(data);
                        if (jsonData.status == 'success') {
                            var page = $('#example').DataTable().page.info().page;
                            bindDatatable(page);
                            Swal.fire("Updated!", jsonData.message, jsonData.status);
                        } else {
                            Swal.fire("Error!", jsonData.message, jsonData.status);
                        }

                    }
                });
            }

        });
    }


</script>