<script type="text/javascript">
    $(document).ready(function () {
        flatpickr("#dob", {dateFormat: "d-m-Y"});
        $('#useradd').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
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
                }, title: {
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
                    validators: {
                        notEmpty: {
                            message: "User Mobile No Is Required"
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'Enter a valid email address'
                        }

                    }
                }, whatsappno: {
                    validators: {
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'Enter a valid email address'
                        }
                    }
                }, emailid: {
                    validators: {
                        notEmpty: {
                            message: "Email Id Is Required"
                        },
                        regexp: {
                            regexp: '[0-9]{10}$',
                            message: 'Invalid mobile no'
                        }
                    }
                }, nomineename: {
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
                    validators: {
                        notEmpty: {
                            message: "PAN Is Required"
                        }
                    }
                }
            }

        }).on('success.form.fv', function (e) {
            // Prevent form submission
            //e.preventDefault();

        });


    })

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
                        $('#useradd').formValidation("revalidateField", "hidval");
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
</script>