<script>
    $(document).ready(function () {
        flatpickr("#daterange", {mode: "range", dateFormat: "d-m-Y"});
        bindDatatable();
        $('#searchsubmit').click(function () {
            bindDatatable();
        });
        $('#addmember').formValidation({
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
            addMemberToList();
        });

    });
    

    function updateStatus(id, status) {
        var table= $('#table').val();
        if (status == 2) {
            var message = "Do you want to Remove this user from the list!";
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
                    url: '<?= ADMINPATH ?>update-teams-status',
                    data: {tableid: id, status: status, table: table},
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
                        $('#addmember').formValidation("revalidateField", "hiddenmemberid");
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

    function addMemberToList() {

        var userid = $('#hiddenmemberid').val();
        var table = $('#table').val();

        $.ajax({
            type: "post",
            url: '<?= ADMINPATH ?>add-member-to-table',
            data: {userid: userid, table: table},
            success: function (data)
            {
                $('#preloader').hide();
                $('#hiddenmemberid').val('');
                var obj = JSON.parse(data);
                if (obj.status == 'success') {
                    Swal.fire('', obj.message, obj.status);
                    $('#adduser').modal('toggle');
                    $("#addmember").data('formValidation').resetForm();
                    var page = $('#example').DataTable().page.info().page;
                    bindDatatable(page);
                } else {
                    Swal.fire('', obj.message, obj.status);
                }


            }
        }
        );

    }
</script>