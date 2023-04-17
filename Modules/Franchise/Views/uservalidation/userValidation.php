<script type="text/javascript">
    $(document).ready(function () {
        $('#changepasswordform').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                oldpassword: {
                    validators: {
                        notEmpty: {
                            message: "Current Password Can not be blank"
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
    $('#checkoutForm').formValidation({
        message: 'This value is not valid',
        icon: {
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: "Enter Patient Name"
                    }
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: "Select Patient Gender"
                    }
                }
            },
            relation: {
                validators: {
                    notEmpty: {
                        message: "Mention The relation of patient with you"
                    }
                }
            }, dob: {
                validators: {
                    notEmpty: {
                        message: "DOB is required"
                    }, option: {
                        format: 'DD/MM/YYYY',
                        message: 'Invalid Date Format'
                    }
                }
            }
        }
    }).on('success.form.fv', function (e) {
        // Prevent form submission
        e.preventDefault();        
        captureformvalue();        
    });


    $('#userprofile').formValidation({
        message: 'This value is not valid',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: "Name is required"
                    }
                }
            }, dob: {
                validators: {
                    notEmpty: {
                        message: "DOB is required"
                    }, option: {
                        format: 'DD/MM/YYYY',
                        message: 'Invalid Date Format'
                    }
                }
            }, gender: {
                validators: {
                    notEmpty: {
                        message: "Select The Gender"
                    }
                }
            }, email: {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: "Email Id is required"
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Enter a valid email address'
                    }, remote: {
                        url: '<?= CUSTOMPATH ?>check-email',
                        data: function (validator) {
                            return {
                                email: validator.getFieldElements('email').val(),
                                userid: '<?= session()->get('userid') ?>'
                            };
                        },
                        message: 'Email already exists',
                        type: 'POST'
                    }
                }
            },
            mobile: {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: "Mobile is required"
                    }, regexp: {
                        regexp: '[5-9]{1}[0-9]{9}$',
                        message: 'Invalid mobile no'
                    }, stringLength: {
                        max: 10
                    }, remote: {
                        url: '<?= CUSTOMPATH ?>check-mobile',
                        data: function (validator) {
                            return {
                                mobile: validator.getFieldElements('mobile').val(),
                                userid: '<?= session()->get('userid') ?>'
                            };
                        },
                        message: 'Mobile already exists',
                        type: 'POST'
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
</script>