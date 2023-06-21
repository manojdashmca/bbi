<script>
    $(document).ready(function () {
        //flatpickr("#daterange", {mode: "range", dateFormat: "d-m-Y"});
        //new Choices("#status", {removeItemButton: !0});
        //bindDatatable();
        $('#received').DataTable();
        $('#given').DataTable();
        $('#thankyouadd').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                thankyouto: {
                    validators: {
                        notEmpty: {
                            message: "Select Receiver User"
                        }
                    }
                }, amount: {
                    validators: {
                        notEmpty: {
                            message: "Referral Amount"
                        }
                    }
                }, bustype: {
                    validators: {
                        notEmpty: {
                            message: "Select Business Type"
                        }
                    }
                }, reftype: {
                    validators: {
                        notEmpty: {
                            message: "Select Referral Type"
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            createThankYouCard();
        });
    });

    function createThankYouCard() {
        var thankyouto = $("#thankyouto").val();
        var amount = $("#amount").val();
        var bustype = $("#bustype").val();
        var reftype = $("#reftype").val();
        var comment = $("#comment").val();
        $.ajax({
            type: "POST",
            url: '<?= CUSTOMPATH ?>submit-thankyou',
            data: {thankyouto: thankyouto, amount: amount, bustype: bustype,reftype:reftype,comment:comment},
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.status == 'success') {
                    alertify.success(jsonData.message);
                    location.reload();
                } else
                {
                    alertify.error(jsonData.message);
                    $("#thankyouadd").data('formValidation').resetForm();
                }
            }
        });
    }




</script>