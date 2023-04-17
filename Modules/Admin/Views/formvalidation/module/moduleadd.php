<script type="text/javascript">
    $(document).ready(function () {
        $('#moduleadd').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: "Module Name is required"
                        }
                    }
                },zone: {
                    validators: {
                        notEmpty: {
                            message: "Zone is required"
                        }
                    }
                }
                 
            }

        }).on('success.form.fv', function (e) {
            // Prevent form submission
            //e.preventDefault();

        });


    })
</script>