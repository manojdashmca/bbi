<script>
    $(document).ready(function () {
        bindDatatable();
        $('#searchsubmit').click(function () {
            bindDatatable();
        });
        $('#download').click(function () {
            var module = $("#moduleid").val();
            var cname = $("#businesscategory").val();
            var sname = $("#businesssegment").val();
            window.open("<?= ADMINPATH ?>download-user-subcategory-data?module=" + module + "&cname=" + cname + "&sname=" + sname, "_blank");
        });
    });


    function bindDatatable() {
        var categoryname = $("#businesscategory").val();
        var segmentname = $("#businesssegment").val();
        var module = $("#moduleid").val();
        $('#example').DataTable().destroy();
        $('#example').DataTable({
            responsive: true,
            searching: false,
            processing: true,
            ordering: true,
            bLengthChange: false,
            serverSide: true,
            pageLength: 10,
            order: [[0, 'desc']],
            ajax: {
                method: "POST",
                url: '<?= ADMINPATH ?>module-subcategory-data',
                data: function (d) {
                    d.cname = categoryname;
                    d.sname = segmentname;
                    d.module = module;
                }
            }
        });
    }

    function getCategoryBySegment() {
        var segment = $('#businesssegment').val();
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
                    $('#businesscategory').html(dropdown);
                    $('#subcat').html('');
                }
            });
        }

    }
</script>