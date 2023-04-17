<script type="text/javascript">

    $(document).ready(function () {
        flatpickr("#dob", {dateFormat: "d-m-Y"});
        GLightbox({selector: ".image-popup", title: !1});
<?php if (!empty($userdetail->user_pincode)) { ?>
            getAddress('<?= $userdetail->user_post_office ?>')
<?php } ?>
        $('#nomineedetail').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                nomineename: {
                    validators: {
                        notEmpty: {
                            message: "Nominee Name Is Required"
                        }
                    }
                }, nomineerelation: {
                    validators: {
                        notEmpty: {
                            message: "Nominee Relation Is Required"
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            updatenominee();
        });
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
                    validators: {
                        notEmpty: {
                            message: "PAN Is Required"
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
                nomineename: {
                    validators: {
                        notEmpty: {
                            message: "Nominee Name Is Required"
                        }
                    }
                }, nomineerelation: {
                    validators: {
                        notEmpty: {
                            message: "Nominee Relation Is Required"
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
                    validators: {
                        notEmpty: {
                            message: "User Mobile No Is Required"
                        }
                    }
                }, whatsappno: {
                    validators: {
                        notEmpty: {
                            message: "Enter Franchise Point"
                        }
                    }
                }, emailid: {
                    validators: {
                        notEmpty: {
                            message: "Email Id Is Required"
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
                title: {
                    validators: {
                        notEmpty: {
                            message: "Choose User Salutation"
                        }
                    }
                }, name: {
                    validators: {
                        notEmpty: {
                            message: "User Name Required"
                        }
                    }
                }, fatherhusband: {
                    validators: {
                        notEmpty: {
                            message: "User Father/Husband Name Required"
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
                }
            }

        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            updatePersonalDetail();
        });
        $('#kycdetail').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                nomineename: {
                    addressproof: {

                    }
                }, pancopy: {
                    validators: {

                    }
                }, image: {
                    validators: {

                    }
                }
            }
        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            updateKycDetail();
        });
    });


    

    
</script>