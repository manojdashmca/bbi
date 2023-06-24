<script>
    $(document).ready(function () {
        flatpickr("#daterange", {mode: "range", dateFormat: "d-m-Y"});
        bindDatatable();
        $('#searchsubmit').click(function () {
            bindDatatable();
        });
        $('#addnew').click(function () {
            window.location.href = "<?= ADMINPATH ?>module-add";
        });
        $('#download').click(function () {
            var name = $("#name").val();
            var code = $("#code").val();
            var daterange = $("#daterange").val();
            window.open("<?= ADMINPATH ?>download-module-data?name=" + name + "&code=" + code + "&daterange=" + daterange, "_blank");
        });
        $('#changedirectorid').formValidation({
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
                }
            }

        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            changePositionUser('d');
        });
        $('#changeassociateid').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                asmemberid: {
                    validators: {
                        notEmpty: {
                            message: "Member Id Required"
                        }
                    }
                }, ashiddenmemberid: {
                    excluded: false,
                    validators: {
                        notEmpty: {
                            message: "Click on search button to get member name"
                        }
                    }
                }
            }

        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            changePositionUser('as');
        });
        $('#changeassistantid').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                astmemberid: {
                    validators: {
                        notEmpty: {
                            message: "Member Id Required"
                        }
                    }
                }, asthiddenmemberid: {
                    excluded: false,
                    validators: {
                        notEmpty: {
                            message: "Click on search button to get member name"
                        }
                    }
                }
            }

        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            changePositionUser('ast');
        });
    });

    function putModuleId(moduleid) {
        $('#dmoduleid').val(moduleid);
        $('#asmoduleid').val(moduleid);
        $('#astmoduleid').val(moduleid);
    }
    function changePositionUser(type) {
        if (type == 'd') {
            var userid = $('#hiddenmemberid').val();
            var lmid = $('#dmoduleid').val();
        }
        if (type == 'as') {
            var userid = $('#ashiddenmemberid').val();
            var lmid = $('#asmoduleid').val();
        }
        if (type == 'ast') {
            var userid = $('#asthiddenmemberid').val();
            var lmid = $('#astmoduleid').val();
        }
        $.ajax({
            type: "post",
            url: '<?= ADMINPATH ?>update-module-director',
            data: {userid: userid, lmid: lmid, type: type},
            success: function (data)
            {
                $('#preloader').hide();
                $('#hiddenmemberid').val('');
                $('#ashiddenmemberid').val('');
                $('#asthiddenmemberid').val('');
                $('#moduleid').val();
                $('#asmoduleid').val();
                $('#astmoduleid').val();
                $('#memberid').val('');
                $('#membername').val('');
                $('#asmemberid').val('');
                $('#asmembername').val('');
                $('#astmemberid').val('');
                $('#astmembername').val('');
                var obj = JSON.parse(data);
                if (obj.status == 'success') {
                    Swal.fire('', obj.message, obj.status);
                    if (type == 'd') {
                        $('#changedirector').modal('toggle');
                        $("#changedirectorid").data('formValidation').resetForm();
                    }
                    if (type == 'as') {
                        $('#changeassociate').modal('toggle');
                        $("#changeassociateid").data('formValidation').resetForm();
                    }
                    if (type == 'ast') {
                        $('#changeassistant').modal('toggle');
                        $("#changeassistantid").data('formValidation').resetForm();
                    }
                    var page = $('#example').DataTable().page.info().page;
                    bindDatatable(page);
                } else {
                    Swal.fire('', obj.message, obj.status);
                }


            }
        }
        );

    }

    function CheckMember(type) {
        $('#hiddenmemberid').val('');
        $('#ashiddenmemberid').val('');
        $('#asthiddenmemberid').val('');
        if (type == 'd') {
            var memberid = $('#memberid').val();
        }
        if (type == 'as') {
            var memberid = $('#asmemberid').val();
        }
        if (type == 'ast') {
            var memberid = $('#astmemberid').val();
        }
        if (memberid != '') {
            $.ajax({
                type: "get",
                url: '<?= ADMINPATH ?>get-member-by-id/' + memberid,
                success: function (data)
                {
                    $('#preloader').hide();
                    var obj = JSON.parse(data);
                    if (type == 'd') {
                        if (obj.id_user != 0) {
                            $('#hiddenmemberid').val(obj.data.id_user);
                            $('#membername').val(obj.data.user_name);
                            $('#changedirectorid').formValidation("revalidateField", "hiddenmemberid");
                            Swal.fire('', obj.message, obj.status);
                        } else {
                            $('#hiddenmemberid').val('');
                            Swal.fire('', obj.message, obj.status);
                        }
                    }
                    if (type == 'as') {
                        if (obj.id_user != 0) {
                            $('#ashiddenmemberid').val(obj.data.id_user);
                            $('#asmembername').val(obj.data.user_name);
                            $('#changeassociateid').formValidation("revalidateField", "ashiddenmemberid");
                            Swal.fire('', obj.message, obj.status);
                        } else {
                            $('#ashiddenmemberid').val('');
                            Swal.fire('', obj.message, obj.status);
                        }
                    }
                    if (type == 'ast') {
                        if (obj.id_user != 0) {
                            $('#asthiddenmemberid').val(obj.data.id_user);
                            $('#astmembername').val(obj.data.user_name);
                            $('#changeassistantid').formValidation("revalidateField", "asthiddenmemberid");
                            Swal.fire('', obj.message, obj.status);
                        } else {
                            $('#asthiddenmemberid').val('');
                            Swal.fire('', obj.message, obj.status);
                        }
                    }

                }
            });
        } else {
            Swal.fire('', 'Enter a member id and click on get detail to get the detail!', 'error');
        }
    }

    function bindDatatable() {
        var name = $("#name").val();
        var code = $("#code").val();
        var daterange = $("#daterange").val();
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
                url: '<?= ADMINPATH ?>module-data',
                data: function (d) {
                    d.name = name;
                    d.code = code;
                    d.daterange = daterange;
                }
            }
        });
    }

    function updateStatus(id, status) {
        if (status == 1) {
            var message = "Do you want to activate this module!";
        }
        if (status == 2) {
            var message = "Do you want to block this module!";
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
                    url: '<?= ADMINPATH ?>update-module-status',
                    data: {encmoduleid: id, status: status},
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