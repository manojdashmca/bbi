<script type="text/javascript">
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

                    $('#contactdetail').formValidation("revalidateField", "state");
                    $('#contactdetail').formValidation("revalidateField", "district");
                    $('#contactdetail').formValidation("revalidateField", "country");
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
                    $('#bankingdetail').formValidation("revalidateField", "bankname");
                    $('#bankingdetail').formValidation("revalidateField", "bankbranch");
                } else {
                    $("#bankname").val('');
                    $("#bankbranch").val('');
                }
            }
        });
    }

    function updateProfilePic() {
        let data = new FormData($("#profilepicform")[0]);
        $.ajax({
            method: "POST",
            cache: false,
            contentType: false,
            processData: false,
            url: '<?= ADMINPATH ?>update-profile-pic',
            //data: {date: date, description: description, file: files},
            data: data,
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.status == 'success') {
                    alertify.success(jsonData.message);
                    location.reload();
                } else {
                    alertify.error(jsonData.message);
                    $("#profilepicform").data('formValidation').resetForm();
                }
            }
        });
    }


    function updatePersonalDetail() {
        var name = $("#name").val();
        var dob = $("#dob").val();
        var glink = $('input[name=glink]:checked').val();
        var encuser = $("#pinfoencuserid").val();
        var eduqual = $("#eduqual").val();
        var profcert = $("#profcert").val();
        var bloodgroup = $("#bloodgroup").val();
        var nameofgroup = $("#nameofgroup").val();

        $.ajax({
            type: "POST",
            url: '<?= ADMINPATH ?>update-personal-detail',
            data: {glink: glink, eduqual: eduqual, profcert: profcert, bloodgroup: bloodgroup, nameofgroup: nameofgroup, name: name, dob: dob, encuser: encuser},
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
        var encuser = $("#linfoencuserid").val();
        $.ajax({
            type: "POST",
            url: '<?= ADMINPATH ?>update-login-detail',
            data: {hiddenusername: hiddenusername, loginname: loginname, encuser: encuser},
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

    $(document).ready(function () {
        flatpickr("#dob", {dateFormat: "d-m-Y"});
        getAddress('<?= $userdetail->user_post_office ?>');
        $('#bankingdetail').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                bankacno: {
                    validators: {
                        notEmpty: {
                            message: "Bank Account No Is Required"
                        }
                    }
                }, bankifsc: {
                    validators: {
                        notEmpty: {
                            message: "Bank IFSC Is Required"
                        }
                    }
                }, bankname: {
                    validators: {
                        notEmpty: {
                            message: "Bank Name Is required"
                        }
                    }
                }, bankbranch: {
                    validators: {
                        notEmpty: {
                            message: "Bank Branch Is Required"
                        }
                    }
                }, panno: {
                    verbose: false,
                    validators: {
                        notEmpty: {
                            message: "PAN Is Required"
                        }, regexp: {
                            regexp: '^[A-Z]{5}[0-9]{4}[A-Z]{1}$',
                            message: 'Enter a valid PAN No'
                        }, remote: {
                            url: '<?= ADMINPATH ?>check-pan',
                            data: function (validator) {
                                return {
                                    pan: validator.getFieldElements('panno').val(),
                                    userid: <?= $userdetail->id_user ?>
                                };
                            },
                            message: 'PAN already exists',
                            type: 'POST'
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            updatebanking();
        });
        $('#logincredential').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                loginname: {
                    validators: {
                        notEmpty: {
                            message: "Login  Name Is Required"
                        }, regexp: {
                            regexp: '[a-zA-Z0-9]$',
                            message: 'Invalid username'
                        }, stringLength: {
                            min: 6,
                            max: 12
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            updateLoginCredential();
        });
        $('#contactdetail').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                address: {
                    validators: {
                        notEmpty: {
                            message: "User Address Is Required"
                        }
                    }
                }, pincode: {
                    validators: {
                        notEmpty: {
                            message: "Address Pincode Is Required"
                        }
                    }
                }, postoffice: {
                    validators: {
                        notEmpty: {
                            message: "Post Office Is Required"
                        }
                    }
                }, city: {
                    validators: {
                        notEmpty: {
                            message: "City Is Required"
                        }
                    }
                }, district: {
                    validators: {
                        notEmpty: {
                            message: "District Is Required"
                        }
                    }
                }, state: {
                    validators: {
                        notEmpty: {
                            message: "State Is Required"
                        }
                    }
                }, country: {
                    validators: {
                        notEmpty: {
                            message: "Country Is Required"
                        }
                    }
                }, mobile: {
                    verbose: false,
                    validators: {
                        notEmpty: {
                            message: "User Mobile No Is Required"
                        },
                        regexp: {
                            regexp: '[5-9]{1}[0-9]{9}$',
                            message: 'Invalid mobile no'
                        }, stringLength: {
                            max: 10
                        }, remote: {
                            url: '<?= ADMINPATH ?>check-mobile',
                            data: function (validator) {
                                return {
                                    mobile: validator.getFieldElements('mobile').val(),
                                    userid: <?= $userdetail->id_user ?>
                                }
                            },
                            message: 'Mobile already exists',
                            type: 'POST'
                        }

                    }
                }, emailid: {
                    verbose: false,
                    validators: {
                        notEmpty: {
                            message: "Email Id Is Required"
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'Enter a valid email address'
                        }, remote: {
                            url: '<?= ADMINPATH ?>check-email',
                            data: function (validator) {
                                return {
                                    email: validator.getFieldElements('emailid').val(),
                                    userid: <?= $userdetail->id_user ?>
                                };
                            },
                            message: 'Email already exists',
                            type: 'POST'
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            updateContactdetail();
        });
        $('#personaldetail').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: "User Name Required"
                        }
                    }
                },
                dob: {
                    validators: {
                        notEmpty: {
                            message: "Date Of Birth Is Required"
                        }
                    }
                },
                bloodgroup: {
                    validators: {
                        notEmpty: {
                            message: "Select Your Blood Group"
                        }
                    }
                }
            }

        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            updatePersonalDetail();
        });
        $('#profilepicform').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                profilepic: {
                    validators: {
                        notEmpty: {
                            message: 'Please select an image'
                        },
                        file: {
                            extension: 'jpeg,jpg,png',
                            type: 'image/jpeg,image/png',
                            maxSize: 2097152, // 2048 * 1024
                            message: 'The selected file is not valid'
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            updateProfilePic();
        });
    });

</script>