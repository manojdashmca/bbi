<script>
    $(document).ready(function () {
        //flatpickr("#daterange", {mode: "range", dateFormat: "d-m-Y"});
        //new Choices("#status", {removeItemButton: !0});
        //bindDatatable();
        $('#received').DataTable();
        $('#given').DataTable();
        $('#referraladd').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                referralto: {
                    validators: {
                        notEmpty: {
                            message: "Select Referral User"
                        }
                    }
                }, referralname: {
                    validators: {
                        notEmpty: {
                            message: "Enter Referral Name"
                        }
                    }
                }, reftype: {
                    validators: {
                        notEmpty: {
                            message: "Select Referral Type"
                        }
                    }
                }, refstatus: {
                    validators: {
                        notEmpty: {
                            message: "Select Referral Status"
                        }
                    }
                }, telephone: {
                    validators: {
                        notEmpty: {
                            message: "Enter Contact No"
                        }
                    }
                }, email: {
                    validators: {
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'Enter a valid email address'
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            createReferralCard();
        });
    });

    function createReferralCard() {
        var referralto = $("#referralto").val();
        var referralname = $("#referralname").val();
        var reftype = $("#reftype").val();
        var refstatus = $("#refstatus").val();
        var telephone = $("#telephone").val();
        var email = $("#email").val();
        var comment = $("#comment").val();
        var address = $("#address").val();
        $.ajax({
            type: "POST",
            url: '<?= CUSTOMPATH ?>submit-referral',
            data: {address: address, email: email, telephone: telephone, referralto: referralto, referralname: referralname, refstatus: refstatus, reftype: reftype, comment: comment},
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.status == 'success') {
                    alertify.success(jsonData.message);
                    location.reload();
                } else
                {
                    alertify.error(jsonData.message);
                    $("#referraladd").data('formValidation').resetForm();
                }
            }
        });
    }




</script>