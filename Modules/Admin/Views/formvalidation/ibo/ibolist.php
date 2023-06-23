<script>
    $(document).ready(function () {
        flatpickr("#daterange", {mode: "range", dateFormat: "d-m-Y"});
        //new Choices("#status", {removeItemButton: !0});
        bindDatatable();
        $('#searchsubmit').click(function () {
            bindDatatable();
        });
        $('#addnew').click(function () {
            window.location.href = "<?= ADMINPATH ?>ibo-add";
        });

        $('#changesponsor').formValidation({
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
            changeSponsor();
        });
    });

    function putMemberId(userid) {
        $('#userid').val(userid);
    }
    function changeSponsor() {
        var sponsorid = $('#hiddenmemberid').val();
        var userid = $('#userid').val();
        $.ajax({
            type: "post",
            url: '<?= ADMINPATH ?>update-sponsor',
            data: {sponsorid: sponsorid, userid: userid},
            success: function (data)
            {
                $('#preloader').hide();
                $('#hiddenmemberid').val('');
                $('#userid').val('');
                $('#memberid').val('');
                $('#membername').val('');
                var obj = JSON.parse(data);
                if (obj.status == 'success') {
                    Swal.fire('', obj.message, obj.status);
                    $('#changesponsorforuser').modal('toggle');
                    var page = $('#example').DataTable().page.info().page;
                    bindDatatable(page);
                } else {
                    Swal.fire('', obj.message, obj.status);
                }
                $("#changesponsor").data('formValidation').resetForm();

            }
        }
        );

    }
    function bindDatatable(page = 0) {
        if (page != 0) {
            var page = parseInt(page) * 10;
        }
        var name = $("#name").val();
        //var mobile = $("#mobile").val();
        var mobile = '';
        var daterange = $("#daterange").val();
        var username = $("#username").val();
        var moduleid = $("#moduleid").val();
        $('#userlist').DataTable().destroy();
        $('#userlist').DataTable({
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
                url: '<?= ADMINPATH ?>ibo-data',
                data: function (d) {
                    d.name = name;
                    d.mobile = mobile;
                    d.daterange = daterange;
                    d.username = username;
                    d.moduleid = moduleid;
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
    
    function deleteUser(id) {
        
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to delete this Member!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#2ab57d",
            cancelButtonColor: "#fd625e",
            confirmButtonText: "Yes, do it!"
        }).then(function (e) {
            if (e.isConfirmed == true) {
                $.ajax({
                    type: "POST",
                    url: '<?= ADMINPATH ?>delete-ibo-user',
                    data: {encuser: id},
                    success: function (data) {
                        var jsonData = JSON.parse(data);
                        if (jsonData.status == 'success') {
                            var page = $('#userlist').DataTable().page.info().page;
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