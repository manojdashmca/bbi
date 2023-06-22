<script>
    $(document).ready(function () {
        flatpickr("#date", {dateFormat: "d-m-Y"});
        //new Choices("#status", {removeItemButton: !0});
        //bindDatatable();
        $('#received').DataTable();
        $('#given').DataTable();
        $('#onetooneadd').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                meetwith: {
                    validators: {
                        notEmpty: {
                            message: "Select Meet with"
                        }
                    }
                }, location: {
                    validators: {
                        notEmpty: {
                            message: "Enter Meet Location"
                        }
                    }
                }, topic: {
                    validators: {
                        notEmpty: {
                            message: "Enter Topic discussed"
                        }
                    }
                }, date: {
                    validators: {
                        notEmpty: {
                            message: "Enter Meet date"
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            createOneToOneCard();
        });
    });

    function createOneToOneCard() {
        var meetwith = $("#meetwith").val();
        var location = $("#location").val();
        var topic = $("#topic").val();
        var date = $("#date").val();        
        $.ajax({
            type: "POST",
            url: '<?= CUSTOMPATH ?>submit-ontoone',
            data: {meetwith: meetwith, location: location, topic: topic, date: date},
            success: function (data) {
                var jsonData = JSON.parse(data);
                if (jsonData.status == 'success') {
                    alertify.success(jsonData.message);
                    window.location.reload();
                } else
                {
                    alertify.error(jsonData.message);
                    $("#onetooneadd").data('formValidation').resetForm();
                }
            }
        });
    }




</script>