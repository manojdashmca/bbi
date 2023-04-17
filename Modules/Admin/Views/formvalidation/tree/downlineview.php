<script>
    $(document).ready(function () {
        bindDatatable();
        $('#searchsubmit').click(function () {
            bindDatatable();
        });
       
    });


    function bindDatatable() {

        var name = $("#username").val();
        var position = $("#position").val();
        if (name != '') {
            $('#downlineview').DataTable().destroy();
            $('#downlineview').DataTable({
                responsive: true,
                searching: false,
                processing: true,
                ordering: false,
                bLengthChange: false,
                serverSide: true,
                pageLength: 10,
                //order: [[0, 'desc']],
                ajax: {
                    method: "POST",
                    url: '<?= ADMINPATH ?>tree-downline-data',
                    data: function (d) {
                        d.name = name;
                        d.position = position;
                    }
                }
            });
        }
    }
</script>