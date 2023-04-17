<script>
    $(document).ready(function () {
        flatpickr("#daterange", {mode: "range", dateFormat: "d-m-Y"});
        //new Choices("#status", {removeItemButton: !0});
        bindDatatable();
        $('#searchsubmit').click(function () {
            bindDatatable();
        });

        $('#adddata').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                memberid: {
                    validators: {
                        notEmpty: {
                            message: "Member Id Required"
                        }
                    }
                }, hiddenmemberid: {
                    excluded: false,
                    validators: {
                        notEmpty: {
                            message: "Click on search button to get member name"
                        }
                    }
                }, position: {
                    validators: {
                        notEmpty: {
                            message: "Select BP Position"
                        }
                    }
                }, amount: {
                    validators: {
                        notEmpty: {
                            message: "Enter BP amount"
                        }
                    }
                }, remark: {
                    validators: {
                        notEmpty: {
                            message: "Enter Remark"
                        }
                    }
                }
            }

        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            saveTransaction();
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
        var pan = $("#pan").val();
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
                url: '<?= ADMINPATH ?>ibo-virtual-bp-data',
                data: function (d) {
                    d.name = name;
                    d.mobile = mobile;
                    d.daterange = daterange;
                    d.username = username;
                    d.pan = pan;
                }
            }
        });
    }

    function CheckMember() {
        $('#hiddenmemberid').val('');
        var memberid = $('#memberid').val();
        if (memberid != '') {
            $.ajax({
                type: "get",
                url: '<?= ADMINPATH ?>get-member-by-id/' + memberid,
                success: function (data)
                {
                    $('#preloader').hide();
                    var obj = JSON.parse(data);
                    if (obj.id_user != 0) {
                        $('#hiddenmemberid').val(obj.data.id_user);
                        $('#membername').val(obj.data.user_name);
                        $('#adddata').formValidation("revalidateField", "hiddenmemberid");
                        Swal.fire('', obj.message, obj.status);
                    } else {
                        $('#hiddenmemberid').val('');
                        Swal.fire('', obj.message, obj.status);
                    }

                }
            });
        } else {
            Swal.fire('', 'Enter a member id and click on get detail to get the detail!', 'error');
        }
    }

    function saveTransaction() {
        var memberid = $('#hiddenmemberid').val();
        var remark = $('#remark').val();
        var amount = $('#amount').val();
        var position = $('#position').val();
        var utr = $('#utr').val();
        $.ajax({
            type: "post",
            url: '<?= ADMINPATH ?>add-virtualbp-transaction',
            data: {utr: utr, userid: memberid, remark: remark, amount: amount, position: position},
            success: function (data)
            {
                $('#preloader').hide();
                var obj = JSON.parse(data);
                if (obj.status == 'success') {
                    $('#hiddenmemberid').val('');
                    $('#remark').val('');
                    $('#position').val('');
                    $('#amount').val('');
                    $('#memberid').val('');
                    $('#membername').val('');
                    Swal.fire('', obj.message, obj.status);
                    $('#addTransaction').modal('toggle');
                    var page = $('#example').DataTable().page.info().page;
                    bindDatatable(page);
                    $('#utr').val(Math.floor((Math.random() * 100000000000000)));
                } else {

                    Swal.fire('', obj.message, obj.status);
                }
                $("#adddata").data('formValidation').resetForm();

            }
        }
        );

    }

    function cancelVBPTrn(vbptrnid) {

        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to cancell this VBP transaction",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#2ab57d",
            cancelButtonColor: "#fd625e",
            confirmButtonText: "Yes, do it!"
        }).then(function (e) {
            if (e.isConfirmed == true) {
                $.ajax({
                    type: "POST",
                    url: '<?= ADMINPATH ?>cancel-vbp-transaction',
                    data: {enctrn: vbptrnid},
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