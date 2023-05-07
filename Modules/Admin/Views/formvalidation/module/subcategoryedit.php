<script type="text/javascript">
    $(document).ready(function () {        
        $('#segmentedit').formValidation({
            message: 'This value is not valid',
            icon: {
            },
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: "Segment Name is required"
                        }
                    }
                }
            }

        }).on('success.form.fv', function (e) {
            // Prevent form submission
            //e.preventDefault();

        });


    })
    
    function getSegmentByCategory() {
        var segment = $('#segment').val();
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
                    $('#category').html(dropdown);
                }
            });

        }

    }
</script>