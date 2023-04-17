<script>
    $(document).ready(function () {
        flatpickr("#daterange", {mode: "range", dateFormat: "d-m-Y"});
        //new Choices("#status", {removeItemButton: !0});
        bindDatatable();
        $('#searchsubmit').click(function () {
            bindDatatable();
        });


        $('#shipping').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                shippingcompany: {
                    validators: {
                        notEmpty: {
                            message: "Select Shipping Company"
                        }
                    }
                }, awbno: {
                    validators: {
                        notEmpty: {
                            message: "Enter AWB No"
                        }
                    }
                }
            }

        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            updateShipping();
        });
    });


    function bindDatatable(page = 0) {
        if (page != 0) {
            var page = parseInt(page) * 10;
        }
        var name = $("#name").val();
        var mobile = $("#mobile").val();
        var daterange = $("#daterange").val();
        var username = $("#username").val();
        var rderno = $("#rderno").val();
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
                url: '<?= ADMINPATH ?>order-Shipping-data',
                data: function (d) {
                    d.name = name;
                    d.mobile = mobile;
                    d.daterange = daterange;
                    d.username = username;
                    d.rderno = rderno;
                }
            }
        });
    }
    function putTrnId(orderid, orderno) {
        $("#trnid").val(orderid);
        $("#orderno").val(orderno);
    }

    function updateShipping() {
        var trnid = $('#trnid').val();
        var shippingcompany = $('#shippingcompany').val();
        var awbno = $('#awbno').val();
        $.ajax({
            type: "post",
            url: '<?= ADMINPATH ?>update-shipping',
            data: {trnid: trnid, shippingcompany: shippingcompany, awbno: awbno},
            success: function (data)
            {
                $('#preloader').hide();
                var obj = JSON.parse(data);
                if (obj.status == 'success') {
                    $('#trnid').val('');
                    $('#shippingcompany').val('');
                    $('#awbno').val('');
                    Swal.fire('', obj.message, obj.status);
                    $('#updateshipping').modal('toggle');
                    var page = $('#example').DataTable().page.info().page;
                    bindDatatable(page);
                } else {
                    Swal.fire('', obj.message, obj.status);
                }
                $("#shipping").data('formValidation').resetForm();

            }
        }
        );

    }

    function updateShippingDetail(id, status) {
        if (status == 'pac') {
            var message = "Do you want to update the packaging";
        }
        if (status == 'del') {
            var message = "Do you want to update the delivery";
        }
        if (status == 'ret') {
            var message = "Do you want to update the return";
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
                    url: '<?= ADMINPATH ?>update-shipping-status',
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