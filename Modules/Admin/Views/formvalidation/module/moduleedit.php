<script type="text/javascript">
    $(document).ready(function () {        
        $('#moduleedit').formValidation({
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
                }, city: {
                    validators: {
                        notEmpty: {
                            message: "City is required"
                        }
                    }
                },state: {
                    validators: {
                        notEmpty: {
                            message: "State is required"
                        }
                    }
                },country: {
                    validators: {
                        notEmpty: {
                            message: "Country is required"
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