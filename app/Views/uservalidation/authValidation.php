<script type="text/javascript">
    $(document).ready(function () {
        $('#forgotpasswordform').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: "Username is required"
                        }
                    }
                },
                validcaptcha: {
                    excluded: false,
                    validators: {
                        notEmpty: {
                            message: "Please verify the captcha"
                        }
                    }
                }
            }

        });
        $('#loginform').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                userName: {
                    validators: {
                        notEmpty: {
                            message: "Username is required"
                        }
                    }
                },
                userPassword: {
                    validators: {
                        notEmpty: {
                            message: "Password is required"
                        }
                    }
                },
                validcaptcha: {
                    excluded: false,
                    validators: {
                        notEmpty: {
                            message: "Please verify the captcha"
                        }
                    }
                }
            }
        });

        $('#registrationform').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled',
            fields: {
                moduleid: {
                    validators: {
                        notEmpty: {
                            message: "Module Id is required"
                        }
                    }
                }, hidmodule: {
                    excluded: false,
                    validators: {
                        notEmpty: {
                            message: "Click on the getdetail"
                        }
                    }
                },
                sponsorid: {
                    validators: {
                        notEmpty: {
                            message: "Sponsor Id is required"
                        }
                    }
                }, hidval: {
                    excluded: false,
                    validators: {
                        notEmpty: {
                            message: "Click on the getdetail"
                        }
                    }
                }, name: {
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
                gender: {
                    validators: {
                        notEmpty: {
                            message: "Choose User Gender"
                        }
                    }
                }, maritalstatus: {
                    validators: {
                        notEmpty: {
                            message: "Choose User Marital Status"
                        }
                    }
                }, address: {
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
                                    userid:0
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
                                    userid:0
                                };
                            },
                            message: 'Email already exists',
                            type: 'POST'
                        }
                    }
                }, bankacno: {
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
                                    userid:0
                                };
                            },
                            message: 'PAN already exists',
                            type: 'POST'
                        }
                    }
                }, membershipfee: {
                    validators: {
                        notEmpty: {
                            message: "Enter Membership fee paid"
                        }
                    }
                }, paymentmode: {
                    validators: {
                        notEmpty: {
                            message: "Select Payment Mode"
                        }
                    }
                }, paymentdetail: {
                    validators: {
                        notEmpty: {
                            message: "Enter payment detail"
                        }
                    }
                }, businesssegment: {
                    validators: {
                        notEmpty: {
                            message: "Select Business Segment"
                        }
                    }
                }, businesscategory: {
                    validators: {
                        notEmpty: {
                            message: "Select Business Category"
                        }
                    }
                }, subcatvalue: {
                    excluded: false,
                    validators: {
                        notEmpty: {
                            message: 'Please choose at least one subcategory'
                        }
                    }
                }, shopact: {
                    validators: {
                        notEmpty: {
                            message: "Select Your shop license status"
                        }
                    }
                }, isgst: {
                    validators: {
                        notEmpty: {
                            message: "Select Your GST regisytration status"
                        }
                    }
                }, gstno: {
                    validators: {
                        regexp: {
                            regexp: '^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$',
                            message: 'Enter a valid GSTIN'
                        }
                    }
                }, businesspan: {
                    validators: {
                        regexp: {
                            regexp: '^[A-Z]{5}[0-9]{4}[A-Z]{1}$',
                            message: 'Enter a valid PAN No'
                        }
                    }
                }
            }
        });

    });

    function CheckSponsor() {
        $('#hidval').val('');
        var sponsor = $('#sponsorid').val();
        if (sponsor != '') {
            $.ajax({
                type: "get",
                url: '<?= ADMINPATH ?>get-sponsordetail-by-id/' + sponsor,
                success: function (data)
                {
                    $('#preloader').hide();
                    var obj = JSON.parse(data);
                    if (obj.id_user != 0) {
                        $('#hidval').val(obj.sponsor_id);
                        $('#sponsorname').val(obj.sponsor_name);
                        $('#registrationform').formValidation("revalidateField", "hidval");
                        Swal.fire('', obj.message, obj.status);
                    } else {
                        $('#hidval').val('');
                        $('#sponsorname').val('');
                        Swal.fire('', obj.message, obj.status);
                    }

                }
            });
        } else {
            Swal.fire('', 'Enter a IBO id and click on get detail to get the detail!', 'error');
        }
    }

    function CheckModuleDetail() {
        $('#hidmodule').val('');
        var moduleid = $('#moduleid').val();
        if (moduleid != '') {
            $.ajax({
                type: "get",
                url: '<?= ADMINPATH ?>get-moduledetail-by-id/' + moduleid,
                success: function (data)
                {
                    $('#preloader').hide();
                    var obj = JSON.parse(data);
                    if (obj.status == 'success') {
                        $('#hidmodule').val(obj.data.lm_id);
                        $('#modulename').val(obj.data.lm_name);
                        $('#countryname').val(obj.data.lm_country);
                        $('#statename').val(obj.data.lm_state);
                        $('#cityname').val(obj.data.lm_city);
                        $('#moduledirector').val(obj.data.director);
                        $('#registrationform').formValidation("revalidateField", "hidmodule");
                        Swal.fire('', obj.message, obj.status);
                    } else {
                        $('#hidval').val('');
                        $('#sponsorname').val('');
                        Swal.fire('', obj.message, obj.status);
                    }

                }
            });
        } else {
            Swal.fire('', 'Enter a Module id and click on get detail to get the detail!', 'error');
        }
    }


    function getBusinessBankDetail() {
        var ifsc = $("#businessbankifsc").val();
        $.ajax({
            type: "GET",
            url: '<?= ADMINPATH ?>getBankDetailByIfsc/' + ifsc,
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.length > 0) {
                    $("#businessbankname").val(jsonData[0].bank_name);
                    $("#businessbankbranch").val(jsonData[0].bank_branch_name);
                    $('#registrationform').formValidation("revalidateField", "businessbankname");
                    $('#registrationform').formValidation("revalidateField", "businessbankbranch");
                } else {
                    $("#businessbankname").val('');
                    $("#businessbankbranch").val('');
                }
            }
        });
    }

    function getCategoryBySegment() {
        var segment = $('#businesssegment').val();
        if (segment != '') {
            $.ajax({
                type: "POST",
                url: '<?= ADMINPATH ?>get-category-by-segment',
                data: {segment: segment},
                success: function (data) {
                    var jsonData = JSON.parse(data);
                    var dropdown = '<option value="">Select Category</option>';
                    if (jsonData.status == 'success') {
                        var list = jsonData.data;
                        for (var x = 0; x < list.length; x++) {
                            dropdown += '<option value="' + list[x].category_id + '">' + list[x].category_name + '</option>'
                        }
                    }
                    $('#businesscategory').html(dropdown);
                    $('#subcat').html('');
                }
            });
        }

    }
    function getSubCategoryByCategory() {
        var category = $('#businesscategory').val();
        var moduleid = $('#hidmodule').val();
        $('#subcat').html('');
        if (moduleid != '') {
            $.ajax({
                type: "POST",
                url: '<?= ADMINPATH ?>get-subcategory-by-category-module',
                data: {category: category, module: moduleid},
                success: function (data) {
                    var jsonData = JSON.parse(data);
                    var checkbox = '';
                    if (jsonData.status == 'success') {
                        var list = jsonData.data;
                        for (var x = 0; x < list.length; x++) {
                            var disable = '';
                            if (list[x].disabled == 1) {
                                disable += 'disabled="true"';
                            }
                            checkbox += '<div class="col-lg-4"><div class="form-check mb-3">';
                            checkbox += '<input onclick="setchoosensubcategory();" ' + disable + ' class="form-check-input" type="checkbox" name="businesssubcategory[]" value="' + list[x].sub_category_id + '"/>';
                            checkbox += '<label class="form-check-label" for="formCheck1">' + list[x].sub_category_name + '</label>'
                            checkbox += '</div></div>';
                        }
                    }
                    $('#subcat').html(checkbox);

                }
            });
        } else {
            Swal.fire('Error', 'Enter the module id/Name and get detail, then select category to check the available subcategory', 'error');
        }

    }

    function setchoosensubcategory() {
        var checked = []
        $("input[name='businesssubcategory[]']:checked").each(function ()
        {
            checked.push(parseInt($(this).val()));
        });
        var implodedvalue = checked.join(",");
        $('#subcatvalue').val(implodedvalue);
        $('#registrationform').formValidation('revalidateField', "subcatvalue");
        var paymentamount = calculatePaymentAmount();
        var subcategorylength = checked.length;
        var gst = 0;
        if (checked.length == 1) {
            var amounttobepayed = paymentamount + paymentamount * 18 / 100;
            gst += Number(paymentamount * 18 / 100);
        } else {
            var additionalamount = (checked.length - 1) * 5000;
            var amounttobepayed = paymentamount + additionalamount + additionalamount * 18 / 100 + paymentamount * 18 / 100;
            gst += Number(paymentamount * 18 / 100) + Number(additionalamount * 18 / 100);
        }
        $('#membershipfee').val(amounttobepayed);
        $('#hiddengst').val(gst);
        $('#joiningfee').val(paymentamount);
    }

    function calculatePaymentAmount() {
        var segment = $('#businesssegment').val();

        if (segment == 26 || segment == 27) {
            return 15000;
        } else {
            return 25000;
        }
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

                    $('#registrationform').formValidation("revalidateField", "state");
                    $('#registrationform').formValidation("revalidateField", "district");
                    $('#registrationform').formValidation("revalidateField", "country");
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
                    $('#registrationform').formValidation("revalidateField", "bankname");
                    $('#registrationform').formValidation("revalidateField", "bankbranch");
                } else {
                    $("#bankname").val('');
                    $("#bankbranch").val('');
                }
            }
        });
    }
</script>