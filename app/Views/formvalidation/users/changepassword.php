<script type="text/javascript">
    $(document).ready(function () {
        $('#changepassword').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                oldpassword: {
                    validators: {
                        notEmpty: {
                            message: "Old Password is required"
                        }
                    }
                },
                newpassword: {
                    validators: {
                        notEmpty: {
                            message: "New Password Can not be blank"
                        }, regexp: {
                            regexp: "^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$",
                            message: 'Minimum 8 and Maximum 10 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character '
                        }
                    }
                },
                confirmpassword: {
                    validators: {
                        identical: {
                            field: 'newpassword',
                            message: 'The New password and its confirm are not the same'
                        }
                    }
                }
            }

        });

    });


</script>