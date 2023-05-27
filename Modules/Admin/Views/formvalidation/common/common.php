<script type="text/javascript">
    function updateStatus(id, status) {
        if (status == 1) {
            var message = "Do you want to activate this user!";
        }
        if (status == 2) {
            var message = "Do you want to block this user!";
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
                    url: '<?= ADMINPATH ?>update-user-status',
                    data: {encuser: id, status: status},
                    success: function (data) {
                        var jsonData = JSON.parse(data);
                        if (jsonData.status == 'success') {
                            var page = $('#userlist').DataTable().page.info().page;
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

    function getAddress(office = '') {
        var pincode = $("#pincode").val();
        $.ajax({
            type: "GET",
            url: '<?= ADMINPATH ?>addressByPincode/' + pincode,
            success: function (data) {
                var jsonData = JSON.parse(data);
                var listItems = "<option value=''>Select Post Office</option>";
                if (jsonData.length > 0) {
                    $("#state").val(jsonData[0].state_name);
                    $("#district").val(jsonData[0].district_name);
                    $("#country").val('India');
                    for (var i = 0; i < jsonData.length; i++) {
                        if (jsonData[i].office_name == office) {
                            listItems += "<option value='" + jsonData[i].office_name + "' selected='selected'>" + jsonData[i].office_name + "</option>";
                        } else {
                            listItems += "<option value='" + jsonData[i].office_name + "'>" + jsonData[i].office_name + "</option>";
                        }
                    }

                    $('#useradd').formValidation("revalidateField", "state");
                    $('#useradd').formValidation("revalidateField", "district");
                    $('#useradd').formValidation("revalidateField", "country");
                } else {
                    $("#state").val('');
                    $("#district").val('');
                    $("#country").val('');
                }
                $("#postoffice").html(listItems);
            }
        });
    }

    function getBankDetail() {
        var ifsc = $("#bankifsc").val();
        $.ajax({
            type: "GET",
            url: '<?= ADMINPATH ?>getBankDetailByIfsc/' + ifsc,
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.length > 0) {
                    $("#bankname").val(jsonData[0].bank_name);
                    $("#bankbranch").val(jsonData[0].bank_branch_name);
                    $('#useradd').formValidation("revalidateField", "bankname");
                    $('#useradd').formValidation("revalidateField", "bankbranch");
                } else {
                    $("#bankname").val('');
                    $("#bankbranch").val('');
                }
            }
        });
    }

    function updateKycDetail() {
        let data = new FormData($("#kycdetail")[0]);
        $.ajax({
            method: "POST",
            cache: false,
            contentType: false,
            processData: false,
            url: '<?= ADMINPATH ?>update-kyc-detail',
            //data: {date: date, description: description, file: files},
            data: data,
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.status == 'success') {
                    alertify.success(jsonData.message);
                    location.reload();
                } else {
                    alertify.error(jsonData.message);
                    $("#kycdetail").data('formValidation').resetForm();
                }
            }
        });
    }


    function updatePersonalDetail() {
        var title = $('input[name=title]:checked').val();
        var name = $("#name").val();
        var fatherhusband = $("#fatherhusband").val();
        var dob = $("#dob").val();
        var gender = $('input[name=gender]:checked').val();
        var glink = $('input[name=glink]:checked').val();
        var encuser = $("#pinfoencuserid").val();
        var maritalstatus = $('input[name=maritalstatus]:checked').val();
        var eduqual = $("#eduqual").val();
        var profcert = $("#profcert").val();
        var bloodgroup = $("#bloodgroup").val();
        var nameofgroup = $("#nameofgroup").val();
        
        $.ajax({
            type: "POST",
            url: '<?= ADMINPATH ?>update-personal-detail',
            data: {glink:glink,eduqual:eduqual,profcert:profcert,bloodgroup:bloodgroup,nameofgroup:nameofgroup,title: title, name: name, fatherhusband: fatherhusband, dob: dob, gender: gender, maritalstatus: maritalstatus, encuser: encuser},
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.status == 'success') {
                    alertify.success(jsonData.message);
                    $("#personaldetail").data('formValidation').resetForm();
                } else
                {
                    alertify.error(jsonData.message);
                    $("#personaldetail").data('formValidation').resetForm();
                }
            }
        });

    }
    function updateContactdetail() {
        var district = $("#district").val();
        var state = $("#state").val();
        var postoffice = $("#postoffice").val();
        var pincode = $("#pincode").val();
        var address = $("#address").val();
        var city = $("#city").val();
        var country = $("#country").val();
        var mobile = $("#mobile").val();        
        var emailid = $("#emailid").val();
        var encuser = $("#cinfoencuserid").val();
        $.ajax({
            type: "POST",
            url: '<?= ADMINPATH ?>update-contact-detail',
            data: {emailid: emailid, mobile: mobile, country: country, city: city, state: state, district: district, postoffice: postoffice, pincode: pincode, address: address, encuser: encuser},
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.status == 'success') {
                    alertify.success(jsonData.message);
                    $("#contactdetail").data('formValidation').resetForm();
                } else
                {
                    alertify.error(jsonData.message);
                    $("#contactdetail").data('formValidation').resetForm();
                }
            }
        });


    }
    function updateLoginCredential() {
        var loginname = $("#loginname").val();
        var hiddenusername = $("#hiddenusername").val();
        var newpassword = $("#newpassword").val();
        var encuser = $("#linfoencuserid").val();
        $.ajax({
            type: "POST",
            url: '<?= ADMINPATH ?>update-login-detail',
            data: {hiddenusername: hiddenusername, newpassword: newpassword, loginname: loginname, encuser: encuser},
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.status == 'success') {
                    alertify.success(jsonData.message);
                    $("#logincredential").data('formValidation').resetForm();
                } else
                {
                    alertify.error(jsonData.message);
                    $("#logincredential").data('formValidation').resetForm();
                }
            }
        });
    }
    function updatebanking() {
        var bankacno = $("#bankacno").val();
        var bankifsc = $("#bankifsc").val();
        var bankname = $("#bankname").val();
        var bankbranch = $("#bankbranch").val();
        var panno = $("#panno").val();
        var encuser = $("#binfoencuserid").val();
        $.ajax({
            type: "POST",
            url: '<?= ADMINPATH ?>update-banking-detail',
            data: {bankacno: bankacno, bankifsc: bankifsc, bankname: bankname, bankbranch: bankbranch, panno: panno, encuser: encuser},
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.status == 'success') {
                    alertify.success(jsonData.message);
                    $("#bankingdetail").data('formValidation').resetForm();
                } else
                {
                    alertify.error(jsonData.message);
                    $("#bankingdetail").data('formValidation').resetForm();
                }
            }
        });
    }
    function updatenominee() {
        var nomineename = $("#nomineename").val();
        var nomineerelation = $("#nomineerelation").val();
        var encuser = $("#ninfoencuserid").val();
        $.ajax({
            type: "POST",
            url: '<?= ADMINPATH ?>update-nominee-detail',
            data: {nomineename: nomineename, nomineerelation: nomineerelation, encuser: encuser},
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.status == 'success') {
                    alertify.success(jsonData.message);
                    $("#nomineedetail").data('formValidation').resetForm();
                } else
                {
                    alertify.error(jsonData.message);
                    $("#nomineedetail").data('formValidation').resetForm();
                }
            }
        });
    }
</script>